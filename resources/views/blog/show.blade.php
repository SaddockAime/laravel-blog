@extends('layouts.app')

@section('title', $post['title'] . ' - My Laravel Blog')

@section('content')
    <div style="display: grid; grid-template-columns: 1fr 300px; gap: 2rem;">
        <article class="main-column">
            <div class="card">
                <div style="margin-bottom: 1rem;">
                    <a href="{{ route('blog.index') }}" class="btn btn-secondary">← Back to Blog</a>
                </div>

                <header style="margin-bottom: 2rem;">
                    <h1 style="font-size: 2rem; margin-bottom: 1rem; color: #333;">
                        {{ $post['title'] }}
                        @if($post['featured'])
                            <span style="background: #ffd700; color: #333; padding: 0.25rem 0.5rem; border-radius: 4px; font-size: 0.875rem; margin-left: 0.5rem;">Featured</span>
                        @endif
                    </h1>
                    
                    <div class="card-meta" style="font-size: 1rem; margin-bottom: 1rem;">
                        By <strong>{{ $post['author'] }}</strong> • {{ date('F j, Y', strtotime($post['published_at'])) }}
                    </div>
                    
                    <div style="margin-bottom: 1rem;">
                        @foreach($post['tags'] as $tag)
                            <a href="{{ route('blog.index') }}?tag={{ $tag }}" class="tag">{{ $tag }}</a>
                        @endforeach
                    </div>
                </header>

                <div class="post-content" style="line-height: 1.8; font-size: 1.1rem;">
                    {!! $post['content'] !!}
                </div>

                <footer style="margin-top: 3rem; padding-top: 2rem; border-top: 1px solid #eee;">
                    <div style="display: flex; justify-content: space-between; align-items: center;">
                        <div>
                            <strong>Author:</strong> {{ $post['author'] }}
                        </div>
                        <div>
                            <strong>Published:</strong> {{ date('F j, Y', strtotime($post['published_at'])) }}
                        </div>
                    </div>
                </footer>
            </div>
        </article>

        <aside class="sidebar">
            @if(count($recentPosts) > 0)
                <div class="card">
                    <h3 class="card-title">Recent Posts</h3>
                    @foreach($recentPosts as $recentPost)
                        @if($recentPost['id'] !== $post['id'])
                            <div style="padding: 1rem 0; border-bottom: 1px solid #eee;">
                                <a href="{{ route('blog.show', $recentPost['slug']) }}" style="text-decoration: none; color: #333; font-weight: 500; display: block; margin-bottom: 0.5rem;">
                                    {{ $recentPost['title'] }}
                                </a>
                                <div style="font-size: 0.875rem; color: #666; margin-bottom: 0.5rem;">
                                    By {{ $recentPost['author'] }} • {{ date('M j, Y', strtotime($recentPost['published_at'])) }}
                                </div>
                                <p style="font-size: 0.875rem; color: #555;">
                                    {{ Str::limit($recentPost['excerpt'], 100) }}
                                </p>
                            </div>
                        @endif
                    @endforeach
                </div>
            @endif

            <div class="card">
                <h3 class="card-title">Share This Post</h3>
                <div style="display: flex; gap: 0.5rem; flex-wrap: wrap;">
                    <a href="https://twitter.com/intent/tweet?text={{ urlencode($post['title']) }}&url={{ urlencode(request()->fullUrl()) }}" 
                       target="_blank" 
                       class="btn" 
                       style="font-size: 0.875rem; padding: 0.375rem 0.75rem;">
                        Twitter
                    </a>
                    <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(request()->fullUrl()) }}" 
                       target="_blank" 
                       class="btn btn-secondary" 
                       style="font-size: 0.875rem; padding: 0.375rem 0.75rem;">
                        Facebook
                    </a>
                    <a href="https://www.linkedin.com/sharing/share-offsite/?url={{ urlencode(request()->fullUrl()) }}" 
                       target="_blank" 
                       class="btn" 
                       style="background: #0077b5; font-size: 0.875rem; padding: 0.375rem 0.75rem;">
                        LinkedIn
                    </a>
                </div>
            </div>

            <div class="card">
                <h3 class="card-title">Related Topics</h3>
                @foreach($post['tags'] as $tag)
                    <a href="{{ route('blog.index') }}?tag={{ $tag }}" class="tag" style="display: block; margin-bottom: 0.5rem;">
                        View all {{ $tag }} posts
                    </a>
                @endforeach
            </div>
        </aside>
    </div>

    <style>
        .post-content h2 {
            font-size: 1.5rem;
            margin: 2rem 0 1rem 0;
            color: #333;
            border-bottom: 2px solid #007bff;
            padding-bottom: 0.5rem;
        }

        .post-content h3 {
            font-size: 1.25rem;
            margin: 1.5rem 0 0.75rem 0;
            color: #333;
        }

        .post-content p {
            margin-bottom: 1rem;
            color: #555;
        }

        .post-content ul, .post-content ol {
            margin: 1rem 0 1rem 2rem;
            color: #555;
        }

        .post-content li {
            margin-bottom: 0.5rem;
        }

        .post-content code {
            background: #f8f9fa;
            padding: 0.25rem 0.5rem;
            border-radius: 4px;
            font-family: 'Courier New', monospace;
            font-size: 0.9rem;
        }

        .post-content blockquote {
            border-left: 4px solid #007bff;
            padding: 1rem;
            margin: 1rem 0;
            background: #f8f9fa;
            font-style: italic;
        }

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
