    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">

    <?php if(isset($title)): ?>
    <title><?= $title ?></title>
    <?php else: ?>
        <title>Trueshop</title>
    <?php endif; ?>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- Favicons -->

    <base href="http://127.0.0.1:8000/">


   
    <!-- Favicons -->
    <link rel="shortcut icon" href="customer\img\favicon.ico">
    <!-- Fontawesome css -->
    <link rel="stylesheet" href="customer\css\font-awesome.min.css">
    <!-- Ionicons css -->
    <link rel="stylesheet" href="customer\css\ionicons.min.css">
    <!-- linearicons css -->
    <link rel="stylesheet" href="customer\css\linearicons.css">
    <!-- Nice select css -->
    <link rel="stylesheet" href="customer\css\nice-select.css">
    <!-- Jquery fancybox css -->
    <link rel="stylesheet" href="customer\css\jquery.fancybox.css">
    <!-- Jquery ui price slider css -->
    <link rel="stylesheet" href="customer\css\jquery-ui.min.css">
    <!-- Meanmenu css -->
    <link rel="stylesheet" href="customer\css\meanmenu.min.css">
    <!-- Nivo slider css -->
    <link rel="stylesheet" href="customer\css\nivo-slider.css">
    <!-- Owl carousel css -->
    <link rel="stylesheet" href="customer\css\owl.carousel.min.css">
    <!-- Bootstrap css -->
    <link rel="stylesheet" href="customer\css\bootstrap.min.css">
    <!-- Custom css -->
    <link rel="stylesheet" href="customer\css\default.css">
    <!-- Main css -->
    <link rel="stylesheet" href="customer\style.css">
    
    <!-- Responsive css -->
    <link rel="stylesheet" href="customer\css\responsive.css">

    <link rel="stylesheet" href="customer\fix\fix.css">

    <!-- Modernizer js -->
    <script src="customer\js\vendor\modernizr-3.5.0.min.js"></script>

    @yield('head')