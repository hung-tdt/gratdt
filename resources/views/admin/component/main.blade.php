<!DOCTYPE html>
<html>

<head>
    @include('admin.component.head')
</head>

<body>

    <div id="wrapper">

    @include('admin.component.sidebar')

        <div id="page-wrapper" class="gray-bg">
        <div class="row border-bottom">
        <nav class="navbar navbar-static-top" role="navigation" style="margin-bottom: 0">
        <div class="navbar-header">
            <a class="navbar-minimalize minimalize-styl-2 btn btn-primary " href="#"><i class="fa fa-bars"></i> </a>
            <a class="minimalize-styl-2 btn btn-primary " href="/admin/main">Home </a>
            <form role="search" class="navbar-form-custom" action="search_results.html">
                <div class="form-group">
                    <input type="text" placeholder="Search for something..." class="form-control" name="top-search" id="top-search">
                </div>
            </form>
        </div>
            <ul class="nav navbar-top-links navbar-right">                
                <li>
                    <a href="{{ route('auths.logout')}}">
                        <i class="fa fa-sign-out"></i> Logout
                    </a>
                </li>
            </ul>

        </nav>
        </div>
        <div>
            @include('admin.component.alert')
        </div>
            

            @yield('content')


        {{-- <div class="footer">          
            <div>
                <strong>Copyright</strong> Example Company &copy; 2014-2017
            </div>
        </div> --}}

        </div>
        </div>



    @include('admin.component.footer')
</body>

</html>
