<?php

namespace App\Http\Controllers;

use App\Models\News;
use App\Models\Program;
use App\Models\Service;
use App\Services\TranslateService;
use Carbon\Carbon;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * @var TranslateService
     */
    private $translate_service;

    /**
     * Create a new controller instance.
     *
     * @param TranslateService $translate_service
     */
    public function __construct(TranslateService $translate_service)
    {

        $this->translate_service = $translate_service;
    }


    public function vue() {
        return view('vue');
    }


    /**
     * Show the application dashboard.
     *
     * @param null $locale
     *
     * @return false|string
     */
    public function index($locale = null)
    {
        $news = $this->translate_service->translate($locale, News::whereBetween('created_at', [Carbon::now()->subDays(30)->toDateTime()->format('Y-m-d H:i:s'),now()->format('Y-m-d H:i:s')])
                    ->orderByDesc('created_at')->limit(5)->get(), News::class);
        $services = $this->translate_service->translate($locale, Service::all(), Service::class);
        $programs = $this->translate_service->translate($locale, Program::orderByDesc('created_at')->get(), Program::class);

        return json_encode([
            'news' => $news,
            'services' => $services,
            'programs' => $programs
        ]);
    }

    public function main()
    {
        return view('main');
    }
}
