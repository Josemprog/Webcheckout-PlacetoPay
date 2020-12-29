<?php

namespace App\Http\Controllers;

use App\Payment;
use Illuminate\Http\Request;
use App\Services\PlaceToPayService;
use App\Http\Requests\PaymentRequest;

class PaymentController extends Controller
{
    public $p2p;

    public function __construct(PlaceToPayService $p2p)
    {
        $this->p2p = $p2p;
    }

    public function index()
    {
        $payment = Payment::latest()->first();
        
        if ($payment) {
            $paymentInformation = $this->p2p->getInformation($payment->requestId);
            
            if ($payment->status == 'pending') {
                $payment->status = $paymentInformation['status']['status'];
                $payment->save();
            }

            return view('formulario')->with(['payment' => $payment]);
        }
        return view('formulario');
    }

    
    public function pay(Payment $payment, PaymentRequest $request)
    {
        $payment = Payment::create($request->validated());
            
        $peticion = $this->p2p->createRequest($payment);
            
        $payment->processUrl = $peticion['processUrl'];
        $payment->requestId = $peticion['requestId'];
        $payment->status = 'pending';
        $payment->save();
            
        return redirect($payment['processUrl']);
    }

    public function retry(Payment $payment): \Illuminate\Http\RedirectResponse
    {
        $paymentRetry = $this->p2p->createRequest($payment);

        $payment->processUrl = $paymentRetry['processUrl'];
        $payment->requestId = $paymentRetry['requestId'];
        $payment->status = 'pending';
        $payment->save();

        return redirect($payment['processUrl']);
    }
}
