<?php

namespace App\Http\Controllers;

use App\Models\Partner;
use App\Services\TranslateService;
use Illuminate\Http\Request;

class PartnerController extends Controller
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
     *     path="/api/partners/{locale?}",
     *     description="Getting partners",
     *     tags={"partner"},
     *     summary="List of partners",
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
     *           @OA\Property(property="partners", type="array",
     *                @OA\Items(
     *                      @OA\Property(property="id", type="integer"),
     *                      @OA\Property(property="description", type="string"),
     *                      @OA\Property(property="image", type="string"),
     *                      @OA\Property(property="image_type", type="string"),
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
        return $this->translateService->translate($locale, Partner::get(), Partner::class);
    }
}
