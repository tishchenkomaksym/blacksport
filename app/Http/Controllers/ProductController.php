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
     *           @OA\Property(property="products", type="array",
     *                @OA\Items(
     *                      @OA\Property(property="id", type="integer"),
     *                      @OA\Property(property="title", type="string"),
     *                      @OA\Property(property="description", type="string"),
     *                      @OA\Property(property="specifications", type="string"),
     *                      @OA\Property(property="price", type="integer"),
     *                      @OA\Property(property="image", type="string"),
     *                      @OA\Property(property="category_id", type="integer"),
     *                      @OA\Property(property="created_at", type="string"),
     *                      @OA\Property(property="updated_at", type="string"),
     *                      @OA\Property(property="categories", type="array",
     *                       @OA\Items(
     *                             @OA\Property(property="id", type="integer"),
     *                             @OA\Property(property="name", type="string"),
     *                             @OA\Property(property="url", type="string"),
     *                             @OA\Property(property="image", type="string"),
     *                             @OA\Property(property="created_at", type="string"),
     *                             @OA\Property(property="updated_at", type="string"),
     *                             @OA\Property(property="show_on_main", type="boolean"),
     *                            )
     *                      )
     *                  )
     *              )
     *       )
     *     )
     * )
     */
    public function index($locale = null)
    {
        $products = Product::with('categories')->orderByDesc('created_at')->get();
        $products = $this->translate_service->translate($locale, $products, Product::class);

        return response()->json($products, 200);

    }

    /**
     * @OA\Get(
     *     path="/api/product/{id}/{locale?}",
     *     description="Getting product",
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
     *           @OA\Property(property="products", type="array",
     *                @OA\Items(
     *                      @OA\Property(property="id", type="integer"),
     *                      @OA\Property(property="title", type="string"),
     *                      @OA\Property(property="description", type="string"),
     *                      @OA\Property(property="specifications", type="string"),
     *                      @OA\Property(property="price", type="integer"),
     *                      @OA\Property(property="image", type="string"),
     *                      @OA\Property(property="category_id", type="integer"),
     *                      @OA\Property(property="created_at", type="string"),
     *                      @OA\Property(property="updated_at", type="string"),
     *                      @OA\Property(property="show_on_main", type="boolean"),
     *                  )
     *              )
     *       )
     *     )
     * )
     */
    public function show($id, $locale = null)
    {
        $products = Product::with('categories')->where('id', $id)->get();
        $products = $this->translate_service->translate($locale, $products, Product::class);

        return response()->json($products, 200);
    }


    /**
     * @OA\Get(
     *     path="/api/product_category/{categoryId}/{locale?}",
     *     description="Getting category product",
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
     *           @OA\Property(property="products", type="array",
     *                @OA\Items(
     *                      @OA\Property(property="id", type="integer"),
     *                      @OA\Property(property="title", type="string"),
     *                      @OA\Property(property="description", type="string"),
     *                      @OA\Property(property="specifications", type="string"),
     *                      @OA\Property(property="price", type="integer"),
     *                      @OA\Property(property="image", type="string"),
     *                      @OA\Property(property="category_id", type="integer"),
     *                      @OA\Property(property="created_at", type="string"),
     *                      @OA\Property(property="updated_at", type="string"),
     *                      @OA\Property(property="show_on_main", type="boolean"),
     *                  )
     *              )
     *       )
     *     )
     * )
     */
    public function productCategoryFilter($categoryId, $locale = null)
    {
        $products = Product::with('categories')->where('category_id', $categoryId)->get();
        $products = $this->translate_service->translate($locale, $products, Product::class);

        return response()->json($products, 200);
    }
}
