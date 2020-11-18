<?php

namespace App\Http\Controllers;

use App\Models\News;
use App\Models\Program;
use App\Models\Service;
use Carbon\Carbon;
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

    }


    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
//        $news = Program::orderByDesc('created_at')->get();
        $news = News::whereBetween('created_at', [Carbon::now()->subDays(30)->toDateTime()->format('Y-m-d H:i:s'),now()->format('Y-m-d H:i:s')])
                    ->orderByDesc('created_at')->limit(5)->get();
        $services = Service::all();
        $programs = Program::orderByDesc('created_at')->get();
        return view('home', compact('news', 'services', 'programs'));
    }

    public function main()
    {
        return view('main');
    }
}
