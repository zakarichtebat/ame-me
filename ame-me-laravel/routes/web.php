<?php

use App\Http\Controllers\Admin\BlogController as AdminBlogController;
use App\Http\Controllers\BlogController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\DashboardController;

Route::get('/', function () {
    return view('animations');
});

Route::get('/vue', function () {
    return view('vue');
});

Route::get('/animations', function () {
    return view('animations');
});

Route::get('/about', function () {
    return view('about');
})->name('about');

Route::get('/contact', function () {
    return view('contact');
})->name('contact');

Route::get('/cgvs', function () {
    return view('cgvs');
})->name('cgvs');

// Routes du blog
Route::prefix('blog')->group(function () {
    Route::get('/', [BlogController::class, 'index'])->name('blog.index');
    Route::get('/search', [BlogController::class, 'search'])->name('blog.search');
    Route::get('/category/{slug}', [BlogController::class, 'category'])->name('blog.category');
    Route::get('/{slug}', [BlogController::class, 'show'])->name('blog.show');
});

// Routes admin
Route::prefix('admin')->middleware(['auth'])->group(function () {
    Route::get('/dashboard', function () {
        return view('admin.dashboard');
    })->name('admin.dashboard');

    Route::resource('posts', AdminBlogController::class)->names([
        'index' => 'admin.posts.index',
        'create' => 'admin.posts.create',
        'store' => 'admin.posts.store',
        'edit' => 'admin.posts.edit',
        'update' => 'admin.posts.update',
        'destroy' => 'admin.posts.destroy',
    ]);
});

