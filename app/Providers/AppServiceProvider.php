<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Schema;
use DB;
use Log;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Schema::defaultStringLength(191);


        // DB::listen(
        //     function ($sql) {
        //         foreach ($sql->bindings as $i => $binding) {
        //             if ($binding instanceof \DateTime) {
        //                 $sql->bindings[$i] = $binding->format('\'Y-m-d H:i:s\'');
        //             } else {
        //                 if (is_string($binding)) {
        //                     $sql->bindings[$i] = "'$binding'";
        //                 }
        //             }
        //         }
        //         // Insert bindings into query
        //         $query = str_replace(['%', '?'], ['%%', '%s'], $sql->sql);
        //         $query = vsprintf($query, $sql->bindings);
        //         Log::debug($query);
        //     }
        // );
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
