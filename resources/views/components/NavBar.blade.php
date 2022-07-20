
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
                </ul>
            </li>
            <li>
                <a href="#" class="desktop-link">More <i class="fas fa-solid fa-caret-down"></i></a>
                <input type="checkbox" id="show-features">
                <label for="show-features">Features</label>
                <ul>
                    <li><a href="#">Advanced search</a></li>
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