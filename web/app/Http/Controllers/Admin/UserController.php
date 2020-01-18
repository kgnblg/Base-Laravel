<?php

namespace App\Http\Controllers\Admin;

use App\User;
use App\Models\Post;
use App\Models\Comment;
use App\UserType;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::withCount('posts')->with('usertype')->paginate(10);

        return view('admin.users.index', compact('users'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        if(auth()->user() == $user) {
            flash()->overlay("You can't delete yourself.");

            return redirect('/admin/users');
        }

        $user->delete();
        flash()->overlay('User deleted successfully.');

        return redirect('/admin/users');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        $posts    = Post::where('user_id', $user->id)->paginate(10);
        $comments = Comment::where('user_id', $user->id)->paginate(10);
        return view('admin.users.show', compact('user', 'posts', 'comments'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        if(auth()->user()->is_admin == false) {
            flash()->overlay("You can't edit a user.");
            return redirect('/admin/users');
        }

        $usertypes = UserType::all();

        return view('admin.users.edit', compact('user', 'usertypes'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        $this->validate($request,
            [
                'name'    => 'required',
                'email'   => 'required',
                'type_id' => 'required',
            ]
        );

        $usertype = UserType::where('id', '=', $request->type_id)->get();
        if ($usertype->count() == 0) {
            flash()->overlay("User type does not exist.");
            return redirect('/admin/users');
        }

        $user->update([
            'name'    => $request->name,
            'email'   => $request->email,
            'type_id' => $request->type_id
        ]);

        flash()->overlay('Post updated successfully.');

        return redirect('/admin/users');
    }
}
