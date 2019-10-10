<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Post;
use App\Models\Comment;

class CommentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $comments = Comment::with('post')->paginate(10);

        return view('admin.comments.index', compact('comments'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Comment $comment)
    {
        if($comment->user_id != auth()->user()->id && auth()->user()->is_admin == false) {
            flash()->overlay("You can't delete other peoples comment.");
            return redirect('/admin/posts');
        }

        $comment->delete();
        flash()->overlay('Comment deleted successfully.');

        return redirect('/admin/comments');
    }

    /**
     * Create a comment
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $posts = Post::select('title', 'id')->get();
        return view('admin.comments.create', compact('posts'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,[
            'text' => 'required',
            'post' => 'required'
        ]);
        Comment::create([
            'body' => $request->text,
            'post_id' => $request->post,
            'user_id' => auth()->user()->id
        ]);
        flash()->overlay('Comment created successfully');

        return redirect('/admin/comments');
    }
}
