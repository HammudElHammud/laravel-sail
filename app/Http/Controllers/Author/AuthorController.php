<?php

namespace App\Http\Controllers\Author;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreAuthorRequest;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Session;
use Psr\Container\ContainerExceptionInterface;
use Psr\Container\NotFoundExceptionInterface;

class AuthorController extends Controller
{
    /**
     * @param int $authorId
     * @return Application|Factory|View|void
     * @throws ContainerExceptionInterface
     * @throws NotFoundExceptionInterface
     */
    public function show(int $authorId)
    {
        $result = Http::withToken(session()->get('token'))
            ->get(env('API_BASE_URL') . '/api/v2/authors/' . $authorId);
        if ($result->status() === 200) {
            $author = $result->json();
            return view('author.author', compact('author'));
        } else {
            abort($result->status());
        }
    }


    /**
     * @param StoreAuthorRequest $request
     * @return RedirectResponse|Session
     * @throws ContainerExceptionInterface
     * @throws NotFoundExceptionInterface
     */
    public function store(StoreAuthorRequest $request): RedirectResponse|Session
    {
        $data = $request->validated();

        $result = Http::withToken(session()->get('token'))
            ->post(env('API_BASE_URL') . '/api/v2/authors', $data);
        if ($result->status() === 200) {
            $storeAuthorResponse = $result->json();
            session()->flash('success', 'Create author successfully');
        } else {
            session()->flash('error', 'Author Not Created');
        }
        return redirect()->route('home');
    }

    /**
     * @param int $authorId
     * @return RedirectResponse
     * @throws ContainerExceptionInterface
     * @throws NotFoundExceptionInterface
     */
    public function delete(int $authorId): RedirectResponse
    {
        $result = Http::withToken(session()->get('token'))
            ->get(env('API_BASE_URL') . '/api/v2/authors/' . $authorId);

        if ($result->status() === 200){
        if (empty($result['books'])) {
            $deleteResponse = Http::withToken(session()->get('token'))
                ->delete(env('API_BASE_URL') . '/api/v2/authors/' . $authorId)
                ->json();
            if (!isset($deleteResponse['status'])) {
                session()->flash('success', 'Author Deleted successfully');
                return redirect()->back();
            } else {
                session()->flash('error', 'Author Not Deleted');
                return redirect()->back();
            }
        } else {
            session()->flash('error', 'Author Has Books Can Not Be Deleted');
            return redirect()->back();
        }}else{
            abort($result->status());
        }
    }
}
