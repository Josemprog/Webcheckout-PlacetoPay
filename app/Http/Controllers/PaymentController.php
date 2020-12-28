<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\PlaceToPayService;

class PaymentController extends Controller
{
    public $p2p;

    public function __construct(PlaceToPayService $p2p)
    {
        $this->p2p = $p2p;

        $this->middleware('auth');
    }
    public function pay()
    {
        $payment = $this->p2p->createRequest();

        return $payment;
    }
}
