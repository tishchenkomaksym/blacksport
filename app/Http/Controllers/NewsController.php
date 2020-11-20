<?php

namespace App\Http\Controllers;

use App\Models\News;
use App\Services\TranslateService;
use Illuminate\Http\Request;

class NewsController extends Controller
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
     * Display a listing of the resource.
     *
     * @param $locale
     *
     * @return false|string
     */
  public function index($locale = null)
  {
      $news = News::orderByDesc('created_at')->get();
      $news = $this->translate_service->translate($locale, $news, News::class);
      return json_encode(compact('news'));

  }


}

