<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class BookController extends Controller
{
    use AuthorizesRequests;

    public function index(Request $request): View
    {
        $booksPending = $request->user()->books()->where('is_read', false)->get();
        return view('books.index', compact('booksPending'));
    }

    public function readBooks(Request $request): View
    {
        $booksRead = $request->user()->books()->where('is_read', true)->get();
        return view('books.read', compact('booksRead'));
    }

    public function create(): View
    {
        return view('books.create');
    }

    public function show(Book $book): View
    {
        return view('books.show', compact('book'));
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'author' => 'required|string|max:255',
            'publication_year' => 'required|integer|min:1000|max:9999',
            'synopsis' => 'required|string',
            'cover_url' => 'nullable|url',
            'is_read' => 'boolean',
        ]);

        $request->user()->books()->create($validated);

        return redirect()->route('books.index');
    }

    public function edit(Book $book): View
    {
        $this->authorize('update', $book);
        return view('books.edit', compact('book'));
    }

    public function update(Request $request, Book $book): RedirectResponse
    {
        $this->authorize('update', $book);

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'author' => 'required|string|max:255',
            'publication_year' => 'required|integer|min:1000|max:9999',
            'synopsis' => 'required|string',
            'cover_url' => 'nullable|url',
            'is_read' => 'boolean',
        ]);

        $book->update($validated);

        return redirect()->route('books.index');
    }

    public function destroy(Book $book): RedirectResponse
    {
        $this->authorize('delete', $book);
        $book->delete();

        return redirect()->route('books.index');
    }

    public function toggleReadStatus(Book $book): RedirectResponse
    {
        $this->authorize('update', $book);

        $book->is_read = !$book->is_read;
        $book->save();

        return redirect()->route('books.index');
    }
}
