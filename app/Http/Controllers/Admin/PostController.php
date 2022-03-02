<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\Post;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use App\Model\Category;


class PostController extends Controller
{


    protected $validation =  [
        'title' => 'required|max:50',
        'author' => 'required|max:60',
        'text' => 'required',
    ];

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::paginate(10);
        return view('admin.posts.index', compact('posts'));
    }

    public function indexUser()
    {
        $posts = Post::where('user_id', Auth::user()->id)->orderBy('created_at', 'desc')->paginate(20);

        return view('admin.posts.index', ['posts' => $posts]);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // return view('admin.posts.create', ['title' => 'Create New Post']);

        $categories = Category::all();
        return view('admin.posts.create', ['categories' => $categories]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)

    {
        $data = $request->all();
        $data['user_id'] = Auth::user()->id;

        // dd($request->all()); 

        $validationData = $request->validate($this->validation);
        // dd($this->validation);

        $slug = Str::slug($data['title'], '-');
        $postPresente = Post::where('slug', $slug)->first();

        // $counter = 0;
        // while ($postPresente) {

        //     $slug = $slug . '-' . $counter;
        //     $postPresente = Post::where('slug', $slug)->first();
        //     $counter++;
        // }

        $post = new Post();
        $post->fill($data);
        $post->slug = $slug;
        $post->save();


        return redirect()->route('admin.posts.show', $post->slug);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        $data = ["post"=>$post];
        return view("admin.posts.show", $data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        return view('admin.posts.edit', ['post'=>$post]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Post $post)
    {
        $validationData = $request->validate($this->validation);
        $data = $request->all();
        $updated = $post->update($data);

        return redirect()
        ->route('admin.posts.show', ["post"=>$post])
        ->with('status', "Your edit is completed");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
