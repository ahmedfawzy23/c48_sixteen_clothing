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
                    <x-nav-link route="products" lable="Our Products" />
                    <x-nav-link route="about" lable="About Us" />
                    <x-nav-link route="contact" lable="Contact Us" />

                </ul>
            </div>
        </div>
    </nav>
</header>
