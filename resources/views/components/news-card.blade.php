
@props(['news'])

<div class="card bg-dark text-white">
    <img src="{{ $news['urlToImage'] }}" class="card-img opacity-25 " alt="">
    <div class="card-img-overlay">
        <h5 class="card-title ">{{ $news['title'] }}</h5>
        <p class="card-text">{{ $news['description'] }}</p>
        <p class="card-text">{{ $news['author'] }}</p>
    </div>
</div>