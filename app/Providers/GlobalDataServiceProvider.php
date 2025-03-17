<?php

namespace App\Providers;

use App\Models\Post;
use App\Models\User;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class GlobalDataServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        // View Composer alleen voor admin-gerelateerde views
        View::composer(['backend.*'], function ($view) {
            $cacheKey = 'global_data';
            // Check of de cache bestaat, anders haal nieuwe data op
            $cacheData = Cache::remember($cacheKey, now()->addMinutes(10), function () {
                return [
                    'totalUsers' => User::count(),
                    'activeUsers' => User::where('is_active', 1)->count(),
                    'inactiveUsers' => User::where('is_active', 0)->count(),
                    'totalPosts' => Post::count(),
                    'publishedPosts' => Post::where('is_published', 1)->count(),
                    'unpublishedPosts' => Post::where('is_published', 0)->count(),
                ];
            });
            $view->with($cacheData);
        });
        // Cache vernieuwen bij wijzigingen in User of Post model of andere toekomstige modellen.
        foreach ([Post::class, User::class] as $model) {
            $model::saved(fn () => Cache::forget('global_data'));
            $model::deleted(fn () => Cache::forget('global_data'));
        }
    }
}
