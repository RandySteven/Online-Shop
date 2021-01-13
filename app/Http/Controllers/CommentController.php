<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Product;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function store(Request $request){
        $comment = new Comment();
        $comment->comment = $request->comment;
        $comment->user()->associate($request->user());
        $product = Product::find($request->get('product_id'));
        $product->comments()->save($comment);
        return back()->with('success', 'Comment product success');
    }

    public function replies(Request $request){
        $reply = new Comment();
        $reply->comment = $request->comment;
        $reply->user()->associate($request->user());
        $reply->parent_id = $request->get('comment_id');
        $product = Product::find($request->get('product_id'));
        $product->comments()->save($reply);
        return back()->with('success', 'Reply comment success');
    }
}
