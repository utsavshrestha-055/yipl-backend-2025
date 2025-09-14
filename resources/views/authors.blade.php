<!doctype html>
<html>
<head>
  <meta charset="utf-8">
  <title>Authors — Library</title>
  <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100 p-6">
  <div class="max-w-4xl mx-auto">

    <div class="flex justify-between items-center mb-6">
      <h1 class="text-2xl font-bold">Authors</h1>
      <a href="" class="bg-blue-600 text-white px-4 py-2 rounded">Books</a>
    </div>

    {{-- Success Message --}}
    @if(session('success'))
      <div class="bg-green-100 text-green-700 p-3 rounded mb-4">{{ session('success') }}</div>
    @endif

    {{-- Error Message --}}
    @if(session('error'))
      <div class="bg-red-100 text-red-700 p-3 rounded mb-4">{{ session('error') }}</div>
    @endif

    {{-- Validation Errors --}}
    @if($errors->any())
      <div class="bg-red-100 text-red-700 p-3 rounded mb-4">
        <ul class="list-disc pl-5">
          @foreach($errors->all() as $err)
            <li>{{ $err }}</li>
          @endforeach
        </ul>
      </div>
    @endif

    {{-- Add Author Form --}}
    <div class="bg-white p-4 rounded shadow mb-6">
      <form method="POST" action="{{ route('authors.store') }}">
        @csrf
        <div class="flex gap-2">
          <input name="name" value="{{ old('name') }}" placeholder="Author name" class="border p-2 rounded flex-1">
          <input name="email" value="{{ old('email') }}" placeholder="Author email" class="border p-2 rounded flex-1">
          <button class="bg-green-600 text-white px-4 py-2 rounded">Add</button>
        </div>
      </form>
    </div>

    {{-- Authors Table --}}
    <div class="bg-white p-4 rounded shadow">
      <table class="table-auto w-full border border-gray-300">
        <thead>
          <tr class="bg-gray-200">
            <th class="px-4 py-2 border">Name</th>
            <th class="px-4 py-2 border">Email</th>
            <th class="px-4 py-2 border">Books</th>
            <th class="px-4 py-2 border">Actions</th>
          </tr>
        </thead>
        <tbody>
          @forelse($authors as $author)
          <tr class="hover:bg-gray-50">
            <td class="px-4 py-2 border">{{ $author->name }}</td>
            <td class="px-4 py-2 border">{{ $author->email }}</td>
            <td class="px-4 py-2 border">
              @forelse($author->books as $book)
                {{ $book->title }}<br>
              @empty
                <span class="text-gray-400">No books</span>
              @endforelse
            </td>
            <td class="px-4 py-2 border">
              <a href="{{ route('authors.edit', $author->id) }}" class="text-blue-500 mr-2">Edit</a>
              <form action="{{ route('authors.destroy', $author->id) }}" method="POST" style="display:inline;">
                @csrf
                @method('DELETE')
                <button type="submit" class="text-red-500" onclick="return confirm('Delete this author?');">Delete</button>
              </form>
            </td>
          </tr>
          @empty
          <tr>
            <td colspan="4" class="text-center p-4 text-gray-500">No authors found.</td>
          </tr>
          @endforelse
        </tbody>
      </table>
    </div>

  </div>
</body>
</html>
