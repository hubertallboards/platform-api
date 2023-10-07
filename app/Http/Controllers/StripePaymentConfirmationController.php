<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Stripe\Stripe;
use Stripe\PaymentIntent;
use Stripe\Exception\CardException;
use Stripe\Exception\InvalidRequestException;

class StripePaymentConfirmationController extends Controller
{
    public function confirmPayment(Request $request)
    {
        try {
            // Initialize Stripe with your secret key from config
            Stripe::setApiKey(config('services.stripe.secret'));

            // Retrieve JSON from the request body
            $jsonObj = json_decode($request->getContent());

            // Lookup the payment methods available for the customer
            $paymentMethods = \Stripe\PaymentMethod::all([
                'customer' => $jsonObj->customer,
                'type' => 'card'
            ]);

            // Charge the customer and payment method immediately
            $paymentIntent = PaymentIntent::create([
                'amount' => $this->calculateOrderAmount($jsonObj->items),
                'currency' => 'pln',
                'customer' => $jsonObj->customer,
                'payment_method' => $paymentMethods->data[0]->id,
                'off_session' => true,
                'confirm' => true,
            ]);

            return response()->json(['paymentIntent' => $paymentIntent]);
        } catch (CardException $e) {
            // Handle specific card errors here
            return response()->json(['error' => $e->getMessage()], 400);
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
