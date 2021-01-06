<?php

namespace App\Http\Controllers;

use App\Models\Program;
use App\Models\ProgramRequest;
use App\Services\TranslateService;
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

    return json_encode(compact('programs'));

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
     *          response="200",
     *          description="success",
     *     ),
     *     @OA\Response(
     *          response="403",
     *          description="error, User with this phone or email already exist",
     *          @OA\Property(property="phone", type="string"),
     *          @OA\Property(property="email", type="string"),
     *     ),
     *
     * )
     */

    public function store(Request $request)
    {
        if (!empty(ProgramRequest::where('phone')->get()->toArray())){
            return response()->json(['error' => 'User with this phone already exist'], 401);
        }
        if (!empty(ProgramRequest::where('email')->get()->toArray())){
            return response()->json(['error' => 'User with this email already exist'], 401);
        }
        ProgramRequest::create([
            'program_id' => $request['program_id'],
            'name' => $request['name'],
            'phone' => $request['phone'],
            'email' => $request['email']
        ]);

        return response()->json(['success' => 'success'], 200);
    }



}

