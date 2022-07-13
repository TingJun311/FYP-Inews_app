
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
            <div class="container row row-cols-1 row-cols-md-2 g-4 text-center card-template" style="margin-left: 6rem;">
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
                                            <form action="/article/news" method="POST" >
                                                @csrf
                                                <h2 class="card-title">
                                                    <input id="hideInput" name="link" value="${user.link}" style="display: none;" >
                                                    <button type="submit">
                                                        <a href="#">${user.title}</a>
                                                    </button>
                                                </h2>
                                            </form>
                                            <div class="card-text">
                                                <p>${user.summary.substring(0, 200)}...</p>
                                            </div>
                                            <p class="card-text">
                                                <small class="text-muted">${user.published_date}</small>
                                            </p>
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