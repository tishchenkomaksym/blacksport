<?php

namespace App\Http\Controllers;

use App\Models\Page;
use App\Services\TranslateService;
use Illuminate\Http\Request;

class RuleController extends Controller
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
     *      path="/api/terms_conditions",
     *      tags={"rule"},
     *      summary="Rule",
     *      description="Getting terms_conditions",
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
     *       )
     *     )
     *  )
     */
    public function termConditions($locale = null)
    {
        $page = $this->translateService->translate($locale, Page::with('viewTexts')
                                                        ->where('page_key', 'terms_conditions')->get(), Page::class);

        return response()->json($page, 200);
    }

    /**
     * @OA\Get(
     *      path="/api/refund_policy",
     *      tags={"rule"},
     *      summary="Rule",
     *      description="Getting refund_policy",
     *
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
     *       )
     *     )
     *  )
     */
    public function refundPolicy($locale = null)
    {

        $page = $this->translateService->translate($locale, Page::with('viewTexts')
                                                                ->where('page_key', 'refund_policy')->get(), Page::class);
        return response()->json($page, 200);
    }
}
