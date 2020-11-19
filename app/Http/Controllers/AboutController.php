<?php

namespace App\Http\Controllers;

use App\Models\Ambassador;
use App\Models\Page;
use App\Models\Partner;
use Illuminate\Http\Request;

class AboutController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return false|string
     */
    public function index()
    {
        $texts = Page::with('viewTexts')->where('page_key', 'about')->first();
//        dd($texts->viewTexts[0]->images);
        $ambassadors = Ambassador::orderByDesc( 'created_at' )->get();
        $partners    = Partner::orderByDesc( 'created_at' )->get();

//        return view( 'about', compact( 'ambassadors', 'partners', 'texts' ) );

        return json_encode([
            'texts' => $texts,
            'ambassadors' => $ambassadors,
            'partners' => $partners
            ]);
    }
}
