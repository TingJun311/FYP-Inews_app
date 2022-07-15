
<x-layout>
    @unless (count($bookmark) == 0)
            @foreach ($bookmark as $item)
                <div class="card">
                    <div class="card-header">
                        By {{ $item->author }}
                    </div>
                    <div class="card-body">
                        <blockquote class="blockquote mb-0">
                            <p>{{ $item->title }}</p>
                            <footer class="blockquote-footer">Someone famous in 
                                <cite title="Source Title">
                                    <a href="{{ $item->url }}">
                                        {{ $item->url }}
                                    </a>
                                </cite>
                            </footer>
                        </blockquote>
                    </div>
                </div>
            @endforeach
    @else
        <p>No dont have any bookmark news</p>
    @endunless
</x-layout>