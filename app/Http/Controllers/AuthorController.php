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

        return view('author.index');
    }

    public function allAuthors(Request $request)
    {
        $uniqueNames = Author::select('name')->distinct()->get();
        $query = Author::query();

        if ($request->has('name')) {
            $nameFilter = $request->input('name');
            $query->whereIn('name', $nameFilter);
        }
        $author = $query->get();

        return view('author.all', compact('author', 'uniqueNames'));
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

    public function edit(Author $author)
    {
        return view('author.edit', compact('author'));
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

        return response()->json(['success' => true]);
    }
}
