<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Welcome | My Laravel Blog</title>
    @vite(['resources/css/app.css'])
</head>
<body class="bg-gray-950 text-white font-sans">

    <header class="bg-gray-900 p-6 shadow-md">
        <div class="container mx-auto flex justify-between items-center">
            <h1 class="text-2xl font-bold">My Laravel Blog</h1>
            <div>
                <a href="{{ route('login') }}" class="bg-blue-600 hover:bg-blue-700 px-4 py-2 rounded mr-2">Login</a>
                <a href="{{ route('register') }}" class="bg-green-600 hover:bg-green-700 px-4 py-2 rounded">Register</a>
            </div>
        </div>
    </header>

    <main class="container mx-auto px-4 py-12">
        <section class="text-center mb-16">
            <h2 class="text-4xl font-bold mb-4">Welcome to the Blog World</h2>
            <p class="text-gray-300 mb-6">Read, share, and explore ideas from amazing people.</p>
            <a href="{{ route('login') }}" class="inline-block bg-indigo-600 hover:bg-indigo-700 text-white px-6 py-3 rounded text-lg font-medium transition">Get Started</a>
        </section>

        <section class="mb-12">
            <h3 class="text-2xl font-semibold mb-6 text-center">Latest Posts</h3>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @forelse($posts as $post)
                    <div class="bg-gray-800 p-6 rounded-lg shadow-md">
                        <h4 class="text-xl font-bold mb-2">{{ $post->title }}</h4>
                        <p class="text-gray-400 mb-4 line-clamp-3">{{ Str::limit($post->content, 100) }}</p>
                        <div class="text-sm text-gray-500 mb-2">Views: {{ $post->views }} | Clicked: {{ $post->clicked ?? 0 }}</div>
                        <a href="{{ route('posts.incrementClicked', $post->id) }}" class="text-indigo-400 hover:underline">Read More</a>
                    </div>
                @empty
                    <p class="text-center text-gray-500 col-span-3">No posts available.</p>
                @endforelse
            </div>

            <div class="mt-8 flex justify-center">
                {{ $posts->links() }}
            </div>
        </section>
    </main>

    <footer class="bg-gray-900 text-gray-500 text-center py-4">
        © {{ date('Y') }} My Laravel Blog. All rights reserved.
    </footer>

</body>
</html>
