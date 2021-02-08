<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use TCG\Voyager\Models\Setting;

class SettingController extends Controller
{
    public function postDeliveryPrice()
    {
        $postPrice = Setting::where('key', 'admin.post_delivery_price')->first();
        return response()->json($postPrice->value,200);
    }
}
