<section id="menu" class="menu section">
    <!-- Section Title -->
    <div class="container section-title" data-aos="fade-up">
        <h2>Our Menu</h2>
        <p><span>Check Our</span> <span class="description-title">Yummy Menu</span></p>
    </div><!-- End Section Title -->

    <div class="container">
        <ul class="nav nav-tabs d-flex justify-content-center" data-aos="fade-up" data-aos-delay="100">
            @foreach ($categories as $category)
                <li class="nav-item">
                    <a class="nav-link {{ $loop->first ? 'active show' : '' }}" data-bs-toggle="tab"
                        data-bs-target="#menu-{{ $category->slug }}">
                        <h4>{{ $category->name }}</h4>
                    </a>
                </li><!-- End tab nav item -->
            @endforeach
        </ul>

        <div class="tab-content" data-aos="fade-up" data-aos-delay="200">
            @foreach ($categories as $category)
                <div class="tab-pane fade {{ $loop->first ? 'active show' : '' }}" id="menu-{{ $category->slug }}">
                    <div class="tab-header text-center">
                        <p>Menu</p>
                        <h3>{{ $category->name }}</h3>
                    </div>

                    <div class="row gy-5">
                        @forelse($category->menus as $menu)
                            <div class="col-lg-4 menu-item">
                                <a href="{{ asset('storage/' . $menu->image) }}" class="glightbox">
                                    <img src="{{ asset('storage/' . $menu->image) }}" class="menu-img img-fluid"
                                        alt="{{ $menu->name }}">
                                </a>
                                <h4>{{ $menu->name }}</h4>
                                <p class="ingredients">
                                    {{ $menu->description }}
                                </p>
                                <p class="price">
                                    Rp.{{ number_format($menu->price, 0, ',', '.') }}
                                </p>
                            </div><!-- Menu Item -->
                        @empty
                            <div class="col-12 text-center">
                                <p>No menu items available for this category.</p>
                            </div>
                        @endforelse
                    </div>
                </div><!-- End Menu Content -->
            @endforeach
        </div>
    </div>
</section>
