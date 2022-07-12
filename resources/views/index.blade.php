
<x-layout>
    {{-- @unless (count((array)$newsData) == 0)
        @if ($newsData['status'] != 'error')
            <div class="container row row-cols-1 row-cols-md-2 g-4 text-center">

                @foreach ($newsData['articles'] as $news)
                    <x-news-card :news="$news" />
                    <div class="col">
                        <div class="card">
                            <img 
                                src="{{ $news['urlToImage']? $news['urlToImage'] : asset('images/coverFade.png') }}" 
                                class="card-img-top " 
                                alt="Loading...">
                            <div class="card-body">
                                <h4 class="card-title">
                                    <a href="{{ $news['url'] }}">
                                        {{ $news['title'] }}
                                    </a>
                                </h4>
                                <p class="card-text ">{{ $news['description'] }}.</p>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @else     --}}

        <div class="card" aria-hidden="true">
            <img src="..." class="card-img-top" alt="...">
            <div class="card-body">
                <h5 class="card-title placeholder-glow">
                    <span class="placeholder col-6"></span>
                </h5>
                <p class="card-text placeholder-glow">
                    <span class="placeholder col-7"></span>
                    <span class="placeholder col-4"></span>
                    <span class="placeholder col-4"></span>
                    <span class="placeholder col-6"></span>
                    <span class="placeholder col-8"></span>
                </p>
                <a href="#" tabindex="-1" class="btn btn-primary disabled placeholder col-6"></a>
            </div>
        </div>
            <div class="container row row-cols-1 row-cols-md-2 g-4 text-center card-template">
                <div class="col">
                    <div class="card">
                    <img class="card-img-top skeleton header-img ">
                    <div class="card-body">
                        <h5 class="card-title skeleton skeleton-text"></h5>
                        <p class="card-text skeleton skeleton-text"></p>
                    </div>
                    </div>
                </div>
                
                <div class="col">
                    <div class="card">
                        <img class="card-img-top skeleton header-img ">
                        <div class="card-body">
                            <h5 class="card-title skeleton skeleton-text"></h5>
                            <p class="card-text skeleton skeleton-text"></p>
                        </div>
                    </div>
                </div>
                <div class="col">
                    <div class="card">
                        <img class="card-img-top skeleton header-img ">
                        <div class="card-body">
                            <h5 class="card-title skeleton skeleton-text"></h5>
                            <p class="card-text skeleton skeleton-text"></p>
                        </div>
                    </div>
                </div>
                <div class="col">
                    <div class="card">
                        <img class="card-img-top skeleton header-img ">
                        <div class="card-body">
                            <h5 class="card-title skeleton skeleton-text"></h5>
                            <p class="card-text skeleton skeleton-text"></p>
                        </div>
                    </div>
                </div>
            </div>
        {{-- @endif
    @else
        <p>No data</p>
    @endunless --}}
</x-layout>
<script>
    async function testing() {
        const options = {
            method: 'GET',
            headers: {
                'X-RapidAPI-Key': '{{ env("API_KEY") }}',
                'X-RapidAPI-Host': '{{ env("API_HOST") }}',
            }
        };
        try {
            let res = await fetch('https://free-news.p.rapidapi.com/v1/search?q=latest&lang=en', options);
            return await res.json();
            
        } catch (error) {
            console.log(error);
        }
    } 

    async function renderUsers() {
        let users = await testing();
        let html = '';
        console.log(users);
        users.articles.forEach(user => {
            let htmlSegment = `
                                <div class="col">
                                    <div class="card">
                                        <img src=${user.media}>
                                        <div class="card-body">
                                            <h2 class="card-title">${user.title}</h2>
                                            <div class="email"><a href="${user.link}">${user.title}</a></div>
                                        </div>
                                    </div>
                                </div>
                            `;

            html += htmlSegment;
        });

        const container = document.querySelector('.card-template');
        const grid = document.querySelector('.grid');
        container.innerHTML = html;
    }

    renderUsers();
</script>