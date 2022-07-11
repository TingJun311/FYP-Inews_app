
<x-layout>
    @unless (count((array)$newsData) == 0)
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
    @else
        <p>No data</p>
    @endunless
</x-layout>
<script>
    // async function testing() {

    //     try {
    //         let res = await fetch('https://newsapi.org/v2/top-headlines?apiKey=1af4bb95edad418caf381547a9c2115c&country=my');
    //         return await res.json();
            
    //     } catch (error) {
    //         console.log(error);
    //     }
    // } 

    // async function renderUsers() {
    //     let users = await testing();
    //     let html = '';
    //     console.log(users);
    //     // users.forEach(user => {
    //     //     let htmlSegment = `<div class="user">
    //     //                         <img src="${user.profileURL}" >
    //     //                         <h2>${user.firstName} ${user.lastName}</h2>
    //     //                         <div class="email"><a href="email:${user.email}">${user.email}</a></div>
    //     //                     </div>`;

    //     //     html += htmlSegment;
    //     // });

    //     let container = document.querySelector('.container');
    //     container.innerHTML = html;
    // }

    // renderUsers();
</script>