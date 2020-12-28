<?php

namespace App\Http\Controllers;

use App\Payment;
use Illuminate\Http\Request;
use App\Services\PlaceToPayService;

class PaymentController extends Controller
{
    public $p2p;

    public function __construct(PlaceToPayService $p2p)
    {
        $this->p2p = $p2p;
    }

    public function index()
    {
    }

    public function pay(Request $request)
    {
        $payment = Payment::create([
            'description' => $request->description,
            'amount' => $request->amount,
        ]);

        $peticion = $this->p2p->createRequest($payment);
        
        $payment->processUrl = $peticion['processUrl'];
        $payment->requestId = $peticion['requestId'];
        $payment->save();

        return redirect($payment['processUrl']);
    }
}
