<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Stripe\Webhook;

class WebhookConretoller extends Controller
{
    public function handleWebhook(Request $request)
    {
        $payload = $request->getContent();
        $signature = $request->header('Stripe-Signature');
        $webhookSecret = config('services.stripe.webhook_secret');


        try {
            $event = Webhook::constructEvent($payload, $signature, $webhookSecret);
            Log::info('Webhook received:', [
                'payload' => $payload,
                'signature' => $signature,
                'webhookSecret' => $webhookSecret,
                'event' => $event,
                'type' => $event->type,
                'data' => $event->data,
            ]);
        } catch (Exception $e) {
            return response()->json([
                'error' => "Webhook Signature Faild" . $e->getMessage()
            ], 400);
        }

        if ($event->type == 'checkout.session.completed') {
            $session = $event->data->object;

            $orderId = $session->metadata->order_id ?? null;

            if ($orderId) {
                $order = Order::find($orderId);
                if ($order) {
                    $order->update([
                        'payment_status' => 'paid',
                        'payment_payment_id' => $session->payment_intent
                    ]);
                    $order->user?->cartItems()->delete();
                }
            }
        } else {
            Log::info('Webhook received:', [
                'payload' => $payload,
                'signature' => $signature,
                'webhookSecret' => $webhookSecret,
                'event' => $event,
                'type' => $event->type,
                'data' => $event->data,
            ]);
        }
        return response()->json([
            'success' => "success"
        ], 200);
    }
}
