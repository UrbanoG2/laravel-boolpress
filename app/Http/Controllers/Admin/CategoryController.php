<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\Category;
use App\Model\Post;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;




class CategoryController extends Controller
{


    protected $validation =  [
        'name' => 'required|max:50',
    ];
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Category::orderBy('name', 'desc')->paginate(5);

        return view('admin.categories.index', ['categories' => $categories]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();
        return view('admin.categories.create', ['categories' => $categories]);
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

        $validationData = $request->validate($this->validation);
        


        $slug = Str::slug($data['name'], '-');
        $oldCategorySlug = Category::where('slug', $slug)->first();

        $counter = 0;
        while ($oldCategorySlug) {

            $newSlug = $slug . '-' . $counter;
            $oldCategorySlug = Category::where('slug', $newSlug)->first();
            $counter++;
        }

        $newCategory = new Category();
        $newCategory->fill($data);
        $newCategory->slug = $slug;
        $newCategory->save();


        return redirect()->route('admin.categories.index', $newCategory->slug);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Category $category)
    {

        return view('admin.categories.show', ['category' => $category]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $category, Post $post)
    {
        {
            $category->delete();

            $posts = Post::whereNull("category_id")->first()->get();
            foreach ($posts as $post) {
                $randomCategories = Category::inRandomOrder()->first()->id;
                $post->category_id = $randomCategories;
                $post->update();
            }

            return redirect()
                ->route('admin.categories.index')
                ->with('status', "The category ' $category->name ' is been removed!");
        }
    }
}
