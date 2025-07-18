<x-app-layout>
    <div class="p-6 bg-gray-900 text-white min-h-screen">

        <div class="flex flex-col items-center justify-center mb-8">
            <h1 class="text-3xl mb-4">Welcome Here !!</h1>

            <!-- Search form -->
            <form action="{{ route('posts.search') }}" method="GET" class="mb-6 w-full max-w-md flex">
                <input type="text" name="query" placeholder="Search posts..." value="{{ request('query') }}" class="flex-grow px-4 py-2 rounded-l text-black" required>
                <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded-r hover:bg-blue-700">Search</button>
            </form>

            <a class="bg-green-500 p-4 px-8 rounded" href="{{ route('store') }}">Create New Post</a>

            @if(session('success'))
                <h2 class="bg-green-500 mt-4 p-2 rounded">{{ session('success') }}</h2>
            @endif
        </div>

        <div class="overflow-x-auto max-w-6xl mx-auto">
            <table class="min-w-full bg-gray-800 rounded-lg">
                <thead>
                    <tr class="bg-gray-700 text-left text-sm font-medium text-white">
                        <th class="py-3 px-6">ID</th>
                        <th class="py-3 px-6">Title</th>
                        <th class="py-3 px-6">Content</th>
                        <th class="py-3 px-6">Views</th>
                        <th class="py-3 px-6">Clicked</th>
                        <th class="py-3 px-6 text-center">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($posts as $post)
                        <tr class="border-t border-gray-700 hover:bg-gray-700">
                            <td class="py-3 px-6">{{ $post->id }}</td>
                            <td class="py-3 px-6">{{ $post->title }}</td>
                            <td class="py-3 px-6">{{ $post->content }}</td>
                            <td class="py-3 px-6">{{ $post->views }}</td>
                            <td class="py-3 px-6">{{ $post->clicked ?? 0 }}</td>
                            <td class="py-3 px-6 text-center space-x-2">
                                <a href="{{ route('edit', $post->id) }}" class="bg-yellow-400 hover:bg-yellow-500 text-black py-1 px-3 rounded">Edit</a>

                                <form action="{{ route('delete', $post->id) }}" method="POST" style="display:inline;" onsubmit="return confirm('Are you sure you want to delete this post?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="bg-red-500 hover:bg-red-700 text-black py-1 px-3 rounded">Delete</button>
                                </form>

                                <a href="{{ route('posts.incrementClicked', $post->id) }}" class="bg-yellow-400 hover:bg-yellow-500 text-black py-1 px-3 rounded">See the Post and Add a Comment</a>

                                <a href="{{ route('posts.comments', $post->id) }}" class="bg-yellow-400 hover:bg-yellow-500 text-black py-1 px-3 rounded">See All Comments</a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="text-center py-6 text-gray-400">No posts found.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>

            <div class="mt-6">
                {{ $posts->links() }}
            </div>
        </div>

    </div>
</x-app-layout>
