<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use Illuminate\Http\Request;

class ContactController extends Controller
{

/**
 * @OA\Get(
 *      path="/api/contacts",
 *      tags={"contacts"},
 *      summary="Contacts",
 *      description="Getting Contacts",
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
  public function index()
  {
      $contacts = Contact::all();
      foreach ($contacts as $key => $contact){
          $exploded = explode(',', $contact->social_links);
          $contacts[$key]->social_links = $exploded;
      }
      return $contacts->toJson();
  }


}
