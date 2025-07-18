<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Post Details - {{ $post->title }}</title>
    @vite(['resources/css/app.css'])
</head>
<body class="bg-gray-900 text-white p-6">

    <div class="flex flex-col mb-8 space-y-4 max-w-3xl mx-auto">

        <!-- Post Title and Content -->
        <h1 class="text-3xl font-bold bg-blue-500 p-4 rounded-xl">{{ $post->title }}</h1>
        <p class="text-lg bg-gray-800 p-4 rounded">{{ $post->content }}</p>

        <!-- Views and Clicked Counts -->
        <p class="text-sm text-gray-400 mt-1">Views: <strong>{{ $post->views }}</strong></p>
        <p class="text-sm text-gray-400 mt-1">
            Clicked: <strong><span id="clicked-count">{{ $post->clicked ?? 0 }}</span></strong>
        </p>

       

        <!-- Back to Homepage Link -->
        <a href="{{ url('/') }}" class="inline-block bg-green-500 hover:bg-green-600 px-4 py-2 rounded text-black font-semibold w-max">
            Back to Homepage
        </a>

        <!-- Edit Post Form -->
        <form action="{{ route('update', $post->id) }}" method="POST" class="bg-gray-800 p-4 rounded space-y-4">
            @csrf
            @method('PUT')
            
            <div>
                <label for="title" class="block mb-1 font-semibold">Title:</label>
                <input type="text" id="title" name="title" value="{{ old('title', $post->title) }}"
                    class="w-full p-2 rounded text-black" />
                @error('title')
                    <p class="text-red-600 mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="content" class="block mb-1 font-semibold">Content:</label>
                <textarea id="content" name="content" rows="4"
                    class="w-full p-2 rounded text-black">{{ old('content', $post->content) }}</textarea>
                @error('content')
                    <p class="text-red-600 mt-1">{{ $message }}</p>
                @enderror
            </div>

            <button type="submit" class="bg-green-500 hover:bg-green-600 text-black font-bold py-2 px-4 rounded">
                Update Post
            </button>
        </form>

        <!-- Comment Submission Form -->
        <form action="{{ route('comments.store') }}" method="POST" class="bg-gray-800 p-4 rounded space-y-4">
            @csrf

            <input type="hidden" name="post_id" value="{{ $post->id }}">

            <div>
                <label for="author_name" class="block mb-1 font-semibold">Your Name</label>
                <input type="text" name="author_name" id="author_name" required
                    class="w-full p-2 rounded text-black" />
            </div>

            <div>
                <label for="comment_text" class="block mb-1 font-semibold">Comment</label>
                <textarea name="comment_text" id="comment_text" rows="4" required
                    class="w-full p-2 rounded text-black"></textarea>
            </div>

            <button type="submit" class="bg-orange-500 hover:bg-orange-600 text-white font-bold py-2 px-4 rounded">
                Add a Comment
            </button>
        </form>

    </div>

    <script>
        document.getElementById('click-btn').addEventListener('click', function() {
            fetch("{{ route('posts.incrementClicked', $post->id) }}", {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify({})
            })
            .then(response => response.json())
            .then(data => {
                document.getElementById('clicked-count').textContent = data.clicked;
            })
            .catch(err => console.error('Error:', err));
        });
    </script>

</body>
</html>