<x-layout>
<h2 class="text-2xl font-bold mb-2">{{ $post->title }}</h2>
<p class="mb-4">{{ $post->content }}</p>

<hr class="my-4">

<h3 class="text-xl font-semibold mt-6 mb-2">Comments ({{ $post->comments->count() }})</h3>

@forelse ($post->comments as $comment)
    <div class="mb-4 p-3 bg-gray-500 rounded">
        Author Name : <p class="font-semibold">{{ $comment->author_name }}</p>
        Comment : <p>{{ $comment->comment_text }}</p>
        <p class="text-sm text-gray-500">{{ $comment->created_at->diffForHumans() }}</p>
    </div>
@empty
    <p class="text-gray-500">No comments yet.</p>
@endforelse
</x-layout>