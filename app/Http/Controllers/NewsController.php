<?php

namespace App\Http\Controllers;

use App\Models\News;
use Illuminate\Http\Request;

class NewsController extends Controller
{

  /**
   * Display a listing of the resource.
   *
   * @return
   */
  public function index()
  {
      $news = News::orderByDesc('created_at')->get();

      return json_encode(compact('news'));

//      return view('news', compact('news'));
  }


}

