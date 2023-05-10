<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function index()
    {
        $comments = Comment::where('parent_comment_id', null)->with('replies')->get();

        return response()->json($comments);
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'comment' => 'required',
        ]);

        if (!$validatedData) {
            return response()->json([
                'success' => false,
                'errors' => $validatedData
            ], 422);
        }

        $comment = new Comment();
        $comment->name = $validatedData['name'];
        $comment->email = $validatedData['email'];
        $comment->comment = $validatedData['comment'];
        $comment->parent_comment_id = $request->parent_comment_id;

        if (!$comment->save()) {
            return response()->json(['errors' => $comment->getErrors()], 500);
        }

        return response()->json([
            'success' => true,
            'data' => $comment
        ], 201);
    }
}
?>

