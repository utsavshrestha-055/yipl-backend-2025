<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Author;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class BooksController extends Controller
{
    public function index(Request $request)
    {
        $query = Book::with('author');

        if ($request->filled('title')) {
            $query->where('title', 'like', '%' . $request->input('title') . '%');
        }

        if ($request->filled('author')) {
            $query->whereHas('author', function ($q) use ($request) {
                $q->where('name', 'like', '%' . $request->input('author') . '%');
            });
        }

        if ($request->filled('year')) {
            $query->where('published_year', $request->input('year'));
        }

        $sort = in_array($request->input('sort'), ['title','published_year','created_at']) ? $request->input('sort') : 'created_at';
        $order = strtolower($request->input('order', 'desc')) === 'asc' ? 'asc' : 'desc';
        $query->orderBy($sort, $order);

        if ($request->filled('per_page')) {
            $perPage = min(max((int)$request->input('per_page', 10), 1), 100);
            return response()->json($query->paginate($perPage));
        }

        return response()->json($query->get());
    }

    public function show($id)
    {
        $book = Book::with('author')->find($id);
        if (!$book) return response()->json(['error' => 'Book not found'], 404);
        return response()->json($book);
    }

    public function store(Request $request)
    {
        try {
            $validated = $request->validate([
                'title' => 'required|min:1',
                'isbn' => 'required|digits:10|unique:books,isbn',
                'published_year' => 'nullable|digits:4|integer',
                'author_id' => 'required|exists:authors,id',
            ]);
        } catch (ValidationException $e) {
            if ($request->expectsJson()) {
                return response()->json(['errors' => $e->errors()], 400);
            }
            throw $e;
        }

        $book = Book::create($validated);

        if ($request->expectsJson()) {
            return response()->json($book, 201);
        }

        return redirect()->back()->with('success', 'Book added successfully.');
    }

       public function listUI()
{
    $query = Book::with('author');

    if ($q = request('q')) {
        $query->where(function($query) use ($q) {
            $query->where('title', 'like', "%{$q}%")
                  ->orWhere('published_year', $q)
                  ->orWhereHas('author', fn($q2) => $q2->where('name', 'like', "%{$q}%"));
        });
    }

    $sort = in_array(request('sort'), ['title','published_year','created_at']) ? request('sort') : 'created_at';
    $order = strtolower(request('order', 'desc')) === 'asc' ? 'asc' : 'desc';
    $query->orderBy($sort, $order);

    $books = $query->paginate(6)->withQueryString();
    $authors = Author::all();

    return view('books', compact('books', 'authors'));
}


    public function editUI($id)
    {
        $book = Book::find($id);
        if (!$book) return redirect()->route('books.ui')->with('error', 'Book not found');

        $authors = Author::all();
        return view('books_edit', compact('book', 'authors'));
    }

    public function update(Request $request, $id)
    {
        $book = Book::find($id);
        if (!$book) {
            if ($request->expectsJson()) {
                return response()->json(['error' => 'Book not found'], 404);
            }
            return redirect()->route('books.ui')->with('error', 'Book not found');
        }

        $validated = $request->validate([
            'title' => 'required|min:1',
            'isbn' => 'required|digits:10|unique:books,isbn,' . $id,
            'published_year' => 'nullable|digits:4|integer',
            'author_id' => 'required|exists:authors,id',
        ]);

        $book->update($validated);

        if ($request->expectsJson()) {
            return response()->json($book);
        }

        return redirect()->route('books.ui')->with('success', 'Book updated successfully.');
    }

    public function destroy(Request $request, $id)
    {
        $book = Book::find($id);
        if (!$book) {
            if ($request->expectsJson()) {
                return response()->json(['error' => 'Book not found'], 404);
            }
            return redirect()->route('books.ui')->with('error', 'Book not found');
        }

        $book->delete();

        if ($request->expectsJson()) {
            return response()->json(['message' => 'Book deleted successfully']);
        }

        return redirect()->route('books.ui')->with('success', 'Book deleted successfully.');
    }
}
