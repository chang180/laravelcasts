<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Ycs77\NewebPay\Facades\NewebPay;

class PaymentController extends Controller
{
    public function payment()
    {
        $no = 'test123';
        $amt = 888;
        $desc = '商品一批';
        $email = 'chang180@gmail.com';

        return NewebPay::payment($no, $amt, $desc, $email)->submit();
    }
}
