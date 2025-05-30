<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Website Sekolah')</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">

    <style>
        .navbar-brand {
            font-weight: bold;
        }
        .hero-section {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 100px 0;
        }
        .card-hover:hover {
            transform: translateY(-5px);
            transition: all 0.3s ease;
        }
        footer {
            background-color: #2c3e50;
            color: white;
        }
        .news-card {
            border: none;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }
        .gallery-item {
            position: relative;
            overflow: hidden;
        }
        .gallery-item img {
            transition: transform 0.3s ease;
        }
        .gallery-item:hover img {
            transform: scale(1.1);
        }
    </style>

    @yield('styles')
</head>
<body>
    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary sticky-top">
        <div class="container">
            <a class="navbar-brand" href="{{ route('home') }}">
                @if(setting('header_logo'))
                <img src="{{ asset('storage/' . setting('header_logo')) }}" alt="{{ setting('header_title', 'Sekolah Kami') }}" style="height: 40px;" class="me-2">
                @else
                <i class="fas fa-graduation-cap me-2"></i>
                @endif
                {{ setting('header_title', 'Sekolah Kami') }}
            </a>

            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    @php
                        $menus = \App\Models\Menu::getMenuTree();
                    @endphp

                    @foreach($menus as $menu)
                    <li class="nav-item {{ $menu->hasChildren() ? 'dropdown' : '' }}">
                        @if($menu->hasChildren())
                        <!-- Dropdown Menu -->
                        <a class="nav-link dropdown-toggle {{ $menu->css_class }}"
                           href="#"
                           role="button"
                           data-bs-toggle="dropdown"
                           aria-expanded="false">
                            @if($menu->icon)
                            <i class="{{ $menu->icon }} me-1"></i>
                            @endif
                            {{ $menu->title }}
                        </a>
                        <ul class="dropdown-menu">
                            @foreach($menu->children as $child)
                            <li>
                                <a class="dropdown-item {{ $child->css_class }}"
                                   href="{{ $child->url }}"
                                   {{ $child->open_new_tab ? 'target="_blank"' : '' }}>
                                    @if($child->icon)
                                    <i class="{{ $child->icon }} me-2"></i>
                                    @endif
                                    {{ $child->title }}
                                </a>
                            </li>
                            @endforeach
                        </ul>
                        @else
                        <!-- Regular Menu -->
                        <a class="nav-link {{ $menu->css_class }}"
                           href="{{ $menu->url }}"
                           {{ $menu->open_new_tab ? 'target="_blank"' : '' }}>
                            @if($menu->icon)
                            <i class="{{ $menu->icon }} me-1"></i>
                            @endif
                            {{ $menu->title }}
                        </a>
                        @endif
                    </li>
                    @endforeach
                </ul>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <main>
        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="py-5 mt-5">
        <div class="container">
            <div class="row">
                <div class="col-md-4">
                    <h5>
                        @if(setting('header_logo'))
                        <img src="{{ asset('storage/' . setting('header_logo')) }}" alt="{{ setting('header_title', 'Sekolah Kami') }}" style="height: 30px;" class="me-2">
                        @else
                        <i class="fas fa-graduation-cap me-2"></i>
                        @endif
                        {{ setting('header_title', 'Sekolah Kami') }}
                    </h5>
                    <p>{{ setting('footer_about', 'Memberikan pendidikan berkualitas untuk masa depan yang cerah.') }}</p>

                    <!-- Social Media Links -->
                    @if(setting('social_facebook') || setting('social_instagram') || setting('social_youtube') || setting('social_twitter'))
                    <div class="mt-3">
                        <h6>Follow Us</h6>
                        <div class="d-flex gap-2">
                            @if(setting('social_facebook'))
                            <a href="{{ setting('social_facebook') }}" class="text-light" target="_blank">
                                <i class="fab fa-facebook fa-lg"></i>
                            </a>
                            @endif
                            @if(setting('social_instagram'))
                            <a href="{{ setting('social_instagram') }}" class="text-light" target="_blank">
                                <i class="fab fa-instagram fa-lg"></i>
                            </a>
                            @endif
                            @if(setting('social_youtube'))
                            <a href="{{ setting('social_youtube') }}" class="text-light" target="_blank">
                                <i class="fab fa-youtube fa-lg"></i>
                            </a>
                            @endif
                            @if(setting('social_twitter'))
                            <a href="{{ setting('social_twitter') }}" class="text-light" target="_blank">
                                <i class="fab fa-twitter fa-lg"></i>
                            </a>
                            @endif
                        </div>
                    </div>
                    @endif
                </div>
                <div class="col-md-4">
                    <h5>Quick Links</h5>
                    <ul class="list-unstyled">
                        <li><a href="{{ route('home') }}" class="text-light text-decoration-none">Home</a></li>
                        <li><a href="{{ route('about') }}" class="text-light text-decoration-none">About Us</a></li>
                        <li><a href="{{ route('academics') }}" class="text-light text-decoration-none">Academics</a></li>
                        <li><a href="{{ route('contact') }}" class="text-light text-decoration-none">Contact</a></li>
                    </ul>
                </div>
                <div class="col-md-4">
                    <h5>Contact Info</h5>
                    @if(setting('footer_address'))
                    <p><i class="fas fa-map-marker-alt me-2"></i>{{ setting('footer_address') }}</p>
                    @endif
                    @if(setting('footer_phone'))
                    <p><i class="fas fa-phone me-2"></i>{{ setting('footer_phone') }}</p>
                    @endif
                    @if(setting('footer_email'))
                    <p><i class="fas fa-envelope me-2"></i>{{ setting('footer_email') }}</p>
                    @endif
                </div>
            </div>
            <hr class="my-4">
            <div class="text-center">
                <p>&copy; {{ date('Y') }} {{ setting('footer_copyright', 'Sekolah Kami. All rights reserved.') }}</p>
            </div>
        </div>
    </footer>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    @yield('scripts')
</body>
</html>
