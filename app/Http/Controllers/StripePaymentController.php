<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Stripe\Stripe;
use Stripe\PaymentIntent;
use Stripe\Exception\CardException;
use Stripe\Exception\InvalidRequestException;

class StripePaymentController extends Controller
{
    public function createPaymentIntent(Request $request)
    {
        try {
            // Initialize Stripe with your secret key from config
            Stripe::setApiKey(config('services.stripe.secret'));

            // Retrieve JSON from the request body
            $jsonObj = json_decode($request->getContent());

            // Create a PaymentIntent with amount and currency
            $paymentIntent = PaymentIntent::create([
                'amount' => $this->calculateOrderAmount($jsonObj->items),
                'currency' => 'pln',
                'setup_future_usage' => 'off_session',
            ]);

            return response()->json(['clientSecret' => $paymentIntent->client_secret]);
        } catch (InvalidRequestException $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    private function calculateOrderAmount(array $items): int
    {
        // Replace this with your calculation logic
        // Calculate the order total on the server to prevent
        // people from directly manipulating the amount on the client
        return 1400;
    }
}
