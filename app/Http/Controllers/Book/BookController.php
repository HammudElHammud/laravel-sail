<?php

namespace App\Http\Controllers\Book;

use App\Http\Controllers\Controller;
use App\Http\Requests\BookStoreRequest;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Http;
use Psr\Container\ContainerExceptionInterface;
use Psr\Container\NotFoundExceptionInterface;

class BookController extends Controller
{
    /**
     * @return Factory|View|Application
     * @throws ContainerExceptionInterface
     * @throws NotFoundExceptionInterface
     */
    public function create(): Factory|View|Application
    {
        $result = Http::withToken(session()->get('token'))
            ->get(env('API_BASE_URL') . '/api/v2/authors?limit=200');
        if ($result->status() === 200) {
            $authors = $result['items'];

            return view('book.create', compact('authors'));

        } else {
            abort($result->status());
        }
    }


    /**
     * @param BookStoreRequest $request
     * @return RedirectResponse
     * @throws ContainerExceptionInterface
     * @throws NotFoundExceptionInterface
     */
    public function store(BookStoreRequest $request): RedirectResponse
    {
        $data = $request->validated();
        $data['author'] = ['id' => (int)$request->get('author')];
        $data['number_of_pages'] = (int)$request->get('number_of_pages');
        $result = Http::withToken(session()->get('token'))->post(env('API_BASE_URL')
            . '/api/v2/books', $data);
        if ($result->status() === 200) {
            session()->flash('success', 'Create books successfully');

            return redirect()->route('author.view', $request->get('author'));
        } else {
            session()->flash('error', 'Book Not Created');

            return redirect()->back();
        }
    }

    /**
     * @param int $id
     * @param int $author_id
     * @return RedirectResponse
     * @throws ContainerExceptionInterface
     * @throws NotFoundExceptionInterface
     */
    public function delete(int $id, int $author_id): RedirectResponse
    {
        $book = Http::withToken(session()->get('token'))->delete(env('API_BASE_URL') . '/api/v2/books/' . $id);
        if (!isset($book['status'])) {
            session()->flash('success', 'Remove Successfully');
            return redirect()->route('author.view', $author_id);
        }
        else {
            session()->flash('error', 'Book Not Found');
            return redirect()->back();
        }
    }
}
