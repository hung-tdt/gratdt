
<meta name="csrf-token" content="{{ csrf_token() }}">
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
@if(isset($title))
    <title>{{ $title }}</title>
@endif
    <link href="/admin/admin/css/bootstrap.min.css" rel="stylesheet">
    <link href="/admin/admin/font-awesome/css/font-awesome.css" rel="stylesheet">
    <link href="/admin/admin/css/plugins/footable/footable.core.css" rel="stylesheet">
    <link href="/admin/admin/css/animate.css" rel="stylesheet">
    <link href="/admin/admin/css/style.css" rel="stylesheet">
    <link href="/admin/admin/css/plugins/summernote/summernote.css" rel="stylesheet">
    <link href="/admin/admin/css/plugins/summernote/summernote-bs3.css" rel="stylesheet">
    <link href="/admin/admin/css/fix.css" rel="stylesheet">
    <link href="/admin/fix.css" rel="stylesheet">
    <link href="/admin/admin/css/plugins/iCheck/custom.css" rel="stylesheet">

    @yield('head')