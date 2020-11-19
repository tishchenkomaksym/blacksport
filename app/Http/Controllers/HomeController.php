<?php

namespace App\Http\Controllers;

use App\Models\News;
use App\Models\Program;
use App\Models\Service;
use Carbon\Carbon;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {

    }


    public function vue() {
        return view('vue');
    }


    /**
     * Show the application dashboard.
     *
     * @return false|string
     */
    public function index()
    {
//        $news = Program::orderByDesc('created_at')->get();
        $news = News::whereBetween('created_at', [Carbon::now()->subDays(30)->toDateTime()->format('Y-m-d H:i:s'),now()->format('Y-m-d H:i:s')])
                    ->orderByDesc('created_at')->limit(5)->get();
        $services = Service::all();
        $programs = Program::orderByDesc('created_at')->get();

        return json_encode([
            'news' => $news,
            'services' => $services,
            'programs' => $programs
        ]);
//        return view('home', compact('news', 'services', 'programs'));
    }

    public function main()
    {
        return view('main');
    }
}
