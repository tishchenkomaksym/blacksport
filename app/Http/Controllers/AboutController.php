<?php

namespace App\Http\Controllers;

use App\Models\Ambassador;
use App\Models\Page;
use App\Models\Partner;
use App\Services\TranslateService;
use Illuminate\Http\Request;

class AboutController extends Controller
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
     * Display a listing of the resource.
     *
     * @param $locale
     *
     * @return false|string
     */
    public function index($locale = null)
    {
//
        $texts = Page::with('viewTexts')->where('page_key', 'about')->first();
        $ambassadors = Ambassador::orderByDesc( 'created_at' )->get();
        $partners    = Partner::orderByDesc( 'created_at' )->get();
        list($texts, $ambassadors, $partners) = $this->translateService->translateAbout($locale, $texts, $ambassadors, $partners);

        return json_encode([
            'texts' => $texts,
            'ambassadors' => $ambassadors,
            'partners' => $partners
            ]);
    }
}
