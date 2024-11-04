<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        //
        $posts = Post::when($request->search, function($query) use ($request){
            $query->where('title', 'like', "%".$request->search."%")
                   ->orWhere('description', 'like', "%".$request->search."%");
        })->paginate()->withQueryString();
        
        return Inertia::render('Post/Index', ['posts'=> $posts, 'search'=>$request->search]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return Inertia::render('Post/Create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $request->validate([
            'title'=> ['required', 'max:255'],
            'description'=> ['required', 'max:255'],
        ]);

        $post = Post::create([
            'title' => $request->title,
            'description' => $request->description
        ]);

        return redirect('/dashboard/post');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
      
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
        $post = Post::find($id);

        return Inertia::render('Post/Edit', ['post'=> $post]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
        $request->validate([
            'title'=> ['required', 'max:255'],
            'description'=> ['required', 'max:255'],
        ]);

        $post = Post::find($id);

        $post->update([
            'title'=> $request->title,
            'description'=> $request->description
        ]);

        return redirect('/dashboard/post');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        
        $post = Post::find($id);

        $post->delete();

        return redirect('/dashboard/post');
    }
}
