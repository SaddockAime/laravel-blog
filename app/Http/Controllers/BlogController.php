<?php

namespace App\Http\Controllers;

use App\Services\BlogService;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    /**
     * Display a listing of blog posts
     */
    public function index(Request $request)
    {
        $page = $request->get('page', 1);
        $search = $request->get('search');
        $tag = $request->get('tag');
        
        if ($search) {
            $posts = BlogService::searchPosts($search);
            $posts = ['data' => array_values($posts), 'current_page' => 1, 'per_page' => count($posts), 'total' => count($posts), 'last_page' => 1];
        } elseif ($tag) {
            $posts = BlogService::getPostsByTag($tag);
            $posts = ['data' => array_values($posts), 'current_page' => 1, 'per_page' => count($posts), 'total' => count($posts), 'last_page' => 1];
        } else {
            $posts = BlogService::getAllPosts(10, $page);
        }
        
        $featuredPosts = BlogService::getFeaturedPosts();
        $allTags = BlogService::getAllTags();
        
        return view('blog.index', compact('posts', 'featuredPosts', 'allTags', 'search', 'tag'));
    }

    /**
     * Display a specific blog post
     */
    public function show($slug)
    {
        $post = BlogService::getPostBySlug($slug);
        
        if (!$post) {
            abort(404);
        }
        
        $recentPosts = BlogService::getRecentPosts(3);
        
        return view('blog.show', compact('post', 'recentPosts'));
    }
}
