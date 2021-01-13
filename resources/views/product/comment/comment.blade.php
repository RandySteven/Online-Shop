@foreach ($comments as $comment)
<div>
    <div class="container my-2">
        <div class="flex">
            <x-label>{{ $comment->user->name }}</x-label>
        </div>
        <p>{!! nl2br($comment->comment) !!}</p>
    </div>
    @auth
        <div class="container">
            <form action="{{ route('comment.reply') }}" method="POST">
                @csrf
                <input type="hidden" name="product_id" value="{{ $product_id }}">
                <input type="hidden" name="comment_id" value="{{ $comment->id }}">
                <input type="text" name="comment" class="w-5/6" id="comment" required>
                <button type="submit" class="px-2 py-2 bg-blue-500 hover:bg-blue-400 rounded text-white">Reply</button>
            </form>
        </div>
    @endauth
    <div class="container ml-4">
        @include('product.comment.comment', ['comments'=>$comment->replies])
    </div>
</div>
@endforeach
