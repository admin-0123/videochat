<?php

namespace App\Repositories;

use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Http;
use Illuminate\Validation\ValidationException;

class PaymentRepository
{
    public function validatePaypalPayment($order_id)
    {
        $uri = 'https://api-m.sandbox.paypal.com/v1/oauth2/token';
        $clientId = config('config.payment_gateway.paypal_key');
        $secret = config('config.payment_gateway.paypal_secret');

        $response = Http::asForm()->withBasicAuth($clientId, $secret)->post($uri, [
            'grant_type' => 'client_credentials'
        ]);

        $access_token = Arr::get($response->json(), 'access_token');

        $uri = 'https://api.sandbox.paypal.com/v2/checkout/orders/' . $order_id;
        $response = Http::withToken($access_token)->get($uri);

        $status = Arr::get($response->json(), 'status');

        return $status === 'COMPLETED' ? true : false;
    }
}
