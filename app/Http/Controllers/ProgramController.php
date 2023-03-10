<?php

namespace App\Http\Controllers;

use App\Models\Program;
use App\Models\ProgramRequest;
use App\Http\Requests\ProgramRequest as ProgramRequestValidation;
use App\Services\TranslateService;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ProgramController extends Controller
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
     *     path="/api/programs/{locale?}",
     *     description="Getting programs",
     *     tags={"program"},
     *     summary="Program Page",
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
     *           @OA\Property(property="programs", type="array",
     *                @OA\Items(
     *                      @OA\Property(property="id", type="integer"),
     *                      @OA\Property(property="name", type="string"),
     *                      @OA\Property(property="description", type="string"),
     *                      @OA\Property(property="images", type="string"),
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

        $programs = $this->translate_service->translate($locale, Program::orderByDesc('created_at')->get(), Program::class)
                                            ->toArray();

        return response()->json($programs, 200);

    }


    /**
     * @OA\Post(
     *     path="/api/program/request",
     *     description="Create program request",
     *     tags={"program"},
     *     summary="Program Page",
     *
     *      @OA\RequestBody(
     *       required=true,
     *       description="Pass params",
     *       @OA\JsonContent(
     *          required={"program_id", "name", "phone", "email"},
     *          @OA\Property(property="program_id", type="string",  example="1"),
     *          @OA\Property(property="name", type="string", format="string", example="Arsen"),
     *          @OA\Property(property="phone", type="string", example="380645564545"),
     *          @OA\Property(property="email", type="string", format="email", example="user1@mail.com"),
     *           ),
     *      ),
     *
     *     @OA\Response(
     *          response="201",
     *          description="success",
     *     )
     * )
     */

    public function store(ProgramRequestValidation $request)
    {
        ProgramRequest::create([
            'program_id' => $request['program_id'],
            'name' => $request['name'],
            'phone' => $request['phone'],
            'email' => $request['email']
        ]);

        return response()->json(['success' => 'success'], 201);
    }



}

