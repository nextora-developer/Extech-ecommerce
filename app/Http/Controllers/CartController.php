<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\CartItem;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class CartController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | 共用方法：当前 Cart 的查询
    |--------------------------------------------------------------------------
    */

    protected function currentCartQuery()
    {
        if (auth()->check()) {
            // 已登录：用 user_id
            return Cart::where('user_id', auth()->id());
        }

        // 游客：用 session_id
        return Cart::where('session_id', session()->getId());
    }

    protected function getOrCreateCart(): Cart
    {
        if (auth()->check()) {
            return Cart::firstOrCreate([
                'user_id' => auth()->id(),
            ]);
        }

        return Cart::firstOrCreate([
            'session_id' => session()->getId(),
        ]);
    }

    /*
    |--------------------------------------------------------------------------
    | Cart 页面
    |--------------------------------------------------------------------------
    */

    public function index()
    {
        $cart = $this->currentCartQuery()
            ->with('items.product')
            ->first();

        $items = $cart?->items ?? collect();

        $subtotal = $items->sum(fn($item) => $item->unit_price * $item->qty);

        return view('cart.index', [
            'items'    => $items,
            'subtotal' => $subtotal,
        ]);
    }

    /*
    |--------------------------------------------------------------------------
    | 加入购物车
    |--------------------------------------------------------------------------
    */

    public function add(Request $request, Product $product)
    {
        // 先检查登录
        if (!auth()->check()) {
            return back()->with('error', 'Please login first.');
        }

        // 检查用户是否已 verified
        // 这里请根据你的 users 表字段改
        // 例如：is_verified / verified / status === 'verified'
        if ((int) auth()->user()->is_verified !== 1) {
            return back()->with('error', 'Your account is not verified yet. You cannot add items to cart.');
        }

        // 统一入口：游客 / 会员都可以
        $cart = $this->getOrCreateCart();

        // ✅ 购物车类型锁定：digital vs physical 不能混
        $incomingIsDigital = (bool) $product->is_digital;

        $firstItem = $cart->items()
            ->with('product:id,is_digital')
            ->first();

        if ($firstItem && $firstItem->product) {
            $cartIsDigital = (bool) $firstItem->product->is_digital;

            if ($cartIsDigital !== $incomingIsDigital) {
                $msg = $cartIsDigital
                    ? 'Your cart contains digital items. Please checkout or clear the cart before adding physical items.'
                    : 'Your cart contains physical items. Please checkout or clear the cart before adding digital items.';

                return back()->with('error', $msg);
            }
        }

        $qty = max(1, (int) $request->input('quantity', 1));

        $variantId    = null;
        $variantLabel = null;
        $unitPrice    = $product->price;

        if ($product->has_variants) {
            $variantId = $request->input('variant_id');

            if (!$variantId) {
                return back()->with('error', 'Please select a variant before adding to cart.');
            }

            $variant   = $product->variants()->where('id', $variantId)->firstOrFail();
            $unitPrice = $variant->price;

            $label = explode('/', $variant->options['label'] ?? '');
            $value = explode('/', $variant->options['value'] ?? '');

            $parts = [];
            foreach ($label as $i => $name) {
                $name = trim($name);
                $val  = trim($value[$i] ?? '');
                if ($name !== '' && $val !== '') {
                    $parts[] = "{$name}: {$val}";
                }
            }
            $variantLabel = implode(' & ', $parts);
        }

        if (is_null($unitPrice)) {
            return back()->with('error', 'This product or variant does not have a price set.');
        }

        $query = $cart->items()->where('product_id', $product->id);

        if ($variantId) {
            $query->where('product_variant_id', $variantId);
        } else {
            $query->whereNull('product_variant_id');
        }

        $item = $query->first();

        if ($item) {
            $item->qty += $qty;
            $item->save();
        } else {
            $cart->items()->create([
                'product_id'         => $product->id,
                'product_variant_id' => $variantId,
                'qty'                => $qty,
                'unit_price'         => $unitPrice,
                'variant_label'      => $variantLabel,
            ]);
        }

        return back()->with('success', 'Added to cart');
    }

    /*
    |--------------------------------------------------------------------------
    | 更新数量
    |--------------------------------------------------------------------------
    */

    public function update(Request $request, CartItem $item)
    {
        // 确保是当前用户/当前 session 的 cart item（简单校验）
        $currentCart = $this->currentCartQuery()->first();
        if (!$currentCart || $item->cart_id !== $currentCart->id) {
            abort(403);
        }

        $action = $request->input('action');

        if ($action === 'increase') {
            $item->qty++;
        } elseif ($action === 'decrease') {
            if ($item->qty > 1) {
                $item->qty--;
            } else {
                // 数量减到 0 直接删掉
                $item->delete();

                return redirect()->route('cart.index');
            }
        }

        $item->save();

        return redirect()->route('cart.index');
    }

    /*
    |--------------------------------------------------------------------------
    | 移除项目
    |--------------------------------------------------------------------------
    */

    public function remove(CartItem $item)
    {
        $currentCart = $this->currentCartQuery()->first();
        if (!$currentCart || $item->cart_id !== $currentCart->id) {
            abort(403);
        }

        $cart = $item->cart;

        $item->delete();

        if ($cart && !$cart->items()->exists()) {
            $cart->delete();
        }

        return redirect()->route('cart.index')
            ->with('success', 'Item removed.');
    }

    /*
    |--------------------------------------------------------------------------
    | 购物车数量（给 navbar 用）
    |--------------------------------------------------------------------------
    */

    public function count(): JsonResponse
    {
        $cart = $this->currentCartQuery()
            ->withCount('items')
            ->first();

        $count = $cart->items_count ?? 0;

        return response()->json([
            'count' => $count,
        ]);
    }
}
