<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Post;



class PostController extends Controller
{
    public function create(Request $request)
    {
        try {
            $validate = $request->validate([
                'title' => 'required|string|max:255',
                'description' => 'required|string|max:1000',
            ]);


            $post = Post::create($validate);

            if ($post) {
                return response()->json([
                 'message' => 'Post created successfully.',
                 'post' => $post,
            ], 201);
            }

           
        } catch (\Throwable $th) {
            return response()->json([
                'message' => 'Post creation failed.',
                'error' => $th->getMessage()
            ], 500);
        }
    }

    public function getAllPost(){
        try {
            
            $posts = Post::paginate(3); 
            return response()->json([
                'message' => 'Posts retrieved successfully.',
                'posts' => $posts,
            ], 200);
        } catch (\Throwable $th) {
            return response()->json([
                'message' => 'Failed to retrieve posts.',
                'error' => $th->getMessage()
            ], 500);
        }
    }
}