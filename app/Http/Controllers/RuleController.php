<?php

namespace App\Http\Controllers;

use App\Models\Page;
use Illuminate\Http\Request;

class RuleController extends Controller
{
    /**
     * @OA\Get(
     *      path="/api/term_condition_first",
     *      tags={"rule"},
     *      summary="Rule",
     *      description="Getting first rule",
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
    public function termConditionFirst()
    {
        $page = Page::where('page_key', 'term_condition_first')->get();
        return response()->json($page, 200);
    }

    /**
     * @OA\Get(
     *      path="/api/term_condition_second",
     *      tags={"rule"},
     *      summary="Rule",
     *      description="Getting second rule",
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
    public function termConditionSecond()
    {
        $page = Page::where('page_key', 'term_condition_second')->get();
        return response()->json($page, 200);
    }
}
