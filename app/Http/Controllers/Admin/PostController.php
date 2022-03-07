<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\Post;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Model\Category;
use App\Model\Tag;



class PostController extends Controller
{


    protected $validation =  [
        'title' => 'required|max:50',
        'author' => 'required|max:60',
        'text' => 'required',
        'tags.*' => 'nullable|exists:App\Model\Tag,id',
        'image'=>'nullable|image'
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
        $tags = Tag::all();
        $categories = Category::all();
        return view('admin.posts.create', ['categories' => $categories, "tags"=> $tags]);
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


        //creo variabile upload img

        if (!empty($data["image"])) {
            $image_path = Storage::put("uploads", $data["image"]);
            $data["image"] = $image_path;
        }   


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

        if (!empty($data['tags'])) {
            $post->tags()->attach($data['tags']);
        }


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
        $categories = Category::all();
        $tags = Tag::all();
        return view('admin.posts.edit', ['post'=>$post, "categories"=>$categories, "tags"=>$tags]);
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


         //stesso check dello store
        if (!empty($data['image'])) {
            Storage::delete($post->image);

            $image_path = Storage::put('uploads', $data['image']);
            $data["image"] = $image_path;
        }


        $post->update($data);


        if (!empty($data['tags'])) {
            $post->tags()->sync($data['tags']);
        } else {
            $post->tags()->detach();
        }

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
    public function destroy(Post $post)
    {
        if (Auth::user()->id != $post->user_id) {
            abort('403');
        }

        $post->tags()->detach();
        $post->delete();

        return redirect()->route('admin.posts.index')->with('status', "Post id $post->id deleted");
    }
}
