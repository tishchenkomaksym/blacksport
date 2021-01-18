<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Services\TranslateService;

class CategoryController extends Controller
{
    /**
     * @var TranslateService
     */
    private $translateService;

    public function __construct(TranslateService $translateService)
    {

        $this->translateService = $translateService;
    }

    /**
     * @OA\Get(
     *     path="/api/categories/{locale?}",
     *     description="Getting categories",
     *     tags={"category"},
     *     summary="List of category",
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
     *           @OA\Property(property="categories", type="array",
     *                @OA\Items(
     *                      @OA\Property(property="id", type="integer"),
     *                      @OA\Property(property="name", type="string"),
     *                      @OA\Property(property="url", type="string"),
     *                      @OA\Property(property="image", type="string"),
     *                      @OA\Property(property="created_at", type="string"),
     *                      @OA\Property(property="updated_at", type="string")
     *                  )
     *              )
     *       )
     *     )
     * )
     */
    public function index($locale =null)
    {
        $categories = $this->translateService->translate($locale, Category::get(), Category::class)->toArray();

        return response()->json($categories, 200);
    }
}
