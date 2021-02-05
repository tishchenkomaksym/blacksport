<?php

namespace App\Http\Controllers;

use App\Models\News;
use App\Models\Product;
use App\Models\Program;
use App\Models\Service;
use App\Models\Page;
use App\Services\TranslateService;
use Carbon\Carbon;


class HomeController extends Controller
{
    /**
     * @var TranslateService
     */
    private $translate_service;

    /**
     * Create a new controller instance.
     *
     * @param TranslateService $translate_service
     */
    public function __construct(TranslateService $translate_service)
    {
        $this->translate_service = $translate_service;
    }


    public function vue() {
        return view('vue');
    }

    /**
     * @OA\Get(
     *     path="/api/home/{locale?}",
     *     description="Getting news, services, programs",
     *     tags={"home"},
     *     summary="Home Page",
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
     *                      @OA\Property(property="title", type="string"),
     *                      @OA\Property(property="description", type="string"),
     *                      @OA\Property(property="images", type="string"),
     *                      @OA\Property(property="created_at", type="string"),
     *                      @OA\Property(property="updated_at", type="string"),
     *                      @OA\Property(property="published", type="string"),
     *                  )
     *              ),
     *           @OA\Property(property="services", type="array",
     *                @OA\Items(
     *                      @OA\Property(property="id", type="integer"),
     *                      @OA\Property(property="name", type="string"),
     *                      @OA\Property(property="description", type="string"),
     *                      @OA\Property(property="created_at", type="string"),
     *                      @OA\Property(property="updated_at", type="string")
     *                  )
     *              ),
     *              @OA\Property(property="programs", type="array",
     *                @OA\Items(
     *                      @OA\Property(property="id", type="integer"),
     *                      @OA\Property(property="name", type="string"),
     *                      @OA\Property(property="description", type="string"),
     *                      @OA\Property(property="images", type="string"),
     *                      @OA\Property(property="created_at", type="string"),
     *                      @OA\Property(property="updated_at", type="string")
     *                  )
     *              ),
     *           @OA\Property(property="products", type="array",
     *                @OA\Items(
     *                      @OA\Property(property="id", type="integer"),
     *                      @OA\Property(property="title", type="string"),
     *                      @OA\Property(property="description", type="string"),
     *                      @OA\Property(property="specifications", type="string"),
     *                      @OA\Property(property="price", type="integer"),
     *                      @OA\Property(property="image", type="string"),
     *                      @OA\Property(property="category_id", type="integer"),
     *                      @OA\Property(property="order_count", type="integer"),
     *                      @OA\Property(property="created_at", type="string"),
     *                      @OA\Property(property="updated_at", type="string")
     *                  )
     *              ),
     *           @OA\Property(property="page", type="array",
     *                @OA\Items(
     *                      @OA\Property(property="id", type="integer"),
     *                      @OA\Property(property="name", type="string"),
     *                      @OA\Property(property="page_key", type="string"),
     *                      @OA\Property(property="meta_description", type="string"),
     *                      @OA\Property(property="noindex", type="integer"),
     *                      @OA\Property(property="nofollow", type="integer"),
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
        $popularProducts = $this->translate_service->translate($locale, Product::where('order_count', '!=', null)
                                  ->orderByDesc('order_count')->limit(20)->get(), Product::class);
        $news = $this->translate_service->translate($locale, News::whereBetween('created_at', [Carbon::now()->subDays(60)->toDateTime()->format('Y-m-d H:i:s'),now()->format('Y-m-d H:i:s')])
                    ->orderByDesc('created_at')->limit(10)->get(), News::class);

        $services = $this->translate_service->translate($locale, Service::all(), Service::class);
        $programs = $this->translate_service->translate($locale, Program::orderByDesc('created_at')->get(), Program::class);
        $texts = $this->translate_service->translate($locale, Page::with('viewTexts')->where('page_key', 'home')->get(), Page::class);

        return response()->json([
            'news' => $news->toArray() ?? [],
            'services' => $services->toArray() ?? [],
            'programs' => $programs->toArray() ?? [],
            'popular_products' => $popularProducts->toArray() ?? [],
            'texts' => $texts->toArray() ?? []
        ], 200);
    }

    public function main()
    {
        return view('main');
    }
}
