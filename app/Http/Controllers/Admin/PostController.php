<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Post;
use App\Category;
use App\Tag;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $posts = Post::all(); 
        $user = Auth::user();
        $posts = $user->posts;
        return view('admin.posts.index', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {     
         $categories = Category::all();
         $tags = Tag::all();
         return view('admin.posts.create', compact('categories', 'tags')); 
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // validazione
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string|max:65535',
            'published' => 'sometimes|accepted',
            'category_id' => 'nullable|exists:categories,id',
            'tags' => 'nullable|exists:tags,id',
        ]);
        // prendo i dati dalla request e creo il post
        $data = $request->all();
        $newPost = new Post();
        $newPost->fill($data);

        $newPost->slug = $this->getSlug($data['title']);

        $newPost->published = isset($data['published']); // true o false
        $newPost->user_id = Auth::id();
        $newPost->save();
        // redirect alla pagina del post appena creato
        if(isset($data['tags'])){
            $newPost->tags()->sync($data['tags']);
        }
        return redirect()->route('admin.posts.show', $newPost->id);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        return view('admin.posts.show', compact('post'));
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

        $postTags = $post->tags->map(function ($item) {
            return $item->id;
        })->toArray();

        return view('admin.posts.edit', compact('post', 'categories', 'tags', 'postTags'));
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
        // validazione
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string|max:65535',
            'published' => 'sometimes|accepted',
            'category_id' => 'nullable|exists:categories,id',
            'tags' => 'nullable|exists:tags,id',
        ]);
        // aggiornamento
        $data = $request->all();
        // se cambia il titolo genero un altro slug
        if( $post->title != $data['title'] ) {
            $post->slug = $this->getSlug($data['title']);
        }
        $post->fill($data);

        // $post->user_id = Auth::id();

        $post->published = isset($data['published']); // true o false

        $post->save();

        $tags = isset($data['tags']) ? $data['tags'] : [];

        $post->tags()->sync($tags);
        // redirect
        return redirect()->route('admin.posts.show', $post->id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        $post->delete();

        return redirect()->route('admin.posts.index');
    }


    
    private function getSlug($title)
    {
        $slug = Str::of($title)->slug('-');
        $count = 1;

        while( Post::where('slug', $slug)->first() ) {
            $slug = Str::of($title)->slug('-') . "-{$count}";
            $count++;
        }

        return $slug;
    }
}


