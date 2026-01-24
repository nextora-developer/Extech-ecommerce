<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use App\Models\Banner;
use Illuminate\Http\Request;

class ShopController extends Controller
{
    // Homepage
    public function home()
    {
        $banners = Banner::where('is_active', true)
            ->orderBy('sort_order')
            ->get();

        $featured = Product::where('is_active', true)
            ->latest()
            ->limit(10)
            ->get();

        $categories = Category::where('is_active', true)
            ->orderBy('sort_order')
            ->get();

        return view('shop.home', compact('featured', 'categories', 'banners'));
    }

    // Shop listing + Search
    public function index(Request $request)
    {
        $query = Product::query()
            ->where('is_active', true)
            ->with('category')
            ->withMin('variants', 'price'); // 会生成 variants_min_price

        if ($search = $request->q) {
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                    ->orWhere('short_description', 'like', "%{$search}%");
            });
        }

        if ($categorySlug = $request->category) {
            $query->whereHas('category', function ($q) use ($categorySlug) {
                $q->where('slug', $categorySlug);
            });
        }

        // ✅ 用 “排序用价格” = COALESCE(variants_min_price, products.price)
        $sortPriceExpr = "COALESCE(variants_min_price, price)";

        switch ($request->sort) {
            case 'price_asc':
                $query->orderByRaw("$sortPriceExpr asc");
                break;

            case 'price_desc':
                $query->orderByRaw("$sortPriceExpr desc");
                break;

            case 'latest':
                $query->latest();
                break;

            default:
                $query->latest();
        }

        $products = $query->paginate(15)->withQueryString();
        $categories = Category::where('is_active', true)->orderBy('sort_order')->get();

        return view('shop.index', compact('products', 'categories'));
    }


    // Product detail (route model binding by slug already in your routes)
    public function show(Product $product)
    {
        abort_unless($product->is_active, 404);

        $product->load([
            'category',
            'options.values' => fn($q) => $q->orderBy('sort_order'),
            'variants' => fn($q) => $q->where('is_active', true),
        ]);

        $related = Product::where('category_id', $product->category_id)
            ->where('id', '!=', $product->id)
            ->where('is_active', true) // ✅ 只拿 active
            ->latest()
            ->limit(4)
            ->get();


        return view('shop.show', compact('product', 'related'));
    }
}