// Routes d'administration
Route::prefix('admin')->name('admin.')->middleware(['auth', 'admin'])->group(function () {
    // Tableau de bord
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

    // Gestion des blogs
    Route::prefix('blog')->name('blog.')->group(function () {
        Route::get('/', [App\Http\Controllers\Admin\BlogController::class, 'index'])->name('index');
        Route::get('/create', [App\Http\Controllers\Admin\BlogController::class, 'create'])->name('create');
        Route::post('/', [App\Http\Controllers\Admin\BlogController::class, 'store'])->name('store');
        Route::get('/{post}/edit', [App\Http\Controllers\Admin\BlogController::class, 'edit'])->name('edit');
        Route::put('/{post}', [App\Http\Controllers\Admin\BlogController::class, 'update'])->name('update');
        Route::delete('/{post}', [App\Http\Controllers\Admin\BlogController::class, 'destroy'])->name('destroy');

        // Catégories
        Route::get('/categories', [App\Http\Controllers\Admin\CategoryController::class, 'index'])->name('categories');
        Route::post('/categories', [App\Http\Controllers\Admin\CategoryController::class, 'store'])->name('categories.store');
        Route::put('/categories/{category}', [App\Http\Controllers\Admin\CategoryController::class, 'update'])->name('categories.update');
        Route::delete('/categories/{category}', [App\Http\Controllers\Admin\CategoryController::class, 'destroy'])->name('categories.destroy');

        // Tags
        Route::get('/tags', [App\Http\Controllers\Admin\TagController::class, 'index'])->name('tags');
        Route::post('/tags', [App\Http\Controllers\Admin\TagController::class, 'store'])->name('tags.store');
        Route::put('/tags/{tag}', [App\Http\Controllers\Admin\TagController::class, 'update'])->name('tags.update');
        Route::delete('/tags/{tag}', [App\Http\Controllers\Admin\TagController::class, 'destroy'])->name('tags.destroy');

        // Commentaires
        Route::get('/comments', [App\Http\Controllers\Admin\CommentController::class, 'index'])->name('comments');
        Route::post('/comments/{comment}/approve', [App\Http\Controllers\Admin\CommentController::class, 'approve'])->name('comments.approve');
        Route::delete('/comments/{comment}', [App\Http\Controllers\Admin\CommentController::class, 'destroy'])->name('comments.destroy');
    });

    // Gestion des pages
    Route::resource('pages', App\Http\Controllers\Admin\PageController::class);

    // Gestion des services
    Route::prefix('services')->name('services.')->group(function () {
        Route::get('/', [App\Http\Controllers\Admin\ServiceController::class, 'index'])->name('index');
        Route::get('/create', [App\Http\Controllers\Admin\ServiceController::class, 'create'])->name('create');
        Route::post('/', [App\Http\Controllers\Admin\ServiceController::class, 'store'])->name('store');
        Route::get('/{service}/edit', [App\Http\Controllers\Admin\ServiceController::class, 'edit'])->name('edit');
        Route::put('/{service}', [App\Http\Controllers\Admin\ServiceController::class, 'update'])->name('update');
        Route::delete('/{service}', [App\Http\Controllers\Admin\ServiceController::class, 'destroy'])->name('destroy');

        // Catégories de services
        Route::get('/categories', [App\Http\Controllers\Admin\ServiceCategoryController::class, 'index'])->name('categories');
        Route::post('/categories', [App\Http\Controllers\Admin\ServiceCategoryController::class, 'store'])->name('categories.store');
        Route::put('/categories/{category}', [App\Http\Controllers\Admin\ServiceCategoryController::class, 'update'])->name('categories.update');
        Route::delete('/categories/{category}', [App\Http\Controllers\Admin\ServiceCategoryController::class, 'destroy'])->name('categories.destroy');
    });

    // Gestion des médias
    Route::prefix('media')->name('media.')->group(function () {
        Route::get('/', [App\Http\Controllers\Admin\MediaController::class, 'index'])->name('index');
        Route::get('/upload', [App\Http\Controllers\Admin\MediaController::class, 'create'])->name('upload');
        Route::post('/upload', [App\Http\Controllers\Admin\MediaController::class, 'store'])->name('store');
        Route::delete('/{media}', [App\Http\Controllers\Admin\MediaController::class, 'destroy'])->name('destroy');
    });

    // Gestion des messages
    Route::prefix('messages')->name('messages.')->group(function () {
        Route::get('/', [App\Http\Controllers\Admin\MessageController::class, 'index'])->name('index');
        Route::get('/{message}', [App\Http\Controllers\Admin\MessageController::class, 'show'])->name('show');
        Route::put('/{message}/read', [App\Http\Controllers\Admin\MessageController::class, 'markAsRead'])->name('read');
        Route::put('/{message}/unread', [App\Http\Controllers\Admin\MessageController::class, 'markAsUnread'])->name('unread');
        Route::delete('/{message}', [App\Http\Controllers\Admin\MessageController::class, 'destroy'])->name('destroy');
    });

    // Gestion de la newsletter
    Route::prefix('newsletter')->name('newsletter.')->group(function () {
        Route::get('/subscribers', [App\Http\Controllers\Admin\NewsletterController::class, 'subscribers'])->name('subscribers');
        Route::get('/create', [App\Http\Controllers\Admin\NewsletterController::class, 'create'])->name('create');
        Route::post('/send', [App\Http\Controllers\Admin\NewsletterController::class, 'send'])->name('send');
        Route::delete('/subscribers/{subscriber}', [App\Http\Controllers\Admin\NewsletterController::class, 'destroySubscriber'])->name('subscribers.destroy');
    });

    // Gestion des utilisateurs
    Route::resource('users', App\Http\Controllers\Admin\UserController::class);

    // Paramètres
    Route::prefix('settings')->name('settings.')->group(function () {
        Route::get('/general', [App\Http\Controllers\Admin\SettingController::class, 'general'])->name('general');
        Route::get('/appearance', [App\Http\Controllers\Admin\SettingController::class, 'appearance'])->name('appearance');
        Route::get('/seo', [App\Http\Controllers\Admin\SettingController::class, 'seo'])->name('seo');
        Route::get('/social', [App\Http\Controllers\Admin\SettingController::class, 'social'])->name('social');
        Route::post('/save', [App\Http\Controllers\Admin\SettingController::class, 'save'])->name('save');
    });

    // Analytics
    Route::get('/analytics', [App\Http\Controllers\Admin\AnalyticsController::class, 'index'])->name('analytics');

    // Profil utilisateur
    Route::get('/profile', [App\Http\Controllers\Admin\ProfileController::class, 'edit'])->name('profile');
    Route::put('/profile', [App\Http\Controllers\Admin\ProfileController::class, 'update'])->name('profile.update');
    Route::put('/profile/password', [App\Http\Controllers\Admin\ProfileController::class, 'updatePassword'])->name('profile.password');
});

// Routes pour le blog front-end
Route::prefix('blog')->name('blog.')->group(function () {
    Route::get('/', [App\Http\Controllers\BlogController::class, 'index'])->name('index');
    Route::get('/{slug}', [App\Http\Controllers\BlogController::class, 'show'])->name('show');
    Route::get('/category/{slug}', [App\Http\Controllers\BlogController::class, 'category'])->name('category');
    Route::get('/tag/{slug}', [App\Http\Controllers\BlogController::class, 'tag'])->name('tag');
    Route::post('/{post}/comment', [App\Http\Controllers\BlogController::class, 'storeComment'])->name('comment');
});

// Routes pour les services front-end
Route::prefix('services')->name('services.')->group(function () {
    Route::get('/', [App\Http\Controllers\ServiceController::class, 'index'])->name('index');
    Route::get('/{slug}', [App\Http\Controllers\ServiceController::class, 'show'])->name('show');
    Route::get('/category/{slug}', [App\Http\Controllers\ServiceController::class, 'category'])->name('category');
});

// Soumission du formulaire de contact
Route::post('/contact', [App\Http\Controllers\ContactController::class, 'submit'])->name('contact.submit');

// Inscription à la newsletter
Route::post('/newsletter/subscribe', [App\Http\Controllers\NewsletterController::class, 'subscribe'])->name('newsletter.subscribe');

// Redirection des routes non définies vers la page d'accueil
Route::fallback(function () {
    return redirect('/');
});