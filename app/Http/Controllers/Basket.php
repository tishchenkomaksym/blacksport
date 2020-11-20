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



    private static function deletedProductStub(string $id): array {
        return [
            'id' => '0',
            'is_offer' => FALSE,
            'name' => 'Deleted',
            'price' => 'Deleted',
            'img' => 'Deleted',
            'quantity' => 'Deleted',
            'url' => $id
        ];
    }

    public static function getClassByType(string $type): string {
        return $type == 'instruments' ? Instrument::class : Offer::class;
    }

    private static function productsBlock(string $type, int $id, int $count): array {
        $class = self::getClassByType($type);

        /** @noinspection PhpUndefinedMethodInspection */
        $product = $class::withTrashed() -> where('id', $id) -> first();
        if(!$product)
            throw new ApiException(500,'No '.$type);

        self::localize($product, ['title'], LaravelLocalization::getCurrentLocale());
        return [
            'id' => $product -> id,
            'is_offer' => $product instanceof Offer,
            'name' => $product -> title,
            'price' => $product -> price,
            'img' => '/storage/'.$product -> img,
            'img_thumb' => '/storage/'.$product -> catalogImage(),
            'quantity' => $count,
            'url' => $product -> url
        ];
    }

    private static function analyzeProductCard(string $type, int $id, int $count): array {
        try {
            return self::productsBlock($type, $id, $count);
        } catch (ApiException $exception) {
            return self::deletedProductStub($id);
        }
    }

    public static function structurizeCheckout(array $items) {
        $ret = [];
        foreach ($items as $key => $count) {
            list($type, $id) = explode('|', $key);
            if (!isset($ret[$type]))
                $ret[$type] = [];
            $ret[$type][$id] = static::analyzeProductCard($type, $id, $count);
        }
        return $ret;
    }
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
        return self::structurizeCheckout($this -> items);
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

    protected function get(): string {
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


    public function post(string $id, ?int $n = 1): string
    {
        return $this -> itemHandler($id, function(string $k) use ($n) {
            if (!isset($this -> items[$k]))
                $this -> items[$k] = $n;
            else $this -> items[$k] += $n;
        });
    }

    public function delete(string $id): string
    {
        return $this -> itemHandler($id, function(string $k) {
            if (isset($this -> items[$k]))
                unset($this -> items[$k]);
            else throw new ApiException('404');
        });
    }

    public function patch(string $id, int $n): string {
        return $this -> itemHandler($id, function(string $k) use ($n) {
            if (!isset($this -> items[$k]))
                throw new ApiException('404');
            else $this -> items[$k] = $n;
        });
    }


}
