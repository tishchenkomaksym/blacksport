<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Services\TranslateService;
use Illuminate\Http\Request;

class ProductController extends Controller
{

    /**
     * @var TranslateService
     */
    private $translate_service;

    public function __construct(TranslateService $translate_service)
    {

        $this->translate_service = $translate_service;
    }

    /**
     * @OA\Get(
     *     path="/api/products/{locale?}",
     *     description="Getting products",
     *     tags={"products"},
     *     summary="Products",
     *      @OA\Parameter(
     *        description="Language",
     *        in="path",
     *        name="Locale",
     *        required=false,
     *        example="ru, en, uk",
     *        @OA\Schema(type="string")
     *    ),
     *     @OA\Response(
     *          response="200",
     *          description="success",
     *          @OA\JsonContent(
     *           @OA\Property(property="news", type="array",
     *                @OA\Items(
     *                      @OA\Property(property="id", type="integer"),
     *                      @OA\Property(property="description", type="string"),
     *                      @OA\Property(property="specifications", type="string"),
     *                      @OA\Property(property="price", type="int"),
     *                      @OA\Property(property="image", type="string"),
     *                      @OA\Property(property="category_id", type="int"),
     *                      @OA\Property(property="created_at", type="string"),
     *                      @OA\Property(property="updated_at", type="string")
     *                  )
     *              )
     *       )
     *     )
     * )
     */
    public function index($locale = null)
    {
        $products = Product::orderByDesc('created_at')->get();
        $products = $this->translate_service->translate($locale, $products, Product::class)->toArray();
        return json_encode(compact('products'));

    }


}
