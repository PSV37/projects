<?php

namespace App\Http\Controllers;

use App\Post;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Auth;
use Hash;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users =config('user.user_create.user')::all();
        return view('post.create',compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $users =config('user.user_create.user')::all();
        return view('post.create',compact('users'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
         $user_id = Auth::user()->id;
        //return dd($request->all());
           
        $img_path = 'girl_logo.jpg';

        $userCreated = config('user.user_create.user')::create([
           'first_name' => $request->fname,
           'last_name' => $request->lname,
           'email' =>$request->email,
           'password' =>Hash::make($request->password),
           'image' =>$img_path,
           'created_at' => Carbon::now(),
           'created_by' => $user_id,
        ]);

        return response()->json([
              'status' => true,
              'data' => $userCreated,
              'message' => 'Successfully New User Created',
            ],config('user.success_code.success'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Post $post)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        //
    }
}
