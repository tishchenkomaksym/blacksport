<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use App\Services\TranslateService;
use Illuminate\Http\Request;

class ContactController extends Controller
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
 *      path="/api/contacts/{locale?}",
 *      tags={"contacts"},
 *      summary="Contacts",
 *      description="Getting Contacts",
 *      @OA\Parameter(
 *        description="Language",
 *        in="path",
 *        name="Locale",
 *        required=false,
 *        example="ru, en, uk",
 *        @OA\Schema(type="string")
 *    ),
 *
 *  @OA\Response(
 *          response="200",
 *          description="success",
 *          @OA\JsonContent(
 *           @OA\Property(property="contacts", type="array",
 *                @OA\Items(
 *                      @OA\Property(property="id", type="integer"),
 *                      @OA\Property(property="phone", type="string"),
 *                      @OA\Property(property="social_links", type="string"),
 *                      @OA\Property(property="address", type="string")
 *                  )
 *              )
 *       )
 *     )
 *  )
 */
  public function index($locale = null)
  {
      $contacts = Contact::all();
      foreach ($contacts as $key => $contact){
          $exploded = explode(',', $contact->social_links);
          $contacts[$key]->social_links = $exploded;
      }
      $this->translateService->translate($locale, $contacts, Contact::class)->toArray();
      return response()->json($contacts, 200);
  }


}
