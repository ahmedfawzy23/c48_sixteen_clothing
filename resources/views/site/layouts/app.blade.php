<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link href="https://fonts.googleapis.com/css?family=Poppins:100,200,300,400,500,600,700,800,900&display=swap"
        rel="stylesheet">

    <title>@yield('title', "Sixteen Clothing")</title>

    <!-- Bootstrap core CSS -->
    <link href="{{ asset('site') }}/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <!--

TemplateMo 546 Sixteen Clothing

https://templatemo.com/tm-546-sixteen-clothing

-->

    <!-- Additional CSS Files -->
    <link rel="stylesheet" href="{{ asset('site') }}/assets/css/fontawesome.css">
    <link rel="stylesheet" href="{{ asset('site') }}/assets/css/templatemo-sixteen.css">
    <link rel="stylesheet" href="{{ asset('site') }}/assets/css/owl.css">

</head>

<body>

    <!-- ***** Preloader Start ***** -->
    <div id="preloader">
        <div class="jumper">
            <div></div>
            <div></div>
            <div></div>
        </div>
    </div>
    <!-- ***** Preloader End ***** -->

    <!-- Header -->
    @include('site.partials.navbar')
    <!-- Page Content -->
    <main>
        @yield('content')
    </main>


    @include('site.partials.footer')


    <!-- Bootstrap core JavaScript -->
    <script src="{{ asset('site') }}/vendor/jquery/jquery.min.js"></script>
    <script src="{{ asset('site') }}/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>


    <!-- Additional Scripts -->
    <script src="{{ asset('site') }}/assets/js/custom.js"></script>
    <script src="{{ asset('site') }}/assets/js/owl.js"></script>
    <script src="{{ asset('site') }}/assets/js/slick.js"></script>
    <script src="{{ asset('site') }}/assets/js/isotope.js"></script>
    <script src="{{ asset('site') }}/assets/js/accordions.js"></script>


    <script language="text/Javascript">
        cleared[0] = cleared[1] = cleared[2] = 0; //set a cleared flag for each field
        function clearField(t) {                   //declaring the array outside of the
            if (!cleared[t.id]) {                      // function makes it static and global
                cleared[t.id] = 1;  // you could use true and false, but that's more typing
                t.value = '';         // with more chance of typos
                t.style.color = '#fff';
            }
        }
    </script>


</body>

</html>
