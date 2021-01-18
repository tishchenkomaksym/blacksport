<?php

namespace App\Http\Controllers;

use App\Models\Achievement;
use App\Models\Ambassador;
use App\Models\Order;
use App\Models\Page;
use App\Models\Partner;
use App\Models\Product;
use App\Services\TranslateService;
use Illuminate\Http\Request;

class AboutController extends Controller
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
     *      path="/api/about/{locale?}",
     *      tags={"about"},
     *      summary="About Page",
     *      description="Getting Ambassadors, Partners, Texts",
     *      @OA\Parameter(
     *        description="Language",
     *        in="path",
     *        name="Locale",
     *        required=false,
     *        example="ru, en, uk",
     *        @OA\Schema(type="string")
     *    ),
     *  @OA\Response(
     *          response="200",
     *          description="success",
     *          @OA\JsonContent(
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
     *              ),
     *           @OA\Property(property="ambassadors", type="array",
     *                @OA\Items(
     *                      @OA\Property(property="id", type="integer"),
     *                      @OA\Property(property="description", type="string"),
     *                      @OA\Property(property="image", type="string"),
     *                      @OA\Property(property="created_at", type="string"),
     *                      @OA\Property(property="updated_at", type="string")
     *                  )
     *              ),
 *              @OA\Property(property="partners", type="array",
     *                @OA\Items(
     *                      @OA\Property(property="id", type="integer"),
     *                      @OA\Property(property="description", type="string"),
     *                      @OA\Property(property="image", type="string"),
     *                      @OA\Property(property="created_at", type="string"),
     *                      @OA\Property(property="updated_at", type="string")
     *                  )
     *              ),
     *              @OA\Property(property="achievements", type="array",
     *                @OA\Items(
     *                      @OA\Property(property="id", type="integer"),
     *                      @OA\Property(property="title", type="string"),
     *                      @OA\Property(property="description", type="string"),
     *                      @OA\Property(property="created_at", type="string"),
     *                      @OA\Property(property="updated_at", type="string")
     *                  )
     *              ),
     *       )
     *     )
     *  )
     */
    public function index($locale = null)
    {
//        dd(Page::with('viewTexts')
//               ->whereIn('page_key', ['made', 'partners', 'ambassadors'])->get());
        $texts = $this->translateService->translate($locale, Page::with('viewTexts')
                                         ->whereIn('page_key', ['made', 'partners', 'ambassadors'])->get(), Page::class);
        $ambassadors = Ambassador::orderByDesc( 'created_at' )->get();
        $partners    = Partner::orderByDesc( 'created_at' )->get();
        list($ambassadors, $partners) = $this->translateService->translateAbout($locale, $ambassadors, $partners);
        $achievements = $this->translateService->translate($locale, Achievement::orderByDesc('created_at')->get(), Achievement::class);

        return response()->json([
                'texts' => $texts->toArray() ?? [],
                'ambassadors' => $ambassadors->toArray() ?? [],
                'partners' => $partners->toArray() ?? [],
                'achievements' => $achievements->toArray() ?? []
            ], 200);
    }
}
