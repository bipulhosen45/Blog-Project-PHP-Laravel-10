<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\PostCreateRequest;
use App\Http\Requests\PostUpdateRequest;
use App\Models\Category;
use App\Models\Post;
use App\Models\SubCategory;
use App\Models\Tag;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $query = Post::with('category', 'sub_category', 'user', 'tags')->latest();

        if (Auth::user()->role === User::USER){
             $query->where('user_id', Auth::id());
        }
            $posts = $query->paginate(10);
        return view('backend.modules.post.index', compact('posts'));
       
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::all();
        // $sub_categories = SubCategory::all();
        $tags = Tag::all();
        return view('backend.modules.post.create', compact('categories', 'tags'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(PostCreateRequest $request)
    {
      $post = $request->except(['tag_ids', 'image', 'slug']);

        $image = $request->file('image');
        $slug = str_slug($request->post_title);
        
        if(isset($image)){
            $currentDate = Carbon::now()->toDateString();
            $imageName = $slug.'-'.$currentDate.'-'.'.'.$image->getClientOriginalExtension();
            if(!file_exists('uploads/post')){
                mkdir('uploads/post', 077, true);
            }
            $image->move('uploads/post', $imageName);
        }else{
            $imageName = 'default.png';
        }
        $post = new Post();
        $post->post_title = $request->post_title;
        $post->slug = str_slug($request->post_title);
        $post->status = $request->status;
        $post->is_approved = 1;
        $post->category_id = $request->category_id;
        $post->sub_category_id = $request->sub_category_id;
        $post->user_id = Auth::user()->id;
        $post->description = $request->description;
        $post->image = $imageName;
        $post['image'] = url('uploads/post/'.$post->image);
        $post->save();
        
        $post->tags()->attach($request->input('tag_ids'));
  
        return redirect()->route('post.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Post $post)
    {
        if (Auth::user()->role == User::USER && $post->user_id != Auth::user()->id){
            abort(403, 'Unauthorized');
        }
        // $post = Post::find($id);
        // $category = Category::find($id);
        // $sub_category = SubCategory::find($id);
        // $tags = Tag::find($id);
        // $user = User::find($id);
        $post->load(['category', 'sub_category', 'user', 'tags']);
        return view('backend.modules.post.show', compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $post = Post::find($id);
        $categories = Category::all();
        $sub_categories = SubCategory::all();
        $tags = Tag::where('status', 1)->select('name', 'id')->get();
        $selected_tags = DB::table('post_tag')->where('post_id', $post->id)->pluck('tag_id')->toArray();
        // $post->load('tags');
        // $selected_tags = $post->tags->pluck('id')->toArray();
        // dd ($selected_tags);
        return view('backend.modules.post.edit', compact('post', 'categories', 'sub_categories', 'tags', 'selected_tags'));
        
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(PostUpdateRequest $request, string $id)
    {
        $post = $request->except(['tag_ids' ]);

        $post = Post::find($id);

        $image = $request->file('image');
        $slug = str_slug($request->post_title);
        
        if(isset($image)){
            $currentDate = Carbon::now()->toDateString();
            $imageName = $slug.'-'.$currentDate.'-'.'.'.$image->getClientOriginalExtension();
            if(!file_exists('uploads/post')){
                mkdir('uploads/post', 077, true);
            }
            $image->move('uploads/post', $imageName);
        }else{
            $imageName = $post->image;
        }
        $post->post_title = $request->post_title;
        $post->slug = str_slug($request->post_title);
        $post->status = true;
        $post->is_approved = 1;
        $post->category_id = $request->category_id;
        $post->sub_category_id = $request->sub_category_id;
        $post->user_id = Auth::user()->id;
        $post->description = $request->description;
        $post->image = $imageName;
        $post->save();
        
        $post->tags()->sync($request->input('tag_ids'));
  
        return redirect()->route('post.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $post = Post::find($id);

        if(file_exists('uploads/post/'.$post->image)){
            unlink('uploads/post/'.$post->image);
        };
        $post->delete();

        toastr()->success('Post Deleted Successfully!', 'Deleted');

        return redirect()->route('post.index');
    }
    public function status($id){
        $post = Post::find($id);
        $post->status = true;
        $post->save();

        // session()->flash('cls', 'success');
        // session()->flash('msg', 'Post published successfully!');
        toastr()->success('Post published successfully!', 'Published');
        return redirect()->back();
    }
  // Tag store from post edit table
    public function TagStore(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|min:3|max:255',
        ]);

        $tag = new Tag();
        $tag->name = $request->name;
        $tag->slug = str_slug($request->name);
        $tag->status = true;
        $tag->save();

        toastr()->success('Tag has been save successfully!', 'Save');
        return redirect()->back();
    }
    public function postlist()
    {
        $post = Post::with('category', 'sub_category', 'user', 'tags')->latest()->paginate(10);
        return $post;
    }
}
