<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\View\View;

class YocoTestController extends Controller
{
    private string $publicKey;

    private string $secretKey;

    public function __construct()
    {
        $this->publicKey = config('services.yoco.public_key', 'pk_test_51816363AVr2NXD875f4');
        $this->secretKey = config('services.yoco.secret_key', 'sk_test_43f7c7607L9OKx8167446f29392a');
    }

    /**
     * Show the Yoco Sandbox testing dashboard.
     */
    public function index(Request $request): View
    {
        $status = $request->query('status');
        $checkoutId = $request->query('checkout_id') ?: $request->query('id');
        $checkoutData = null;

        if ($checkoutId) {
            try {
                $res = Http::withToken($this->secretKey)
                    ->timeout(10)
                    ->get("https://payments.yoco.com/api/checkouts/{$checkoutId}");

                if ($res->successful()) {
                    $checkoutData = $res->json();
                }
            } catch (\Exception $e) {
                Log::warning('Yoco checkout status lookup error: '.$e->getMessage());
            }
        }

        return view('web.yoco-test', [
            'publicKey' => $this->publicKey,
            'secretKey' => $this->secretKey,
            'status' => $status,
            'checkoutId' => $checkoutId,
            'checkoutData' => $checkoutData,
        ]);
    }

    /**
     * Create a hosted checkout session on Yoco and redirect user to Yoco payment page.
     */
    public function createCheckout(Request $request): RedirectResponse
    {
        $request->validate([
            'amount' => 'required|numeric|min:1',
            'product_name' => 'nullable|string',
        ]);

        $amountInRands = (float) $request->input('amount');
        $amountInCents = (int) round($amountInRands * 100);
        $productName = $request->input('product_name', 'PhotoX Photo License');

        try {
            $response = Http::withToken($this->secretKey)
                ->timeout(15)
                ->post('https://payments.yoco.com/api/checkouts', [
                    'amount' => $amountInCents,
                    'currency' => 'ZAR',
                    'cancelUrl' => url('/yoco-test?status=cancelled'),
                    'successUrl' => url('/yoco-test?status=success'),
                    'failureUrl' => url('/yoco-test?status=failed'),
                    'metadata' => [
                        'product_name' => $productName,
                        'source' => 'photox_sandbox_test',
                        'order_time' => now()->toIso8601String(),
                    ],
                ]);

            if ($response->successful()) {
                $data = $response->json();
                $redirectUrl = $data['redirectUrl'] ?? null;

                if ($redirectUrl) {
                    return redirect()->away($redirectUrl);
                }
            }

            $errorMessage = $response->json('errorMessage') ?: 'Failed to create Yoco checkout session.';

            return redirect()->route('yoco.test', ['status' => 'error'])
                ->with('error', $errorMessage);
        } catch (\Exception $e) {
            return redirect()->route('yoco.test', ['status' => 'error'])
                ->with('error', 'Yoco API Exception: '.$e->getMessage());
        }
    }

    /**
     * Charge a token generated from Yoco Web SDK (Popup/Inline) via server-side charge API.
     */
    public function chargeToken(Request $request): JsonResponse
    {
        $request->validate([
            'token' => 'required|string',
            'amountInCents' => 'required|integer|min:100',
            'currency' => 'nullable|string',
        ]);

        $token = $request->input('token');
        $amountInCents = (int) $request->input('amountInCents');
        $currency = $request->input('currency', 'ZAR');

        try {
            $response = Http::withToken($this->secretKey)
                ->timeout(15)
                ->post('https://online.yoco.com/v1/charges/', [
                    'token' => $token,
                    'amountInCents' => $amountInCents,
                    'currency' => $currency,
                ]);

            $json = $response->json();

            if ($response->successful() && ($json['status'] ?? '') === 'successful') {
                return response()->json([
                    'success' => true,
                    'message' => 'Payment processed successfully via Yoco!',
                    'data' => $json,
                ]);
            }

            return response()->json([
                'success' => false,
                'message' => $json['displayMessage'] ?? $json['errorMessage'] ?? 'Payment failed.',
                'data' => $json,
            ], 400);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Yoco charge error: '.$e->getMessage(),
            ], 500);
        }
    }
}
