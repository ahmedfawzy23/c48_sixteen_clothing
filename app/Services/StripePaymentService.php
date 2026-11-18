<?php

namespace App\Services;

use App\Models\Order;
use Exception;
use Stripe\Checkout\Session;
use Stripe\Stripe;

class StripePaymentService
{
    public function createCheckoutSession(Order $order)
    {
        Stripe::setApiKey(config('services.stripe.secret_key'));
        $lineItems = [];
        try {

            foreach ($order->orderItems as $item) {
                $lineItems[] = [
                    'price_data' => [
                        'currency' => 'usd',
                        'product_data' => [
                            'name' => $item->product_name,
                        ],
                        'unit_amount' => $item->price * 100,
                    ],
                    'quantity' => $item->quantity,
                ];
            }
            $session = Session::create([
                // 'payment_method_types' => ['card'],
                'line_items' => $lineItems,
                'mode' => 'payment',
                'client_reference_id' => $order->id,
                'metadata' => [
                    'order_id' => $order->id,
                ],
                'success_url' => route('payment.success'),
                'cancel_url' => route('payment.cancel'),
            ]);

            $order->update([
                'stripe_session_id' => $session->id,
            ]);
            return redirect($session->url);
        } catch (Exception $e) {
            return redirect()->back()->with('error', 'Please try agai' . $e->getMessage());
        }
    }
}
