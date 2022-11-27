<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\AuthLoginRequest;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Session;

class AuthController extends Controller
{
    /**
     * @return View|Factory|Application|RedirectResponse
     */
    public function index(): View|Factory|Application|RedirectResponse
    {
        if (session('token')) {
            return redirect()->route('home');
        }
        return view('auth.login');

    }


    /**
     * @param AuthLoginRequest $request
     * @return RedirectResponse|Session
     */
    public function login(AuthLoginRequest $request): RedirectResponse|Session
    {
        $data = $request->validated();

        $responseData = Http::post(env('API_BASE_URL') . '/api/v2/token', $data);
        if (!isset($responseData['status'])) {
            session()->put([
                'first_name' => $responseData['user']['first_name'],
                'last_name' => $responseData['user']['last_name'],
                'user_id' => $responseData['user']['id'],
                'token' => $responseData['token_key'],
            ]);
            return redirect()->route('home');
        }
        session()->flash('error', 'Invalid email or password');
        return redirect()->back();

    }

    /**
     * @return RedirectResponse
     */
    public function logout(): RedirectResponse
    {

        session()->flush();

        return redirect()->route('index');
    }

}
