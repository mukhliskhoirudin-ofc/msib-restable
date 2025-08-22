<header id="header" class="header d-flex align-items-center sticky-top">
    <div class="container position-relative d-flex align-items-center justify-content-between">

        <a href="{{ url('/') }}" class="b-brand text-primary">
            <img src="{{ asset('frontend/assets/img/Restable.svg') }}" class="img-fluid logo-lg" alt="logo"
                width="150">
        </a>

        <nav id="navmenu" class="navmenu">
            <ul>
                <li><a href="#hero" class="active">Home<br></a></li>
                <li><a href="#about">About</a></li>
                <li><a href="#menu">Menu</a></li>
                <li><a href="#events">Events</a></li>
                <li><a href="#chefs">Chefs</a></li>
                <li><a href="#gallery">Gallery</a></li>
                <li><a href="#contact">Contact</a></li>
            </ul>
            <i class="mobile-nav-toggle d-xl-none bi bi-list"></i>
        </nav>

        <a href="{{ route('booking.store') }}" class="btn-getstarted" data-bs-toggle="modal"
            data-bs-target="#bookingModal">Booking Now</a>

    </div>
</header>
