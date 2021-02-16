<?php

namespace App\Http\Controllers;

use App\Models\News;
use App\Services\NewsService;
use App\Services\TranslateService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class NewsController extends Controller
{

    /**
     * @var TranslateService
     */
    private $translate_service;
    /**
     * @var NewsService
     */
    private $news_service;

    public function __construct(TranslateService $translate_service, NewsService $news_service)
    {

        $this->translate_service = $translate_service;
        $this->news_service = $news_service;
    }

    /**
     * @OA\Get(
     *     path="/api/news/{locale?}",
     *     description="Getting news",
     *     tags={"news"},
     *     summary="News Page",
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
     *                      @OA\Property(property="hide_date", type="boolean"),
     *                  )
     *              )
     *       )
     *     )
     * )
     */
    public function index($locale = null)
    {

        $news = News::orderByDesc('created_at')->get();
        $this->news_service->checkCreatedAt($news);

        $news = $this->translate_service->translate($locale, $news, News::class)->toArray();
        return response()->json($news, 200);

    }


    /**
     * @OA\Get(
     *     path="/api/news/{id}/{locale?}",
     *     description="Getting news",
     *     tags={"news"},
     *     summary="News Page",
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
     *              )
     *       )
     *     )
     * )
     */
    public function show($id, $locale = null)
    {
        $news = News::where('id', $id)->get();
        $this->news_service->checkCreatedAtOneNews($news);
        $news = $this->translate_service->translate($locale, $news, News::class);

        return response()->json($news, 200);
    }
}

