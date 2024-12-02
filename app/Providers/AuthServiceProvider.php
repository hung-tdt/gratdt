<?php

namespace App\Providers;

use Illuminate\Support\Facades\Gate;
use App\Models\Admin;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        //
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {
        //admins
        Gate::define('admins.list', function (Admin $admin) {
            return $admin->checkPermissionAccess('admins_list');
        });
        Gate::define('admins.add', function (Admin $admin) {
            return $admin->checkPermissionAccess('admins_add');
        });
        Gate::define('admins.edit', function (Admin $admin) {
            return $admin->checkPermissionAccess('admins_edit');
        });
        Gate::define('admins.destroy', function (Admin $admin) {
            return $admin->checkPermissionAccess('admins_destroy');
        });

        //customers
        Gate::define('customers.list', function (Admin $admin) {
            return $admin->checkPermissionAccess('customers_list');
        });
        Gate::define('customers.add', function (Admin $admin) {
            return $admin->checkPermissionAccess('customers_add');
        });
        Gate::define('customers.edit', function (Admin $admin) {
            return $admin->checkPermissionAccess('customers_edit');
        });
        Gate::define('customers.destroy', function (Admin $admin) {
            return $admin->checkPermissionAccess('customers_destroy');
        });

        //roles
        Gate::define('roles.list', function (Admin $admin) {
            return $admin->checkPermissionAccess('roles_list');
        });
        Gate::define('roles.add', function (Admin $admin) {
            return $admin->checkPermissionAccess('roles_add');
        });
        Gate::define('roles.edit', function (Admin $admin) {
            return $admin->checkPermissionAccess('roles_edit');
        });
        Gate::define('roles.destroy', function (Admin $admin) {
            return $admin->checkPermissionAccess('roles_destroy');
        });


        //product_categories
        Gate::define('product_categories.list', function (Admin $admin) {
            return $admin->checkPermissionAccess('product_categories_list');
        });
        Gate::define('product_categories.add', function (Admin $admin) {
            return $admin->checkPermissionAccess('product_categories_add');
        });
        Gate::define('product_categories.edit', function (Admin $admin) {
            return $admin->checkPermissionAccess('product_categories_edit');
        });
        Gate::define('product_categories.destroy', function (Admin $admin) {
            return $admin->checkPermissionAccess('product_categories_destroy');
        });


        //products
        Gate::define('products.list', function (Admin $admin) {
            return $admin->checkPermissionAccess('products_list');
        });
        Gate::define('products.add', function (Admin $admin) {
            return $admin->checkPermissionAccess('products_add');
        });
        Gate::define('products.edit', function (Admin $admin) {
            return $admin->checkPermissionAccess('products_edit');
        });
        Gate::define('products.destroy', function (Admin $admin) {
            return $admin->checkPermissionAccess('products_destroy');
        });


        //posts
        Gate::define('posts.list', function (Admin $admin) {
            return $admin->checkPermissionAccess('posts_list');
        });
        Gate::define('posts.add', function (Admin $admin) {
            return $admin->checkPermissionAccess('posts_add');
        });
        Gate::define('posts.edit', function (Admin $admin) {
            return $admin->checkPermissionAccess('posts_edit');
        });
        Gate::define('posts.destroy', function (Admin $admin) {
            return $admin->checkPermissionAccess('posts_destroy');
        });


        //post_categories
        Gate::define('post_categories.list', function (Admin $admin) {
            return $admin->checkPermissionAccess('post_categories_list');
        });
        Gate::define('post_categories.add', function (Admin $admin) {
            return $admin->checkPermissionAccess('post_categories_add');
        });
        Gate::define('post_categories.edit', function (Admin $admin) {
            return $admin->checkPermissionAccess('post_categories_edit');
        });
        Gate::define('post_categories.destroy', function (Admin $admin) {
            return $admin->checkPermissionAccess('post_categories_destroy');
        });


        //sliders
        Gate::define('sliders.list', function (Admin $admin) {
            return $admin->checkPermissionAccess('sliders_list');
        });
        Gate::define('sliders.add', function (Admin $admin) {
            return $admin->checkPermissionAccess('sliders_add');
        });
        Gate::define('sliders.edit', function (Admin $admin) {
            return $admin->checkPermissionAccess('sliders_edit');
        });
        Gate::define('sliders.destroy', function (Admin $admin) {
            return $admin->checkPermissionAccess('sliders_destroy');
        });

        //orders     
        Gate::define('orders.confirmer', function (Admin $admin) {
            return $admin->checkPermissionAccess('confirmer');
        });
        Gate::define('orders.packing', function (Admin $admin) {
            return $admin->checkPermissionAccess('packing');
        });
        Gate::define('orders.shiper', function (Admin $admin) {
            return $admin->checkPermissionAccess('shiper');
        });
        Gate::define('orders.received_cancel', function (Admin $admin) {
            return $admin->checkPermissionAccess('received_cancel');
        });

        //homepages     
        Gate::define('show.catalog', function (Admin $admin) {
            return $admin->checkPermissionAccess('show_catalog');
        });
        Gate::define('show.postcategories', function (Admin $admin) {
            return $admin->checkPermissionAccess('show_postcategories');
        });

        //stocks     
        Gate::define('stocks.add', function (Admin $admin) {
            return $admin->checkPermissionAccess('stock_add');
        });
        Gate::define('stocks.history.item', function (Admin $admin) {
            return $admin->checkPermissionAccess('show_history_item');
        });
        Gate::define('stocks.all.history', function (Admin $admin) {
            return $admin->checkPermissionAccess('show_all_history');
        });


        //coupons     
        Gate::define('coupons.list', function (Admin $admin) {
            return $admin->checkPermissionAccess('coupons_list');
        });
        Gate::define('coupons.add', function (Admin $admin) {
            return $admin->checkPermissionAccess('coupons_add');
        });
        Gate::define('coupons.edit', function (Admin $admin) {
            return $admin->checkPermissionAccess('coupons_edit');
        });
        Gate::define('coupons.destroy', function (Admin $admin) {
            return $admin->checkPermissionAccess('coupons_destroy');
        });

        //promotions
        Gate::define('promotions.list', function (Admin $admin) {
            return $admin->checkPermissionAccess('promotions_list');
        });
        Gate::define('promotions.add', function (Admin $admin) {
            return $admin->checkPermissionAccess('promotions_add');
        });
        Gate::define('promotions.edit', function (Admin $admin) {
            return $admin->checkPermissionAccess('promotions_edit');
        });
        Gate::define('promotions.destroy', function (Admin $admin) {
            return $admin->checkPermissionAccess('promotions_destroy');
        });

    }
}
