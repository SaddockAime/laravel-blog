<?php

namespace App\Services;

class BlogService
{
    private static $posts = [
        [
            'id' => 1,
            'title' => 'Getting Started with Laravel',
            'slug' => 'getting-started-with-laravel',
            'excerpt' => 'Learn the basics of Laravel framework and how to build your first web application.',
            'content' => '<p>Laravel is a powerful PHP framework that makes web development enjoyable and creative. In this post, we\'ll explore the fundamentals of Laravel and guide you through creating your first application.</p>

<h2>What is Laravel?</h2>
<p>Laravel is an open-source PHP web application framework with expressive, elegant syntax. It follows the model-view-controller (MVC) architectural pattern and provides many features out of the box.</p>

<h2>Key Features</h2>
<ul>
<li>Eloquent ORM for database operations</li>
<li>Blade templating engine</li>
<li>Artisan command line tool</li>
<li>Built-in authentication and authorization</li>
<li>Route caching and optimization</li>
</ul>

<h2>Getting Started</h2>
<p>To create a new Laravel project, you can use Composer or the Laravel installer. The framework provides excellent documentation and a gentle learning curve for beginners.</p>',
            'author' => 'John Doe',
            'published_at' => '2024-01-15',
            'tags' => ['Laravel', 'PHP', 'Web Development'],
            'featured' => true
        ],
        [
            'id' => 2,
            'title' => 'Modern PHP Development Best Practices',
            'slug' => 'modern-php-development-best-practices',
            'excerpt' => 'Discover the latest PHP development practices and tools that will make you a better developer.',
            'content' => '<p>PHP has evolved significantly over the years, and modern PHP development involves many best practices that can help you write cleaner, more maintainable code.</p>

<h2>Code Standards</h2>
<p>Following PSR (PHP Standards Recommendations) is crucial for writing consistent and readable code. PSR-4 for autoloading and PSR-12 for coding style are particularly important.</p>

<h2>Dependency Management</h2>
<p>Composer has revolutionized PHP development by providing a robust dependency management system. Always define your dependencies clearly and keep them updated.</p>

<h2>Testing</h2>
<p>Writing tests is essential for maintaining code quality. PHPUnit is the standard testing framework, and Laravel provides excellent testing tools built on top of it.</p>

<h2>Security</h2>
<p>Never trust user input, always validate and sanitize data, use prepared statements for database queries, and keep your dependencies updated to avoid security vulnerabilities.</p>',
            'author' => 'Jane Smith',
            'published_at' => '2024-01-22',
            'tags' => ['PHP', 'Best Practices', 'Security'],
            'featured' => false
        ],
        [
            'id' => 3,
            'title' => 'Building RESTful APIs with Laravel',
            'slug' => 'building-restful-apis-with-laravel',
            'excerpt' => 'Learn how to create robust and scalable RESTful APIs using Laravel framework.',
            'content' => '<p>Building APIs is a common requirement in modern web development. Laravel provides excellent tools for creating RESTful APIs quickly and efficiently.</p>

<h2>API Routes</h2>
<p>Laravel separates API routes from web routes, making it easy to organize your application. API routes are stateless and don\'t include CSRF protection by default.</p>

<h2>Resource Controllers</h2>
<p>Resource controllers provide a convenient way to handle CRUD operations. Laravel can generate resource controllers with all the necessary methods.</p>

<h2>API Resources</h2>
<p>API Resources allow you to transform your models into JSON responses easily. They provide a transformation layer between your Eloquent models and the JSON responses.</p>

<h2>Authentication</h2>
<p>Laravel Sanctum provides a simple way to authenticate APIs. It\'s perfect for SPAs and mobile applications that need API authentication.</p>',
            'author' => 'Mike Johnson',
            'published_at' => '2024-02-01',
            'tags' => ['Laravel', 'API', 'REST'],
            'featured' => false
        ],
        [
            'id' => 4,
            'title' => 'Frontend Development with Blade Templates',
            'slug' => 'frontend-development-with-blade-templates',
            'excerpt' => 'Master the art of creating beautiful user interfaces using Laravel\'s Blade templating engine.',
            'content' => '<p>Blade is Laravel\'s simple yet powerful templating engine. It allows you to create dynamic views with clean, readable syntax while providing excellent performance.</p>

<h2>Blade Syntax</h2>
<p>Blade uses double curly braces for echoing data and provides many convenient directives for common PHP operations like loops, conditionals, and includes.</p>

<h2>Template Inheritance</h2>
<p>One of Blade\'s most powerful features is template inheritance. You can create master layouts and extend them in child templates, promoting code reuse.</p>

<h2>Components and Slots</h2>
<p>Blade components allow you to create reusable UI elements. They\'re perfect for building consistent interfaces across your application.</p>

<h2>Asset Management</h2>
<p>Laravel Mix provides a clean API for defining Webpack build steps for your application. It simplifies the process of compiling and optimizing your assets.</p>',
            'author' => 'Sarah Davis',
            'published_at' => '2024-02-08',
            'tags' => ['Laravel', 'Blade', 'Frontend'],
            'featured' => true
        ],
        [
            'id' => 5,
            'title' => 'Database Design and Migrations',
            'slug' => 'database-design-and-migrations',
            'excerpt' => 'Understanding database design principles and how to implement them using Laravel migrations.',
            'content' => '<p>Good database design is the foundation of any successful application. Laravel migrations provide a way to version control your database schema and make it easy to share with your team.</p>

<h2>Migration Basics</h2>
<p>Migrations are like version control for your database. They allow you to modify your database schema in a structured way and keep track of changes over time.</p>

<h2>Relationships</h2>
<p>Understanding database relationships (one-to-one, one-to-many, many-to-many) is crucial for designing efficient database schemas.</p>

<h2>Indexing</h2>
<p>Proper indexing can dramatically improve query performance. Laravel migrations make it easy to add indexes to your database tables.</p>

<h2>Data Seeding</h2>
<p>Seeders allow you to populate your database with test data. This is invaluable for development and testing environments.</p>',
            'author' => 'Alex Chen',
            'published_at' => '2024-02-15',
            'tags' => ['Database', 'Migrations', 'Laravel'],
            'featured' => false
        ]
    ];

