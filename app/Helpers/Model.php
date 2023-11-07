<?php

use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Modules\SPP\Entities\PaymentSpp;

// Get Quota
if (!function_exists('CekPayment')) {
    function CekPayment()
    {
        $monthNow = Carbon::now()->format('F');
        $cekPayment = PaymentSpp::where('user_id', Auth::id())->first();
        $data = $cekPayment->$monthNow;

        return $data;
    }
}
