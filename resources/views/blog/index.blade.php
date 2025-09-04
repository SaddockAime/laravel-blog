@extends('layouts.app')

@section('title', 'Blog Posts - My Laravel Blog')

@section('content')
    <div style="display: grid; grid-template-columns: 1fr 300px; gap: 2rem;">
        <div class="main-column">
            <!-- Search Form -->
            <form method="GET" class="search-form">
                <input type="text" name="search" placeholder="Search posts..." class="search-input" value="{{ $search }}">
                <button type="submit" class="btn">Search</button>
            </form>

            @if($search)
                <p style="margin-bottom: 1rem; color: #666;">
                    Search results for: <strong>{{ $search }}</strong>
                    <a href="{{ route('blog.index') }}" style="margin-left: 1rem; color: #007bff;">Clear search</a>
                </p>
            @endif

            @if($tag)
                <p style="margin-bottom: 1rem; color: #666;">
                    Posts tagged with: <span class="tag" style="background: #007bff; color: #fff;">{{ $tag }}</span>
                    <a href="{{ route('blog.index') }}" style="margin-left: 1rem; color: #007bff;">Show all posts</a>
                </p>
            @endif

            <!-- Blog Posts -->
            @if(count($posts['data']) > 0)
                @foreach($posts['data'] as $post)
                    <article class="card">
                        <h2 class="card-title">
                            <a href="{{ route('blog.show', $post['slug']) }}" style="text-decoration: none; color: inherit;">
                                {{ $post['title'] }}
                            </a>
                            @if($post['featured'])
                                <span style="background: #ffd700; color: #333; padding: 0.25rem 0.5rem; border-radius: 4px; font-size: 0.75rem; margin-left: 0.5rem;">Featured</span>
                            @endif
                        </h2>
                        
                        <div class="card-meta">
                            By {{ $post['author'] }} • {{ date('M j, Y', strtotime($post['published_at'])) }}
                        </div>
                        
                        <div class="card-content">
                            <p>{{ $post['excerpt'] }}</p>
                        </div>
                        
                        <div style="margin-top: 1rem;">
                            @foreach($post['tags'] as $postTag)
                                <a href="{{ route('blog.index') }}?tag={{ $postTag }}" class="tag">{{ $postTag }}</a>
                            @endforeach
                        </div>
                        
                        <div style="margin-top: 1rem;">
                            <a href="{{ route('blog.show', $post['slug']) }}" class="btn">Read More</a>
                        </div>
                    </article>
                @endforeach

                <!-- Pagination -->
                @if($posts['last_page'] > 1)
                    <div class="pagination">
                        @if($posts['current_page'] > 1)
                            <a href="{{ route('blog.index') }}?page={{ $posts['current_page'] - 1 }}{{ $search ? '&search=' . $search : '' }}{{ $tag ? '&tag=' . $tag : '' }}">Previous</a>
                        @endif
                        
                        @for($i = 1; $i <= $posts['last_page']; $i++)
                            @if($i == $posts['current_page'])
                                <span class="current">{{ $i }}</span>
                            @else
                                <a href="{{ route('blog.index') }}?page={{ $i }}{{ $search ? '&search=' . $search : '' }}{{ $tag ? '&tag=' . $tag : '' }}">{{ $i }}</a>
                            @endif
                        @endfor
                        
                        @if($posts['current_page'] < $posts['last_page'])
                            <a href="{{ route('blog.index') }}?page={{ $posts['current_page'] + 1 }}{{ $search ? '&search=' . $search : '' }}{{ $tag ? '&tag=' . $tag : '' }}">Next</a>
                        @endif
                    </div>
                @endif
            @else
                <div class="card">
                    <p>No posts found.</p>
                </div>
            @endif
        </div>

        <div class="sidebar">
            <!-- Featured Posts -->
            @if(count($featuredPosts) > 0)
                <div class="card">
                    <h3 class="card-title">Featured Posts</h3>
                    @foreach($featuredPosts as $featuredPost)
                        <div style="padding: 0.5rem 0; border-bottom: 1px solid #eee;">
                            <a href="{{ route('blog.show', $featuredPost['slug']) }}" style="text-decoration: none; color: #333; font-weight: 500;">
                                {{ $featuredPost['title'] }}
                            </a>
                            <div style="font-size: 0.875rem; color: #666;">
                                {{ date('M j, Y', strtotime($featuredPost['published_at'])) }}
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif

            <!-- Tags Cloud -->
            <div class="card">
                <h3 class="card-title">Tags</h3>
                @foreach($allTags as $availableTag)
                    <a href="{{ route('blog.index') }}?tag={{ $availableTag }}" class="tag">{{ $availableTag }}</a>
                @endforeach
            </div>
        </div>
    </div>

    <style>
        @media (max-width: 768px) {
            div[style*="grid-template-columns"] {
                display: block !important;
            }
            .sidebar {
                margin-top: 2rem;
            }
        }
    </style>
@endsection
