<?php

namespace App\Http\Controllers;

use App\Http\Requests\ServiceRequest;
use App\Models\ServicesOrder;
use App\Models\Service;
use App\Services\TranslateService;
use Illuminate\Http\Request;

class ServiceController extends Controller
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
     *     path="/api/services/{locale?}",
     *     description="Getting services",
     *     tags={"service"},
     *     summary="Service Page",
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
      $services = $this->translate_service->translate(
          $locale, Service::with('examples')->orderByDesc('created_at')->get(), Service::class
      );

      return response()->json(compact('services'), 200);
  }

    /**
     * @OA\Post(
     *     path="/api/service/request",
     *     description="Create service request",
     *     tags={"service"},
     *     summary="Program Page",
     *
     *      @OA\RequestBody(
     *       required=true,
     *       description="Pass params",
     *       @OA\JsonContent(
     *          required={"service_id", "name", "phone", "email"},
     *          @OA\Property(property="service_id", type="string",  example="1"),
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

    public function store(ServiceRequest $request)
    {
        ServicesOrder::create([
            'service_id' => $request['service_id'],
            'name' => $request['name'],
            'phone' => $request['phone'],
            'email' => $request['email']
        ]);

        return response()->json(['success' => 'success'], 201);
    }


}

