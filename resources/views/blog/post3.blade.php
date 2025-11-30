<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Laravel Best Practices | Rohit Joshi</title>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap" rel="stylesheet" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css" />
  <style>
    :root{
      --bg:#0a0e27; --card:#131829; --text:#e8eaed; --muted:#a8adb8;
      --primary:#4f7cff; --accent:#00d4ff; --radius:10px;
    }
    *{box-sizing:border-box}
    html,body{
      font-family:'Inter',system-ui,-apple-system,Segoe UI,Roboto;
      background-color:var(--bg); color:var(--text); margin:0; padding:0;
      line-height:1.7;
    }
    a{color:inherit;text-decoration:none}
    
    header{
      position:fixed; left:0; right:0; top:0; height:64px;
      display:flex; align-items:center; justify-content:space-between;
      padding:0 32px; z-index:1200;
      background: rgba(10,14,39,0.95);
      border-bottom:1px solid rgba(255,255,255,0.05);
      backdrop-filter: blur(8px);
    }
    .logo{display:flex;align-items:center;gap:10px;font-weight:700;font-size:18px}
    .logo img{width:40px;height:40px;border-radius:6px}
    nav{display:flex;gap:28px}
    nav a{font-weight:500; font-size:14px; color:var(--muted); transition:color 0.2s}
    nav a:hover{color:var(--primary)}
    
    main{max-width:800px;margin:100px auto 60px;padding:0 28px}
    
    .back-link{
      display:inline-flex; align-items:center; gap:8px;
      padding:10px 16px; background:rgba(79,124,255,0.1);
      border:1px solid rgba(79,124,255,0.2); border-radius:6px;
      color:var(--primary); font-weight:600; font-size:13px;
      transition:all 0.2s; margin-bottom:40px;
    }
    .back-link:hover{background:rgba(79,124,255,0.2)}
    
    .article-header{margin-bottom:40px}
    .article-header h1{
      font-size:2.5rem; margin:0 0 16px; font-weight:700;
      letter-spacing:-0.5px; line-height:1.2;
    }
    .article-meta{
      display:flex; gap:20px; flex-wrap:wrap; font-size:13px;
      color:var(--muted); margin-bottom:24px;
    }
    .article-meta span{display:flex;align-items:center;gap:6px}
    .article-meta i{color:var(--primary)}
    
    .featured-image{
      width:100%; height:400px; object-fit:cover;
      border-radius:12px; margin-bottom:40px;
      border:1px solid rgba(79,124,255,0.2);
    }
    
    .article-content{color:var(--text)}
    .article-content h2{
      font-size:1.8rem; margin:40px 0 16px;
      color:var(--primary); font-weight:700;
    }
    .article-content h3{
      font-size:1.3rem; margin:28px 0 12px;
      color:var(--text); font-weight:700;
    }
    .article-content p{margin:16px 0;color:var(--muted);line-height:1.8}
    .article-content ul, .article-content ol{margin:16px 0;padding-left:24px}
    .article-content li{margin-bottom:12px;color:var(--muted)}
    .article-content strong{color:var(--text);font-weight:700}
    
    .code-block{
      background:var(--card); padding:20px; border-radius:8px;
      border:1px solid rgba(79,124,255,0.2); margin:20px 0;
      overflow-x:auto; border-left:4px solid var(--primary);
    }
    .code-block code{
      font-family:'Courier New',monospace; color:var(--accent);
      font-size:13px; line-height:1.6;
    }
    
    .highlight{
      background:rgba(79,124,255,0.1); padding:20px;
      border-radius:8px; border-left:4px solid var(--primary);
      margin:20px 0;
    }
    .highlight p{margin:0;color:var(--text)}
    .highlight strong{color:var(--accent)}
    
    .table-responsive{
      overflow-x:auto; margin:20px 0;
    }
    table{
      width:100%; border-collapse:collapse;
      background:var(--card); border-radius:8px;
      overflow:hidden;
    }
    th{
      background:rgba(79,124,255,0.1); padding:12px;
      text-align:left; font-weight:700; color:var(--primary);
    }
    td{
      padding:12px; border-top:1px solid rgba(255,255,255,0.03);
      color:var(--muted);
    }
    tr:hover{background:rgba(79,124,255,0.05)}
    
    .callout{
      padding:20px; border-radius:8px; margin:20px 0;
      display:flex; gap:16px; align-items:flex-start;
    }
    .callout.info{background:rgba(79,124,255,0.1);border-left:4px solid var(--primary)}
    .callout.warning{background:rgba(255,193,7,0.1);border-left:4px solid #ffc107}
    .callout.success{background:rgba(76,175,80,0.1);border-left:4px solid #4caf50}
    
    .callout-icon{
      font-size:24px; flex-shrink:0; line-height:1;
    }
    .callout.info .callout-icon{color:var(--primary)}
    .callout.warning .callout-icon{color:#ffc107}
    .callout.success .callout-icon{color:#4caf50}
    
    .toc{
      background:var(--card); padding:24px; border-radius:8px;
      border:1px solid rgba(79,124,255,0.2); margin-bottom:40px;
    }
    .toc h3{margin:0 0 16px;font-size:1.1rem;color:var(--text)}
    .toc ol{margin:0;padding-left:20px}
    .toc li{margin-bottom:8px}
    .toc a{color:var(--primary);transition:color 0.2s}
    .toc a:hover{color:var(--accent)}
    
    .article-footer{
      margin-top:60px; padding-top:40px;
      border-top:1px solid rgba(255,255,255,0.05);
    }
    
    .author-card{
      background:var(--card); padding:24px; border-radius:8px;
      border:1px solid rgba(79,124,255,0.2); display:flex;
      gap:20px; align-items:flex-start;
    }
    .author-avatar{
      width:80px; height:80px; border-radius:8px;
      background:rgba(79,124,255,0.1); flex-shrink:0;
      display:flex; align-items:center; justify-content:center;
      font-size:32px;
    }
    .author-info h4{margin:0 0 6px;color:var(--text)}
    .author-info p{margin:0;color:var(--muted);font-size:13px}
    
    .nav-posts{
      display:grid; grid-template-columns:1fr 1fr;
      gap:20px; margin-top:40px;
    }
    .nav-post{
      padding:20px; background:var(--card); border-radius:8px;
      border:1px solid rgba(79,124,255,0.2); transition:all 0.2s;
    }
    .nav-post:hover{border-color:rgba(79,124,255,0.4);background:rgba(79,124,255,0.02)}
    .nav-post small{color:var(--muted);font-size:12px}
    .nav-post h4{margin:8px 0 0;color:var(--primary);font-size:1rem}
    
    footer{padding:32px 28px;text-align:center;color:var(--muted);
      border-top:1px solid rgba(255,255,255,0.03);margin-top:60px;font-size:13px}
    
    @media(max-width:768px){
      .article-header h1{font-size:1.8rem}
      .featured-image{height:250px}
      nav{display:none}
      .nav-posts{grid-template-columns:1fr}
      .author-card{flex-direction:column;text-align:center}
    }
  </style>
</head>
<body>

  <header>
    <a class="logo" href="{{ route('home') }}">
      <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSn-mLqVUisgZmQ_I9xw8PEzAtgXSxbUM3pFw&s" alt="logo">
      <span style="color:var(--primary)">Rohit</span>
    </a>
    <nav>
      <a href="{{ route('home') }}">Home</a>
      <a href="{{ route('home') }}#projects">Projects</a>
      <a href="{{ route('blog.index') }}">Blog</a>
      <a href="{{ route('home') }}#contact">Contact</a>
    </nav>
  </header>

  <main>
    <a href="{{ route('blog.index') }}" class="back-link">
      <i class="fas fa-arrow-left"></i> Back to Blog
    </a>

    <article class="article-content">
      
      <div class="article-header">
        <h1>Laravel Best Practices</h1>
        <div class="article-meta">
          <span><i class="fas fa-calendar"></i> February 2025</span>
          <span><i class="fas fa-clock"></i> 6 min read</span>
          <span><i class="fas fa-user"></i> Rohit Joshi</span>
          <span><i class="fas fa-tag"></i> Laravel, PHP, Best Practices</span>
        </div>
      </div>

      <img src="https://images.unsplash.com/photo-1517694712202-14dd9538aa97?w=800&h=400&fit=crop" alt="Laravel Development" class="featured-image">

      <!-- Table of Contents -->
      <div class="toc">
        <h3><i class="fas fa-list" style="margin-right:8px"></i> Table of Contents</h3>
        <ol>
          <li><a href="#intro">Introduction</a></li>
          <li><a href="#eloquent">Use Eloquent Relationships Properly</a></li>
          <li><a href="#controllers">Keep Controllers Thin</a></li>
          <li><a href="#validation">Use Validation Form Requests</a></li>
          <li><a href="#caching">Cache Queries Intelligently</a></li>
          <li><a href="#softdeletes">Use Soft Deletes</a></li>
          <li><a href="#solid">Follow Single Responsibility Principle</a></li>
          <li><a href="#transactions">Use Database Transactions</a></li>
          <li><a href="#takeaways">Key Takeaways</a></li>
        </ol>
      </div>

      <h2 id="intro">Introduction</h2>
      <p>Laravel is a beautiful framework, but writing <em>good</em> Laravel code requires discipline and attention to detail. In this comprehensive post, I'll share essential practices I've learned from building production applications and maintaining large codebases.</p>

      <p>Following these best practices will help you write cleaner, more maintainable, and more performant Laravel applications.</p>

      <h2 id="eloquent">1. Use Eloquent Relationships Properly</h2>
      <p>One of the most common performance issues in Laravel applications is the N+1 query problem. This occurs when you query related data inside a loop without eager loading.</p>

      <div class="highlight">
        <p><strong>❌ Problem:</strong> This code will execute one query for users, then one query for each user's posts (N+1 queries)</p>
      </div>

      <div class="code-block">
        <code>$users = User::all();
foreach($users as $user) {
    echo $user->posts->count(); // Extra query per user!
}</code>
      </div>

      <div class="highlight">
        <p><strong>✅ Solution:</strong> Use eager loading with the <code>with()</code> method</p>
      </div>

      <div class="code-block">
        <code>$users = User::with('posts')->get();
foreach($users as $user) {
    echo $user->posts->count(); // No extra queries!
}</code>
      </div>

      <p>You can also use eager loading for multiple relationships:</p>

      <div class="code-block">
        <code>$users = User::with('posts', 'comments', 'followers')->get();</code>
      </div>

      <h2 id="controllers">2. Keep Controllers Thin</h2>
      <p>Controllers should orchestrate requests and responses, not contain business logic. Move complex logic to dedicated service classes or actions.</p>

      <div class="highlight">
        <p><strong>❌ Bad:</strong> Business logic in controller</p>
      </div>

      <div class="code-block">
        <code>class PostController extends Controller {
    public function store(Request $request) {
        $validated = $request->validate([...]);
        $post = Post::create($validated);
        $post->tags()->attach($request->tags);
        Cache::forget('posts.latest');
        event(new PostCreated($post));
        return redirect('/posts');
    }
}</code>
      </div>

      <div class="highlight">
        <p><strong>✅ Good:</strong> Business logic in action/service</p>
      </div>

      <div class="code-block">
        <code>class StorePostAction {
    public function execute(array $data): Post {
        $post = Post::create($data);
        $post->tags()->attach($data['tags']);
        Cache::forget('posts.latest');
        event(new PostCreated($post));
        return $post;
    }
}

class PostController extends Controller {
    public function store(StorePostRequest $request, StorePostAction $action) {
        $post = $action->execute($request->validated());
        return redirect('/posts');
    }
}</code>
      </div>

      <h2 id="validation">3. Use Validation Form Requests</h2>
      <p>Create dedicated Form Request classes instead of validating in your controller. This keeps validation logic organized and reusable.</p>

      <div class="code-block">
        <code>php artisan make:request StorePostRequest</code>
      </div>

      <div class="code-block">
        <code>class StorePostRequest extends FormRequest {
    public function authorize() {
        return true; // or implement authorization logic
    }
    
    public function rules() {
        return [
            'title' => 'required|string|max:255|unique:posts',
            'content' => 'required|string|min:10',
            'category_id' => 'required|exists:categories,id',
            'tags' => 'array|exists:tags,id',
        ];
    }
    
    public function messages() {
        return [
            'title.required' => 'Post title is mandatory',
            'content.min' => 'Content must be at least 10 characters',
        ];
    }
}</code>
      </div>

      <h2 id="caching">4. Cache Queries Intelligently</h2>
      <p>Use caching strategically to reduce database queries for frequently accessed data.</p>

      <div class="code-block">
        <code>// Cache for 1 hour (3600 seconds)
$posts = Cache::remember(
    'posts.latest', 
    3600, 
    function() {
        return Post::with('author')
            ->latest()
            ->take(10)
            ->get();
    }
);

// Or use forever cache for static data
$settings = Cache::rememberForever(
    'app.settings',
    fn() => Setting::all()->keyBy('key')
);

// Clear cache when data changes
Cache::forget('posts.latest');</code>
      </div>

      <h2 id="softdeletes">5. Use Soft Deletes</h2>
      <p>Soft deletes allow you to "delete" records while preserving data. Perfect for audit trails and recovery.</p>

      <div class="code-block">
        <code>// 1. Add deleted_at column
Schema::table('posts', function (Blueprint $table) {
    $table->softDeletes();
});

// 2. Use SoftDeletes trait
class Post extends Model {
    use SoftDeletes;
    
    protected $dates = ['deleted_at'];
}

// 3. Query behavior changes
Post::all(); // Excludes soft-deleted posts
Post::withTrashed()->get(); // Includes soft-deleted
Post::onlyTrashed()->get(); // Only soft-deleted
$post->restore(); // Restore deleted post</code>
      </div>

      <h2 id="solid">6. Follow Single Responsibility Principle</h2>
      <p>Each class should have one reason to change. A Model shouldn't handle email notifications—a Listener or Notification class should.</p>

      <div class="highlight">
        <p><strong>✅ Good Architecture:</strong></p>
      </div>

      <div class="code-block">
        <code>// Model - Data persistence only
class Post extends Model { }

// Service - Business logic
class PublishPostService {
    public function publish(Post $post): void {
        $post->update(['published_at' => now()]);
    }
}

// Notification - Send emails
class PostPublished {
    public function __invoke(Post $post) {
        Notification::send($post->author, new PostPublishedNotification());
    }
}</code>
      </div>

      <h2 id="transactions">7. Use Database Transactions</h2>
      <p>Wrap multiple database operations in transactions to ensure data consistency.</p>

      <div class="code-block">
        <code>DB::transaction(function () {
    $order = Order::create([
        'user_id' => auth()->id(),
        'total' => 100,
    ]);
    
    $order->items()->createMany($this->items);
    
    Wallet::where('user_id', auth()->id())
        ->decrement('balance', 100);
    
    event(new OrderCreated($order));
});</code>
      </div>

      <div class="callout info">
        <div class="callout-icon"><i class="fas fa-lightbulb"></i></div>
        <div>
          <strong>If any operation fails, all changes are rolled back automatically.</strong> This prevents partial updates that could corrupt your data.
        </div>
      </div>

      <h2 id="takeaways">Key Takeaways</h2>
      
      <div class="highlight" style="border-left:4px solid #4caf50">
        <ul style="margin:0;padding-left:20px">
          <li><strong>Use eager loading</strong> with <code>with()</code> to avoid N+1 queries</li>
          <li><strong>Keep controllers thin</strong> - move logic to services/actions</li>
          <li><strong>Validate with Form Requests</strong> - keep validation organized</li>
          <li><strong>Cache appropriately</strong> - remember expensive queries</li>
          <li><strong>Use soft deletes</strong> - preserve historical data</li>
          <li><strong>Follow SOLID principles</strong> - especially Single Responsibility</li>
          <li><strong>Use transactions</strong> - ensure data consistency</li>
          <li><strong>Write tests</strong> - catch bugs before production</li>
          <li><strong>Use Laravel's features</strong> - don't reinvent the wheel</li>
          <li><strong>Document your code</strong> - help future developers (including yourself)</li>
        </ul>
      </div>

      <div class="callout success">
        <div class="callout-icon"><i class="fas fa-check-circle"></i></div>
        <div>
          <strong>Pro Tip:</strong> Start with these practices on new projects. Refactoring legacy code takes time, so prioritize based on impact. Focus on N+1 queries first, then thin controllers.
        </div>
      </div>

      <h2>Conclusion</h2>
      <p>Mastering these Laravel best practices will significantly improve your code quality and application performance. Remember, clean code is not about perfection—it's about making your code readable, maintainable, and testable for yourself and your team.</p>

      <p>Start implementing these practices today, and you'll notice the difference in your Laravel projects immediately. Happy coding! 🚀</p>

    </article>

    <!-- Author Card -->
    <div class="article-footer">
      <div class="author-card">
        <div class="author-avatar">👨‍💻</div>
        <div class="author-info">
          <h4>Rohit Joshi</h4>
          <p>Laravel Developer & Backend Specialist. Passionate about building scalable web applications and sharing knowledge with the developer community.</p>
          <div style="display:flex;gap:12px;margin-top:12px">
            <a href="https://github.com/rohit-joshi25" target="_blank" style="color:var(--primary);transition:color 0.2s" title="GitHub">
              <i class="fab fa-github"></i> GitHub
            </a>
            <a href="https://www.linkedin.com/in/rohit-joshi-064ba926a/" target="_blank" style="color:var(--primary);transition:color 0.2s" title="LinkedIn">
              <i class="fab fa-linkedin"></i> LinkedIn
            </a>
          </div>
        </div>
      </div>

      <!-- Navigation to Other Posts -->
      <h3 style="margin-top:40px;margin-bottom:20px">Read Next</h3>
      <div class="nav-posts">
        <a href="{{ route('blog.post1') }}" class="nav-post">
          <small>← Previous Post</small>
          <h4>Why I Chose Web Development</h4>
        </a>
        <a href="{{ route('blog.post2') }}" class="nav-post">
          <small>Next Post →</small>
          <h4>PHP vs JavaScript for Backend</h4>
        </a>
      </div>
    </div>

  </main>

  <footer>
    &copy; 2025 Rohit Joshi • Laravel Developer • <a href="{{ route('home') }}#contact" style="color:var(--primary);font-weight:600">Get in Touch</a>
  </footer>

</body>
</html>