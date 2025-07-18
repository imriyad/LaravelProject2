<x-layout>
    <h1 class="text-3xl font-bold mb-6">Search Results for "{{ $query }}"</h1>

    @if ($posts->count())
        <table class="min-w-full bg-gray-800 rounded-lg text-white">
            <thead>
                <tr class="bg-gray-700 text-left text-sm font-medium">
                    <th class="py-3 px-6">ID</th>
                    <th class="py-3 px-6">Title</th>
                    <th class="py-3 px-6">Content</th>
                   <!-- <th class="py-3 px-6">Views</th> -->
                   <!-- <th class="py-3 px-6">Clicked</th> -->

                    <th class="py-3 px-6">Score</th>
                    <th class="py-3 px-6">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($posts as $post)
                    <tr class="border-t border-gray-700 hover:bg-gray-700">
                        <td class="py-3 px-6">{{ $post->id }}</td>
                        <td class="py-3 px-6">{{ $post->title }}</td>
                        <td class="py-3 px-6">{{ $post->content }}</td>
                        <!-- <td class="py-3 px-6">{{ $post->views }}</td> -->
                        <!-- <td class="py-3 px-6">{{ $post->clicked ?? 0 }}</td> -->

                        <td class="py-3 px-6">{{ $post->score }}</td>
                        <td class="py-3 px-6 space-x-2">
                            <a href="{{ route('posts.incrementClicked', $post->id) }}" class="bg-yellow-400 hover:bg-yellow-500 text-black py-1 px-3 rounded">
                                See Post & Add Comment
                            </a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <div class="mt-6">
            {{ $posts->links() }}
        </div>
    @else
        <p class="text-gray-400 italic">No posts found for "{{ $query }}"</p>
    @endif
</x-layout>