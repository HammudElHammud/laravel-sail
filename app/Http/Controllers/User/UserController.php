<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Http;

class UserController extends Controller
{
    public function profile(): Factory|View|Application
    {
        $result = Http::withToken(session()->get('token'))
            ->get(env('API_BASE_URL') . '/api/v2/users/' . session()->get('user_id'));

        if ($result->status() === 200) {
         $user = $result->json();
            return view('user.profile', compact('user'));
        } else {
            abort($result->status());
        }
    }
}
