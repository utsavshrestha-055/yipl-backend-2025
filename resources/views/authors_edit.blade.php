<!doctype html>
<html>
<head>
  <meta charset="utf-8">
  <title>Edit Author — Library</title>
  <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100 p-6">
  <div class="max-w-2xl mx-auto">

    <h1 class="text-2xl font-bold mb-4">Edit Author</h1>

    {{-- Success/Error Messages --}}
    @if(session('success'))
      <div class="bg-green-100 text-green-700 p-3 rounded mb-4">{{ session('success') }}</div>
    @endif
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

    <form method="POST" action="{{ route('authors.update', $author->id) }}">
      @csrf
      @method('PUT')
      <div class="mb-4">
        <label class="block mb-1">Name</label>
        <input name="name" value="{{ old('name', $author->name) }}" class="border p-2 rounded w-full">
      </div>
      <div class="mb-4">
        <label class="block mb-1">Email</label>
        <input name="email" value="{{ old('email', $author->email) }}" class="border p-2 rounded w-full">
      </div>
      <button type="submit" class="bg-green-600 text-white px-4 py-2 rounded">Update</button>
    </form>

    <a href="{{ route('authors.ui') }}" class="inline-block mt-4 text-blue-500">Back to Authors</a>

  </div>
</body>
</html>
