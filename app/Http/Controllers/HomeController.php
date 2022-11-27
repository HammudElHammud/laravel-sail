<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class HomeController extends Controller
{
    /**
     * @param Request $request
     * @return Factory|View|Application
     */
    public function index(Request $request): Factory|View|Application
    {
        $page = 1;
        if (!is_null($request->get('page'))) {
            $page = $request->get('page');
        }

        $result = Http::withToken(session()->get('token'))
            ->get( env('API_BASE_URL').'/api/v2/authors?page=' . (int) $page);
        if ($result->status() === 200) {
            $authorsResponse = $result->json();
            return view('home', compact('page', 'authorsResponse'));
        } else {
            abort($result->status());
        }
    }
}
