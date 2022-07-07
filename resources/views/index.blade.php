<h1>testing fetch</h1>
{{-- {{ $newsData->articles }} --}}
@unless (count((array)$newsData) == 0)
    @foreach ($newsData as $news)
        <div>
            <h1>{{ $news->title }}</h1>
            <p>{{ $news->author }}</p>
            <h5>{{ $news->description }}</h5>
            <img src="{{ $news->urlToImage }}" alt="">
            <a href="{{ $news->url }}">{{ $news->url }}</a>
        </div>
    @endforeach
@else
    <p>No data</p>
@endunless
{{-- {{ dd($newsData) }} --}}