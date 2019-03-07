<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Http\Request;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind('App\Contracts\Dao\RegisterDaoInterface', 'App\Dao\RegisterDao');
        $this->app->bind('App\Contracts\Dao\AuthorDaoInterface', 'App\Dao\AuthorDao');
        $this->app->bind('App\Contracts\Dao\GenreDaoInterface', 'App\Dao\GenreDao');
        $this->app->bind('App\Contracts\Dao\BookDaoInterface', 'App\Dao\BookDao');
        
        
        $this->app->bind('App\Contracts\Services\RegisterServiceInterface', 'App\Services\RegisterService');
        $this->app->bind('App\Contracts\Services\AuthorServiceInterface', 'App\Services\AuthorService');
        $this->app->bind('App\Contracts\Services\GenreServiceInterface', 'App\Services\GenreService');
        $this->app->bind('App\Contracts\Services\BookServiceInterface', 'App\Services\BookService');

      
        
    }
}
