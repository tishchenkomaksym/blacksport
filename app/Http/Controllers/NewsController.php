<?php

namespace App\Http\Controllers;

use App\Models\News;
use App\Services\TranslateService;
use Illuminate\Http\Request;

class NewsController extends Controller
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
     *                  )
     *              )
     *       )
     *     )
     * )
     */
  public function index($locale = null)
  {
      $news = News::orderByDesc('created_at')->get();
      $news = $this->translate_service->translate($locale, $news, News::class)->toArray();
      return json_encode(compact('news'));

  }


}

