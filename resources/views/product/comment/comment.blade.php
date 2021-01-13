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
                <input type="hidden" name="product_id" value="{{ $product_id }}">
                <input type="hidden" name="comment_id" value="{{ $comment->id }}">
                <input type="text" name="comment" class="w-full inline-block" id="comment">
                {{-- <button type="submit">Reply</button> --}}
            </form>
        </div>
    @endauth
    <div class="container">
        @include('product.comment.comment', ['comments'=>$comment->replies])
    </div>
</div>
@endforeach
