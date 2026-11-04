<header class="">
    <nav class="navbar navbar-expand-lg">
        <div class="container">
            <a class="navbar-brand" href="{{ route('home') }}">
                <h2>Sixteen <em>Clothing</em></h2>
            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive"
                aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarResponsive">
                <ul class="navbar-nav ml-auto">
                    <x-nav-link route="home" lable="Home" />
                    <x-nav-link route="products" lable="Products" />
                    <x-nav-link route="about" lable="About" />
                    <x-nav-link route="contact" lable="Contact" />
                    <x-nav-link route="cart.index" lable="Cart" />
                    @guest
                        <x-nav-link route="register.show" lable="Register" />
                        <x-nav-link route="login.show" lable="Login" />
                    @endguest
                    @auth
                        <x-nav-link route="logout" lable="Logout" method="post" />
                    @endauth

                </ul>
            </div>
            <form class="form-inline my-2 my-lg-0" method="get" action="{{ route('products') }}">
                <input class="form-control mr-sm-2" name="search" type="search" placeholder="Search"
                    value="{{ request()->search }}" aria-label="Search" onchange="this.form.submit()">
            </form>

        </div>

    </nav>
</header>
