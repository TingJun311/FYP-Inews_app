<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="_token" content="{{ csrf_token() }}">

    {{-- Favicon --}}
    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('images/favicon_io/apple-touch-icon.png') }}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('images/favicon_io/favicon-32x32.png') }}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('images/favicon_io/avicon-16x16.png') }}">
    <link rel="manifest" href="{{ asset('images/favison_io/site.webmanifest') }}">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"/>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet" type="text/css">

    {{-- aplpinejs for handling some event --}}
    <script src="//unpkg.com/alpinejs" defer></script>

    {{-- Jquery cdn --}}
    <script
        src="https://code.jquery.com/jquery-3.6.0.js"
        integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk="
        crossorigin="anonymous"></script> 

    <script
        src="https://code.jquery.com/jquery-3.6.0.js"
        integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk="
        crossorigin="anonymous">
    </script>
    
    {{-- Bootstrap --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    
    {{-- External JS file --}}
    <script src="{{ asset('js/app.js') }}" defer></script>
    <title>Inews</title>
    <style>
        .header-img {
            width: 50px;
            height: 50px;
            object-fit: cover;
            border-radius: 100%;
            margin-right: 1rem;
            flex-shrink: 0;
        }
    </style>
</head>
<body>
    <div class="wrapper">
        <nav>
            <input type="checkbox" id="show-search">
            <input type="checkbox" id="show-menu">
            <label for="show-menu" class="menu-icon"><i class="fas fa-bars"></i></label>
            <div class="content" style="margin: 0%">
                <div class="logo">
                    <a href="/">Inews</a>
                </div>
                <ul class="links" style="padding-top: 18px">
                    
                    <li><a href="/">Latest</a></li>
                    {{-- <li><a href="#">About</a></li> --}}
                    {{-- <li><a href="#">Feedback</a></li> --}}
                    <li>
                        <a href="#" class="desktop-link">Category <i class="fas fa-solid fa-caret-down"></i></a>
                        <input type="checkbox" id="show-services">
                        <label for="show-services">Category </label>
                        <ul>
                            <li><a href="/category/business">Business</a></li>
                            <li><a href="/category/entertainment">Entertainment</a></li>
                            <li><a href="/category/health">Health</a></li>
                            <li><a href="/category/science">Science</a></li>
                            <li><a href="/category/sports">Sports</a></li>
                            <li><a href="/category/technology">Technology</a></li>
                            {{-- <li>
                                <a href="#" class="desktop-link">More Items <i class="fas fa-solid fa-caret-down"></i> </a>
                                <input type="checkbox" id="show-items">
                                <label for="show-items">More Items</label>
                                <ul>
                                    <li><a href="#">Sub Menu 1</a></li>
                                    <li><a href="#">Sub Menu 2</a></li>
                                    <li><a href="#">Sub Menu 3</a></li>
                                </ul>
                            </li> --}}
                        </ul>
                    </li>
                    <li>
                        <a href="#" class="desktop-link">More <i class="fas fa-solid fa-caret-down"></i></a>
                        <input type="checkbox" id="show-features">
                        <label for="show-features">Features</label>
                        <ul>
                            <li><a href="#">Advanced search</a></li>
                            {{-- <li><a href="#">Drop Menu 2</a></li>
                            <li><a href="#">Drop Menu 3</a></li>
                            <li><a href="#">Drop Menu 4</a></li> --}}
                        </ul>
                    </li>
                    {{-- If user its auththenticated render different components --}}
                    @auth
                        <li style="color: white">
                            <button 
                                class="btn btn-primary" 
                                type="button" 
                                data-bs-toggle="offcanvas" 
                                data-bs-target="#offcanvasRight" 
                                aria-controls="offcanvasRight"
                            >{{ auth()->user()->name }}</button>
                        </li>
                        <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasRight" aria-labelledby="offcanvasRightLabel">
                            <div class="offcanvas-header">
                                <h5 id="offcanvasRightLabel">Users profile</h5>
                                <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                            </div>
                            <div class="offcanvas-body">
                                <form action="/users/logout" method="POST">
                                    @csrf
                                    <button class="btn btn-primary" type="submit">
                                        Logout
                                    </button>
                                </form>
                                <button>
                                    <a href="/users/bookmark">show</a>
                                </button>
                            </div>
                        </div>
                    @else
                        <li>
                            <a href="/login">
                                <i class="fas fa-solid fa-user"></i> Sign in
                            </a>
                        </li>
                    @endauth
                </ul>
            </div>
            <label for="show-search" class="search-icon"><i class="fas fa-search"></i></label>
            <form action="/search/news" method="POST" class="search-box">
                @csrf
                <input 
                    type="text" 
                    name="searchBox" 
                    id="searchBox" 
                    placeholder="Type Something to Search..." 
                    value="{{ old('searchBox') }}"
                    required>
                <button type="submit" class="go-icon">
                    <i class="fas fa-long-arrow-alt-right"></i>
                </button>
            </form>
            
        </nav>
    </div>
    <br>
    <br>
    <br>
    <br>
    <main>
        <div class="container-fiuld">
            <div class="row">
                <div class="col-3">
                    <div class="flex-shrink-0 p-3 bg-white" style="width: 280px;">
                    <a href="/" class="d-flex align-items-center pb-3 mb-3 link-dark text-decoration-none border-bottom">
                    <svg class="bi me-2" width="30" height="24"><use xlink:href="#bootstrap"/></svg>
                    <span class="fs-5 fw-semibold">Collapsible</span>
                    </a>
                    <ul class="list-unstyled ps-0">
                    <li class="mb-1">
                        <button class="btn btn-toggle align-items-center rounded collapsed" data-bs-toggle="collapse" data-bs-target="#home-collapse" aria-expanded="true">
                        Home
                        </button>
                        <div class="collapse show" id="home-collapse">
                        <ul class="btn-toggle-nav list-unstyled fw-normal pb-1 small">
                            <li><a href="#" class="link-dark rounded">Overview</a></li>
                            <li><a href="#" class="link-dark rounded">Updates</a></li>
                            <li><a href="#" class="link-dark rounded">Reports</a></li>
                        </ul>
                        </div>
                    </li>
                    <li class="mb-1">
                        <button class="btn btn-toggle align-items-center rounded collapsed" data-bs-toggle="collapse" data-bs-target="#dashboard-collapse" aria-expanded="false">
                        Dashboard
                        </button>
                        <div class="collapse" id="dashboard-collapse">
                        <ul class="btn-toggle-nav list-unstyled fw-normal pb-1 small">
                            <li><a href="#" class="link-dark rounded">Overview</a></li>
                            <li><a href="#" class="link-dark rounded">Weekly</a></li>
                            <li><a href="#" class="link-dark rounded">Monthly</a></li>
                            <li><a href="#" class="link-dark rounded">Annually</a></li>
                        </ul>
                        </div>
                    </li>
                    <li class="mb-1">
                        <button class="btn btn-toggle align-items-center rounded collapsed" data-bs-toggle="collapse" data-bs-target="#orders-collapse" aria-expanded="false">
                        Orders
                        </button>
                        <div class="collapse" id="orders-collapse">
                        <ul class="btn-toggle-nav list-unstyled fw-normal pb-1 small">
                            <li><a href="#" class="link-dark rounded">New</a></li>
                            <li><a href="#" class="link-dark rounded">Processed</a></li>
                            <li><a href="#" class="link-dark rounded">Shipped</a></li>
                            <li><a href="#" class="link-dark rounded">Returned</a></li>
                        </ul>
                        </div>
                    </li>
                    <li class="border-top my-3"></li>
                    <li class="mb-1">
                        <button class="btn btn-toggle align-items-center rounded collapsed" data-bs-toggle="collapse" data-bs-target="#account-collapse" aria-expanded="false">
                        Account
                        </button>
                        <div class="collapse" id="account-collapse">
                        <ul class="btn-toggle-nav list-unstyled fw-normal pb-1 small">
                            <li><a href="#" class="link-dark rounded">New...</a></li>
                            <li><a href="#" class="link-dark rounded">Profile</a></li>
                            <li><a href="#" class="link-dark rounded">Settings</a></li>
                            <li><a href="#" class="link-dark rounded">Sign out</a></li>
                        </ul>
                        </div>
                    </li>
                    </ul>
                </div>
                </div>
                <div class="col-6">
                    {{ $slot }}
                </div>
                <div class="col-3">x</div>
            </div>
        </div>
    </main>
    <br>
    <footer class="text-white text-center text-lg-start" style="background: #2f3e46">
    <!-- Grid container -->
        <div class="container p-4">
            <!--Grid row-->
            <div class="row">
                <!--Grid column-->
                <div class="col-lg-6 col-md-12 mb-4 mb-md-0">
                    <h5 class="text-uppercase"><strong>Explore the Inews</strong></h5>
                    <p>
                        Inews is an operational business division of the world Broadcasting Corporation responsible for the gathering and broadcasting of news and current affairs in around the world. 
                    </p>
                </div>
                <!--Grid column-->

                <!--Grid column-->
                <div class="col-lg-3 col-md-6 mb-4 mb-md-0">
                    <h5 class="text-uppercase">Category</h5>

                    <ul class="list-unstyled mb-0">
                        <li>
                            <a href="/category/business" class="text-white">buiness</a>
                        </li>
                        <li>
                            <a href="/category/entertainment" class="text-white">entertainment</a>
                        </li>
                        <li>
                            <a href="/category/health" class="text-white">health</a>
                        </li>
                        <li>
                            <a href="/category/science" class="text-white">science</a>
                        </li>
                        <li>
                            <a href="/category/sports" class="text-white">sports</a>
                        </li>
                        <li>
                            <a href="/category/technology" class="text-white">technology</a>
                        </li>
                    </ul>
                </div>
                <!--Grid column-->

                <!--Grid column-->
                <div class="col-lg-3 col-md-6 mb-4 mb-md-0">
                    <h5 class="text-uppercase mb-0">Links</h5>
                    <ul class="list-unstyled">
                        <li>
                            <a href="#!" class="text-white">Link 1</a>
                        </li>
                        <li>
                            <a href="#!" class="text-white">Link 2</a>
                        </li>
                        <li>
                            <a href="#!" class="text-white">Link 3</a>
                        </li>
                        <li>
                            <a href="#!" class="text-white">Link 4</a>
                        </li>
                    </ul>
                </div>
            <!--Grid column-->
            </div>
            <!--Grid row-->
        </div>
        <!-- Grid container -->

        <!-- Copyright -->
        <div class="text-center p-3" style="background-color: rgba(0, 0, 0, 0.2);">
            © {{ date("Y") }} Copyright:
            <a class="text-white" href="/">Inews</a>
        </div>
    <!-- Copyright -->
    </footer>
   
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>~
</body>
</html>