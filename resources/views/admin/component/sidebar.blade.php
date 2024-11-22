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
                        <a href="#"><i class="fa fa-sitemap"></i> <span class="nav-label">Manage employees</span> <span class="fa arrow"></span></a>
                        <ul class="nav nav-second-level collapse">
                            @can('admins.list')
                                <li><a href="{{ route('admins.index') }}">List of accounts</a></li>
                            @endcan
                            @can('roles.list')
                                <li><a href="{{ route('roles.index') }}">List of roles</a></li>
                            @endcan
                        </ul>
                    @endcan
                </li>
                
                <li>
                    @can('customers.list')
                        <a href="#"><i class="fa fa-sitemap"></i> <span class="nav-label">Manage customers</span> <span class="fa arrow"></span></a>
                        <ul class="nav nav-second-level collapse">
                            <li><a href="{{ route('customers.index') }}">Customer List</a></li>
                        </ul>
                    @endcan
                </li>
                
                <li>
                    @can('posts.list')
                        <a href="#"><i class="fa fa-edit"></i> <span class="nav-label">Manage posts</span> <span class="fa arrow"></span></a>
                        <ul class="nav nav-second-level collapse">
                            @can('posts.list')
                                <li><a href="{{ route('posts.list') }}">List of posts</a></li>
                            @endcan
                            @can('post_categories.list')
                                <li><a href="{{ route('post_categories.list') }}">Article categories</a></li>
                            @endcan
                        </ul>
                    @endcan
                </li>
                
                <li>
                    @can('coupons.list')
                        <a href="#"><i class="fa fa-files-o"></i> <span class="nav-label">Manage Coupon</span> <span class="fa arrow"></span></a>
                        <ul class="nav nav-second-level collapse">
                            <li><a href="{{ route('coupons.list') }}">Coupon List</a></li>
                        </ul>
                    @endcan
                </li>
                
                <li>
                    @can('products.list')
                        <a href="#"><i class="fa fa-table"></i> <span class="nav-label">Manage products</span> <span class="fa arrow"></span></a>
                        <ul class="nav nav-second-level collapse">
                            @can('products.list')
                                <li><a href="{{ route('products.list') }}">Product List</a></li>
                            @endcan
                            @can('product_categories.list')
                                <li><a href="{{ route('product_categories.list') }}">Product Catalog</a></li>
                            @endcan
                        </ul>
                    @endcan
                </li>
                
                <li>
                    @can('stocks.all.history')
                        <a href="#"><i class="fa fa-desktop"></i> <span class="nav-label">Manage Stock History</span> <span class="fa arrow"></span></a>
                        <ul class="nav nav-second-level collapse">
                            <li><a href="{{ route('stock.history') }}">All stock History</a></li>
                        </ul>
                    @endcan
                </li>
                
                <li>
                    @can('sliders.list')
                        <a href="#"><i class="fa fa-picture-o"></i> <span class="nav-label">Manage Ads</span> <span class="fa arrow"></span></a>
                        <ul class="nav nav-second-level collapse">
                            <li><a href="{{ route('sliders.list') }}">Ads List</a></li>
                        </ul>
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