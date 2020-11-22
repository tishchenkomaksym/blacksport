<?php

namespace App\Http\Controllers;

use App\Models\News;
use App\Models\Program;
use App\Models\Service;
use App\Services\TranslateService;
use Carbon\Carbon;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;

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
     *       )
     *     )
     * )
     */
    public function index($locale = null)
    {
        $news = $this->translate_service->translate($locale, News::whereBetween('created_at', [Carbon::now()->subDays(30)->toDateTime()->format('Y-m-d H:i:s'),now()->format('Y-m-d H:i:s')])
                    ->orderByDesc('created_at')->limit(5)->get(), News::class);
        $services = $this->translate_service->translate($locale, Service::all(), Service::class);
        $programs = $this->translate_service->translate($locale, Program::orderByDesc('created_at')->get(), Program::class);

        return json_encode([
            'news' => $news,
            'services' => $services,
            'programs' => $programs
        ]);
    }

    public function main()
    {
        return view('main');
    }
}
