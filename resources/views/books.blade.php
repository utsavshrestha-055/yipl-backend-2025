<!doctype html>
<html>
<head>
  <meta charset="utf-8">
  <title>Books</title>
  <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100 p-6">
<div class="max-w-6xl mx-auto">

  <div class="flex justify-between items-center mb-6">
      <h1 class="text-2xl font-bold">Books</h1>
      <a href="{{ route('authors.ui') }}" class="bg-blue-600 text-white px-4 py-2 rounded">Authors</a>
  </div>

  <form method="GET" action="{{ route('books.ui') }}" class="mb-4 flex gap-2">
    <input type="text" name="q" value="{{ request('q') }}" placeholder="Search by title, author, or year" class="border p-2 rounded flex-1">

    <select name="sort" class="border p-2 rounded">
        <option value="created_at" {{ request('sort') == 'created_at' ? 'selected' : '' }}>Created date</option>
        <option value="title" {{ request('sort') == 'title' ? 'selected' : '' }}>Title</option>
        <option value="published_year" {{ request('sort') == 'published_year' ? 'selected' : '' }}>Published Year</option>
    </select>
    <select name="order" class="border p-2 rounded">
        <option value="desc" {{ request('order') == 'desc' ? 'selected' : '' }}>Descending</option>
        <option value="asc" {{ request('order') == 'asc' ? 'selected' : '' }}>Ascending</option>
    </select>
    <button type="submit" class="bg-gray-600 text-white px-4 py-2 rounded">Search</button>
</form>


  @if(session('success'))
      <div class="bg-green-100 text-green-700 p-3 rounded mb-4">{{ session('success') }}</div>
  @endif

  @if(session('error'))
      <div class="bg-red-100 text-red-700 p-3 rounded mb-4">{{ session('error') }}</div>
  @endif

  @if($errors->any())
      <div class="bg-red-100 text-red-700 p-3 rounded mb-4">
          <ul class="list-disc pl-5">
              @foreach($errors->all() as $err)
                  <li>{{ $err }}</li>
              @endforeach
          </ul>
      </div>
  @endif

  <div class="bg-white p-4 rounded shadow mb-6">
      <form method="POST" action="{{ url('/books') }}">
          @csrf
          <div class="grid grid-cols-4 gap-2">
              <input name="title" value="{{ old('title') }}" placeholder="Title" class="border p-2 rounded col-span-2">
              <input name="isbn" value="{{ old('isbn') }}" placeholder="ISBN (10 digits)" class="border p-2 rounded">
              <input name="published_year" value="{{ old('published_year') }}" placeholder="Published year" class="border p-2 rounded">
              <select name="author_id" class="border p-2 rounded col-span-1">
                  <option value="">Select author</option>
                  @foreach($authors as $a)
                      <option value="{{ $a->id }}" {{ old('author_id') == $a->id ? 'selected' : '' }}>{{ $a->name }}</option>
                  @endforeach
              </select>
          </div>
          <div class="mt-3">
              <button class="bg-green-600 text-white px-4 py-2 rounded">Add Book</button>
          </div>
      </form>
  </div>

  <div class="bg-white p-4 rounded shadow overflow-x-auto">
      <table class="table-auto w-full border border-gray-300">
          <thead class="bg-gray-100">
              <tr>
                  <th class="p-2 border">Title</th>
                  <th class="p-2 border">ISBN</th>
                  <th class="p-2 border">Published Year</th>
                  <th class="p-2 border">Author</th>
                  <th class="p-2 border">Actions</th>
              </tr>
          </thead>
          <tbody>
              @forelse($books as $book)
              <tr class="hover:bg-gray-50">
                  <td class="p-2 border">
                      <div >{{ $book->title }}</div>
                  </td>
                  <td class="p-2 border">{{ $book->isbn }}</td>
                  <td class="p-2 border">{{ $book->published_year }}</td>
                  <td class="p-2 border">{{ $book->author->name }}</td>
                  <td class="p-2 border space-x-2">
                      <a href="{{ route('books.edit', $book->id) }}" class="text-blue-500">Edit</a>
                      <form action="{{ route('books.destroy', $book->id) }}" method="POST" class="inline-block">
                          @csrf
                          @method('DELETE')
                          <button type="submit" class="text-red-500" onclick="return confirm('Delete this book?')">Delete</button>
                      </form>
                  </td>
              </tr>
              @empty
              <tr>
                  <td colspan="5" class="text-center p-4 text-gray-500">No books found.</td>
              </tr>
              @endforelse
          </tbody>
      </table>

      {{-- Pagination --}}
      <div class="mt-4">
          {{ $books->appends(request()->query())->links() }}
      </div>
  </div>

</div>
</body>
</html>
