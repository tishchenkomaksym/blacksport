<?php
/**
 * Created by PhpStorm.
 * User: arsen
 * Date: 11/21/2018
 * Time: 8:44 PM
 */

namespace App\Http\Controllers;


use App\Exceptions\ApiException;
use App\Instrument;
use App\Models\Product;
use App\Offer;
use Illuminate\Validation\Rules\In;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

trait Basket
{
    protected $items = [];


//
//    public static function flattenData(array $items) {
//        $mixed = [];
//        foreach ($items as $type => $products)
//            foreach ($products as $id => $product)
//                $mixed["$type|$id"] = $product;
//        return $mixed;
//    }
//
    protected function getData() {
        return session() -> get('basket');
    }
//
//    private function getSum(array $flattenedData) {
//        $sum = 0;
//        foreach ($flattenedData as $item) {
//            $sum += (int)$item['price']*(int)$item['quantity'];
//        }
//        return $sum;
//    }
//
//    public static function getCount() : int {
//        $n = 0;
//        $items = session('basket');
//        if (!$items)
//            return 0;
//        foreach ($items as $item => $num)
//            $n += $num;
//        return $n;
//    }


    //
    // API functions
    //


    function abort($code, $text) {
        return response($text, $code)
            ->header('Content-Type', 'text/plain');
    }


    /**
     * @OA\Get(
     *     path="/api/basket",
     *     description="Getting basket",
     *     tags={"basket"},
     *     summary="Get Basket",
     *     @OA\Response(
     *          response="200",
     *          description="success",
     *          @OA\JsonContent(
     *           @OA\Property(property="productId", type="integer",
     *          example="Products quantity")
     *              )
     *       )
     *     )
     * )
     */
    public function get(): string {
        $this -> open();
        return json_encode($this -> getData());
    }

    public function open() {
        if (!session() -> has('basket'))
            session(['basket' => []]);
        $this -> items = session() -> get('basket') ?? [];
    }

    public function store() {
        session() -> put('basket', $this -> items);
    }

    private function itemHandler(string $id, callable $handler) {
        $this -> open();

        Product::findOrFail($id);

        $k = "$id";
        $handler($k);

        $this -> store();

        return $this -> get();
    }

    /**
     * @OA\Post(
     *     path="/api/basket/{id}/{n}",
     *     description="Add to basket",
     *     tags={"basket"},
     *     summary="Add to Basket",
     *
     *      @OA\Parameter(
     *        description="Product Id",
     *        in="path",
     *        name="id",
     *        required=true,
     *        example="1",
     *        @OA\Schema(type="integer")
     *    ),
     *
     *      @OA\Parameter(
     *        description="Quantity of product",
     *        in="path",
     *        name="n",
     *        required=true,
     *        example="2",
     *        @OA\Schema(type="integer")
     *    ),
     *
     *     @OA\Response(
     *          response="200",
     *          description="success",
     *          @OA\JsonContent(
     *           @OA\Property(property="productId", type="integer",
     *          example="Products quantity")
     *              )
     *       )
     *     )
     * )
     */
    public function post(string $id, ?int $n = 1): string
    {
        return $this -> itemHandler($id, function(string $k) use ($n) {
            if (!isset($this -> items[$k]))
                $this -> items[$k] = $n;
            else $this -> items[$k] += $n;
        });
    }

    /**
     * @OA\Delete(
     *     path="/api/basket/{id}",
     *     description="Delete product in basket",
     *     tags={"basket"},
     *     summary="Delete",
     *
     *      @OA\Parameter(
     *        description="Product Id",
     *        in="path",
     *        name="id",
     *        required=true,
     *        example="1",
     *        @OA\Schema(type="integer")
     *    ),
     *
     *     @OA\Response(
     *          response="200",
     *          description="success",
     *          @OA\JsonContent(
     *           @OA\Property(property="productId", type="integer",
     *          example="Products quantity")
     *              )
     *       )
     *     )
     * )
     */
    public function delete(string $id): string
    {
        return $this -> itemHandler($id, function(string $k) {
            if (isset($this -> items[$k]))
                unset($this -> items[$k]);
            else throw new ApiException('404');
        });
    }

    /**
     * @OA\Patch(
     *     path="/api/basket/{id}/{n}",
     *     description="Update product in basket",
     *     tags={"basket"},
     *     summary="Update",
     *
     *      @OA\Parameter(
     *        description="Product Id",
     *        in="path",
     *        name="id",
     *        required=true,
     *        example="1",
     *        @OA\Schema(type="integer")
     *    ),
     *
     *      @OA\Parameter(
     *        description="Quantity of product",
     *        in="path",
     *        name="n",
     *        required=true,
     *        example="2",
     *        @OA\Schema(type="integer")
     *    ),
     *
     *     @OA\Response(
     *          response="200",
     *          description="success",
     *          @OA\JsonContent(
     *           @OA\Property(property="productId", type="integer",
     *          example="Products quantity")
     *              )
     *       )
     *     )
     * )
     */
    public function patch(string $id, int $n): string {
        return $this -> itemHandler($id, function(string $k) use ($n) {
            if (!isset($this -> items[$k]))
                throw new ApiException('404');
            else $this -> items[$k] = $n;
        });
    }


}
