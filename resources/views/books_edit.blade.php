<!doctype html>
<html>
<head>
  <meta charset="utf-8">
  <title>Edit Book</title>
  <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100 p-6">
  <div class="max-w-3xl mx-auto">
    <div class="flex justify-between items-center mb-6">
      <h1 class="text-2xl font-bold">Edit Book</h1>
      <div>
        <a href="{{ route('books.ui') }}" class="bg-blue-600 text-white px-4 py-2 rounded">Back to Books</a>
      </div>
    </div>

    @if($errors->any())
      <div class="bg-red-100 text-red-700 p-3 rounded mb-4">
        <ul class="list-disc pl-5">
          @foreach($errors->all() as $err)
            <li>{{ $err }}</li>
          @endforeach
        </ul>
      </div>
    @endif

    <div class="bg-white p-4 rounded shadow">
      <form method="POST" action="{{ url('/books/'.$book->id) }}">
        @csrf
        @method('PUT')
        <div class="grid grid-cols-1 gap-3">
          <input name="title" value="{{ old('title', $book->title) }}" placeholder="Title" class="border p-2 rounded">
          <input name="isbn" value="{{ old('isbn', $book->isbn) }}" placeholder="ISBN (10 digits)" class="border p-2 rounded">
          <input name="published_year" value="{{ old('published_year', $book->published_year) }}" placeholder="Published year" class="border p-2 rounded">
          <select name="author_id" class="border p-2 rounded">
            <option value="">Select author</option>
            @foreach($authors as $a)
              <option value="{{ $a->id }}" {{ old('author_id', $book->author_id) == $a->id ? 'selected' : '' }}>{{ $a->name }}</option>
            @endforeach
          </select>
        </div>
        <div class="mt-3">
          <button class="bg-green-600 text-white px-4 py-2 rounded">Update Book</button>
        </div>
      </form>
    </div>
  </div>
</body>
</html>
