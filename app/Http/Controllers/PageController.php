<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PageController extends Controller
{
    public function howToOrder()
    {
        return view('pages.how-to-order');
    }

    public function faq()
    {
        $faqs = [
            [
                'category' => 'Orders',
                'question' => 'Can I change or cancel my order after payment?',
                'answer' => 'Once payment is completed, orders are processed quickly. If your order has not been shipped, please contact our support team as soon as possible with your order ID.'
            ],
            [
                'category' => 'Orders',
                'question' => 'I placed an order but did not receive a confirmation email.',
                'answer' => 'Please check your spam or junk folder. If you still cannot find it, contact our support team and we will assist you.'
            ],
            [
                'category' => 'Payment',
                'question' => 'What payment methods do you support?',
                'answer' => 'We support Online Transfer and selected online payment gateways. Available payment methods will be shown during checkout.'
            ],
            [
                'category' => 'Payment',
                'question' => 'My payment was successful but the order is still pending.',
                'answer' => 'Sometimes payment gateways take a few minutes to sync. Please refresh after a short while. If the status remains pending, contact us with your order ID.'
            ],
            [
                'category' => 'Shipping',
                'question' => 'How long does delivery take?',
                'answer' => 'Delivery time depends on your location and courier service. Estimated delivery time will be shown during checkout. Peak seasons may take slightly longer.'
            ],
            [
                'category' => 'Shipping',
                'question' => 'Do you ship nationwide?',
                'answer' => 'We ship to supported locations shown at checkout. If your area is unavailable, please contact us for assistance.'
            ],
            [
                'category' => 'Account',
                'question' => 'Do I need an account to place an order?',
                'answer' => 'You may check out as a guest, but creating an account allows you to track orders, manage addresses, and enjoy a faster checkout experience.'
            ],
        ];

        return view('pages.faq', [
            'faqs' => $faqs,
        ]);
    }

    public function privacyPolicy()
    {
        return view('pages.privacy-policy');
    }

    public function terms()
    {
        return view('pages.terms');
    }

    public function shippingDelivery()
    {
        return view('pages.shipping-delivery');
    }

    public function returnsRefunds()
    {
        return view('pages.returns-refunds');
    }
}
