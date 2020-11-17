<?php 

namespace App\Http\Controllers;

use App\Models\News;
use Illuminate\Http\Request;

class NewsController extends Controller 
{

  /**
   * Display a listing of the resource.
   *
   * @return Response
   */
  public function index()
  {
      $news = News::orderByDesc('created_at')->get();

      return view('news', compact('news'));
  }

  
}

