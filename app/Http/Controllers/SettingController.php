<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use TCG\Voyager\Models\Setting;

class SettingController extends Controller
{

    /**
     * @OA\Get(
     *     path="/api/post-delivery-price",
     *     description="Getting services",
     *     tags={"settings"},
     *     summary="Settings",
     *     @OA\Response(
     *          response="200",
     *          description="success",
     *          @OA\JsonContent(
     *                @OA\Items(
     *                      @OA\Property(property="price", type="string"),
     *
     *                  )
     *              )
     *       )
     *     )
     * )
     */
    public function postDeliveryPrice()
    {
        $postPrice = Setting::where('key', 'admin.post_delivery_price')->first();
        return response()->json([['price' => $postPrice->value]],200);
    }
}
