
{{-- Main content --}}

<x-layout>
    <div class="container-fiuld">
        <div class="row">
            <div class="col-3" id="sideNav"></div>
            <div class="col-6" id="mainDiv"></div>
            <div class="col-3" id="rightNav"></div>
        </div>
    </div>
</x-layout>
<script>
    const urlParams = {
        query: {!! json_encode($query) !!},
        lang: {!! json_encode($lang) !!},
        page: {!! json_encode($page) !!},
    } 

    function callNewsApi(paramsObject) {
        laodingScreen("mainDiv", false);
            // if (is.chrome()) { // true if is Google Chrome
            //     window.stop();
            //     console.log("clicked");
            // };
        const { query, lang, page } = paramsObject;
        var data = {
            query: query,
            lang: lang,
            page: page,
            _token: $('meta[name="_token"]').attr('content')
        };
        $.ajax({
            type: 'POST',
            url: '/getLatest',
            dataType: 'json',           
            data: data,
            success: function(data) {
                const { user_input, status, total_hits, page, total_pages, page_size, articles } = JSON.parse(data);
                laodingScreen("mainDiv", true);
                console.log(data);
                window.location.href = `/home/${query}/${lang}/${articles}/${page}/${total_pages}`;
            },
            error: function() {
                console.log("Error");
            }
        });
    }
    callNewsApi(urlParams);
    function laodingScreen(idDiv, status) {
        const div = document.querySelector(`#${idDiv}`);
        div.innerHTML = (status === true)? "" : "Laoding...";
    };

    function renderAJAXCall(articles, input, status, page, totalPage, page_size) {
        const data = {
            userInput: input,
            articles: articles,
            status: status,
            page: page,
            totalPage: totalPage,
            page_size: page_size,
            _token: $('meta[name="_token"]').attr('content'),
        };

        $.ajax({
            type: 'POST',
            url: '/news',
            dataType: 'json',           
            data: data,
            success: function(data) {
                const { user_input, status, total_hits, page, total_pages, page_size, articles } = JSON.parse(data);
                laodingScreen("mainDiv", true);
            },
            error: function() {
                console.log("Error");
            }
        });
    }
</script>
<script src="{{ asset('js/main.js') }}"></script>