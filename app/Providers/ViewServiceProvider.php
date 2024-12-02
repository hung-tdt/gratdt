<?php
 
namespace App\Providers;
 

use Illuminate\Support\Facades;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use App\Http\View\Composers\AdminComposer;
use App\Http\View\Composers\CustomerComposer;
use App\Http\View\Composers\PostCategoryShowComposer;
use App\Http\View\Composers\ProductCategoryShowComposer;
use App\Http\View\Composers\CartComposer;
use App\Http\View\Composers\NotificationComposer;

class ViewServiceProvider extends ServiceProvider
{
   
    public function register(): void
    {
        // ...
    }
 
    public function boot(): void
    {
        // View::composer('*', AdminComposer::class);
        View::composer('admin.component.profile',AdminComposer::class);
        View::composer('customer.component.header',CustomerComposer::class);
        View::composer('customer.*',PostCategoryShowComposer::class);
        View::composer('customer.*', ProductCategoryShowComposer::class);
        View::composer('customer.*', CartComposer::class);
        View::composer('customer.*', NotificationComposer::class);
    }
}