    /**
     * Get all blog posts with optional pagination
     */
    public static function getAllPosts($perPage = 10, $page = 1)
    {
        $offset = ($page - 1) * $perPage;
        $posts = array_slice(self::$posts, $offset, $perPage);
        
        return [
            'data' => $posts,
            'current_page' => $page,
            'per_page' => $perPage,
            'total' => count(self::$posts),
            'last_page' => ceil(count(self::$posts) / $perPage)
        ];
    }

    /**
     * Get a single blog post by slug
     */
    public static function getPostBySlug($slug)
    {
        foreach (self::$posts as $post) {
            if ($post['slug'] === $slug) {
                return $post;
            }
        }
        return null;
    }

    /**
     * Get featured blog posts
     */
    public static function getFeaturedPosts()
    {
        return array_filter(self::$posts, function($post) {
            return $post['featured'] === true;
        });
    }

    /**
     * Search posts by title or content
     */
    public static function searchPosts($query)
    {
        $query = strtolower($query);
        return array_filter(self::$posts, function($post) use ($query) {
            return strpos(strtolower($post['title']), $query) !== false ||
                   strpos(strtolower($post['content']), $query) !== false ||
                   strpos(strtolower($post['excerpt']), $query) !== false;
        });
    }

    /**
     * Get posts by tag
     */
    public static function getPostsByTag($tag)
    {
        return array_filter(self::$posts, function($post) use ($tag) {
            return in_array($tag, $post['tags']);
        });
    }

    /**
     * Get all unique tags
     */
    public static function getAllTags()
    {
        $tags = [];
        foreach (self::$posts as $post) {
            $tags = array_merge($tags, $post['tags']);
        }
        return array_unique($tags);
    }

    /**
     * Get recent posts
     */
    public static function getRecentPosts($limit = 5)
    {
        $sortedPosts = self::$posts;
        usort($sortedPosts, function($a, $b) {
            return strtotime($b['published_at']) - strtotime($a['published_at']);
        });
        return array_slice($sortedPosts, 0, $limit);
    }
}
