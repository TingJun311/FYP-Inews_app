
<x-layout>
    @unless (count((array)$newsData) == 0)
        @if ($newsData['status'] != 'error')
            <div class="container row row-cols-1 row-cols-md-2 g-4 text-center">

                @foreach ($newsData['articles'] as $news)
                    {{-- <x-news-card :news="$news" /> --}}
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
        @else    
            <div class="container row row-cols-1 row-cols-md-2 g-4 text-center">
                <div class="container"></div>
            </div>
        @endif
    @else
        <p>No data</p>
    @endunless
</x-layout>
<script>
    async function testing() {
        const options = {
            method: 'GET',
            headers: {
                'X-RapidAPI-Key': '{{ env("API_KEY") }}',
                'X-RapidAPI-Host': 'free-news.p.rapidapi.com',
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

        let container = document.querySelector('.container');
        container.innerHTML = html;
    }

    renderUsers();
</script>