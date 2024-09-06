<?php

namespace App\Http\Controllers;

use App\Http\Request\StoreAuthorBookRequest;
use App\Http\Request\StoreAuthorRequest;
use App\Http\Request\UpdateAuthorRequest;
use App\Models\Author;
use App\Models\Book;
use Illuminate\Http\Request;

class AuthorController extends Controller
{
    public function index()
    {
        $author = Author::all();

        return view('author.index', compact('author'));
    }

    public function allAuthors()
    {
        $author = Author::all();

        return view('author.all', compact('author'));
    }

    public function create()
    {
        return view('author.create');
    }

    public function store(StoreAuthorRequest $request)
    {
        $author = Author::create([
            'surname' => $request->surname,
            'name' => $request->name,
            'middle_name' => $request->middle_name
        ]);

        return redirect()->route('author.all');
    }

    public function show(Author $author)
    {
        return view('author.show', compact('author'));
    }

    public function edit(Author $authors)
    {
        return view('author.edit', compact('authors'));
    }

    public function update(UpdateAuthorRequest $request, Author $author)
    {
        $author->update([
            'surname' => $request->surname,
            'name' => $request->name,
            'middle_name' => $request->middle_name
        ]);

        return redirect()->route('author.all');
    }

    public function destroy(Author $author)
    {
        $author->delete();

        return redirect()->route('author.all');
    }
}
