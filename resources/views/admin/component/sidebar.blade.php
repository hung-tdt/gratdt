<nav class="navbar-default navbar-static-side" role="navigation">
        <div class="sidebar-collapse">
            <ul class="nav metismenu" id="side-menu">
                <li class="nav-header" style="padding-left: 70px;">
                    @include('admin.component.profile')
                    <div class="logo-element">                      
                    </div>

                </li>

                <li>
                    @can('show.catalog')
                        <a href="#"><i class="fa fa-th-large"></i> <span class="nav-label">Manage Homepage</span> <span class="fa arrow"></span></a>
                        <ul class="nav nav-second-level collapse">
                            @can('show.catalog')
                                <li><a href="{{ route('homepages.showCatalog') }}">Show Catalog</a></li>
                            @endcan
                            @can('show.postcategories')
                                <li><a href="{{ route('homepages.showPostCategories') }}">Show PostCategories</a></li>
                            @endcan
                        </ul>
                    @endcan
                </li>
                <li>
                    @can('admins.list')
                        <a href="{{ route('admins.index') }}"><i class="fa fa-sitemap"></i> <span class="nav-label">Manage employees</span></a>
                    @endcan
                </li>

                <li>
                    @can('roles.list')
                        <a href="{{ route('roles.index') }}"><i class="fa fa-sitemap"></i> <span class="nav-label">Manage roles</span></a>
                    @endcan
                </li>

                <li>
                    @can('customers.list')
                        <a href="{{ route('customers.index') }}"><i class="fa fa-sitemap"></i> <span class="nav-label">Manage customers</span></a>
                    @endcan
                </li>

                <li>
                    @can('posts.list')
                        <a href="{{ route('posts.list') }}"><i class="fa fa-edit"></i> <span class="nav-label">Manage posts</span></a>
                    @endcan
                </li>

                <li>
                    @can('post_categories.list')
                        <a href="{{ route('post_categories.list') }}"><i class="fa fa-edit"></i> <span class="nav-label">Article categories</span></a>
                    @endcan
                </li>
                
                <li>
                    @can('coupons.list')
                        <a href="{{ route('coupons.list') }}"><i class="fa fa-files-o"></i> <span class="nav-label">Manage coupons</span></a>
                    @endcan
                </li>
           
                <li>
                    @can('promotions.list')
                        <a href="{{ route('promotions.list') }}"><i class="fa fa-files-o"></i> <span class="nav-label">Manage promotions</span></a>
                    @endcan
                </li>

                <li>
                    @can('products.list')
                        <a href="{{ route('products.list') }}"><i class="fa fa-table"></i> <span class="nav-label">Manage products</span></a>
                    @endcan
                </li>

                <li>
                    @can('product_categories.list')
                        <a href="{{ route('product_categories.list') }}"><i class="fa fa-files-o"></i> <span class="nav-label">Product Catalogs</span></a>
                    @endcan
                </li>
                
                <li>
                    @can('stocks.all.history')
                        <a href="{{ route('stock.history') }}"><i class="fa fa-files-o"></i> <span class="nav-label">Manage Stock History</span></a>
                    @endcan
                </li>
                
                <li>
                    @can('sliders.list')
                        <a href="{{ route('sliders.list') }}"><i class="fa fa-files-o"></i> <span class="nav-label">Manage sliders</span></a>
                    @endcan
                </li>
                
                
                <li>
                   
                    <a href="#"><i class="fa fa-shopping-cart"></i> <span class="nav-label">Manage orders</span> <span class="fa arrow"></span></a>
                    <ul class="nav nav-second-level collapse">
                        @can('orders.received_cancel')
                            <li><a href="{{ route('orders.list') }}">Orders List</a></li>
                        @endcan
                        @can('orders.confirmer')
                            <li><a href="{{ route('orders.pending') }}">Pending</a></li>
                        @endcan
                        @can('orders.packing')
                            <li><a href="{{ route('orders.orderconfirmed') }}">Order Confirmed</a></li>
                        @endcan
                        @can('orders.shiper')
                            <li><a href="{{ route('orders.shipping') }}">Shipping</a></li>
                        @endcan
                        @can('orders.received_cancel')
                            <li><a href="{{ route('orders.received') }}">Received</a></li>
                            <li><a href="{{ route('orders.cancelled') }}">Cancelled</a></li>
                        @endcan
                    </ul>
                  
                </li>
                
            </ul>

        </div>
    </nav>