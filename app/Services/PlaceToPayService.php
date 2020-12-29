<?php

namespace App\Services;

use App\Payment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class PlaceToPayService
{
    protected $endponitBase;
    protected $login;
    protected $secretKey;

    public function __construct()
    {
        $this->endponitBase = config('services.p2p.endpoint_base');
        $this->login = config('services.p2p.login');
        $this->secretKey = config('services.p2p.secret_key');
    }

    /**
     * test function to consume place to pay api
     *
     * @return void
     */
    public function createRequest(Payment $payment)
    {
        $response = Http::post('https://test.placetopay.com/redirection/' . 'api/session/', [
      'auth' => $this->getCredentials(),
      'payment' => [
        'reference' => $payment->id,
        'description' => $payment->description,
        'amount' => [
          'currency' => 'COP',
          'total' => $payment->amount,
        ],
      ],
      'expiration' => date('c', strtotime('1 hour')),
      'returnUrl' => 'http://localhost:3000/',
      'ipAddress' => request()->ip(),
      'userAgent' => request()->userAgent(),
    ]);

        return $response->json();
    }

    /**
     * The requestId information is obtained
     *
     * @param int $requestId
     * @return void
     */
    public function getInformation($requestId)
    {
        $response = Http::post('https://test.placetopay.com/redirection/api/session/' . $requestId, [
      'auth' => $this->getCredentials(),
    ]);

        return $response->json();
    }

    /**
     * the credentials requested by the place to pay api are obtained
     *
     * @return void
     */
    public function getCredentials()
    {
        $login = $this->login;
        $secretKey = $this->secretKey;
        $seed = date('c');

        if (function_exists('random_bytes')) {
            $nonce = bin2hex(random_bytes(16));
        } elseif (function_exists('openssl_random_pseudo_bytes')) {
            $nonce = bin2hex(openssl_random_pseudo_bytes(16));
        } else {
            $nonce = mt_rand();
        }

        $nonceBase64 = base64_encode($nonce);

        $tranKey = base64_encode(sha1($nonce . $seed . $secretKey, true));

        return [
      'login' => $login,
      'seed' => $seed,
      'nonce' => $nonceBase64,
      'tranKey' => $tranKey,
    ];
    }
}
