
<link rel="stylesheet" href="{{ asset('css/main.css') }}">
<style>
    #sideNav {
        position: sticky;
    }
</style>
<x-layout>
    <div class="container-fluid">
        <div class="row">
            <div class="col-3">
                <x-sideNav />    
            </div> 
            <div class="col-7">
                <div class="container row row-cols-1 row-cols-md-2 g-4 text-center card-template"></div>
                <br>
                <br>
                <div id="pagination"></div>
            </div>
            <div class="col-2">
                <label for="lang">Language:</label>
                <select name="lang" id="language" onchange="{onChangeLang()}">
                    <option value="en">English</option>
                    <option value="zh">Chinese</option>
                    <option value="de">German</option>
                    <option value="es">Spanish</option>
                    <option value="fr">French</option>
                    <option value="it">Italian</option>
                    <option value="nl">Dutch</option>
                    <option value="ru">Russian</option>
                    <option value="sv">Swedish</option>
                    <option value="pt">Portuguese</option>
                    <option value="no">Norwegian</option>
                    <option value="ar">Arabic</option>
                    <option value="he">Hebrew</option>
                </select>
            </div>
        </div>
    </div>
</x-layout>
<script>
    const newsComponent = (articles) => {
        const container = document.querySelector('.card-template');
        let component = '';

        articles.forEach(article => {
            let text = (article.summary !== null)? article.summary.substring(0, 200) : "No text";
            let htmlSegment = `
                <div class="col">
                    <div class="card">
                        <img src=${article.media}>
                        <div class="card-body">
                            <form action="/article/news" method="POST" >
                                @csrf
                                <h2 class="card-title">
                                    <input id="hideInput" name="link" value="${article.link}" style="display: none;" >
                                    <button type="submit">
                                        <a href="#">${article.title}</a>
                                    </button>
                                </h2>
                            </form>
                            <div class="card-text">
                                <p>${text}...</p>
                            </div>
                            <p class="card-text">
                                <small class="text-muted">${article.published_date}</small>
                            </p>
                        </div>
                    </div>
                </div>
            `;
            component += htmlSegment;
        });

        container.innerHTML = component;
    };


    const onChangeLang = () => {
        const centerDiv = document.querySelector('.card-template');
        const emptyPagination = document.querySelector('#pagination');
        emptyPagination.innerHTML = "";
        centerDiv.innerHTML = `
                            <div class="text-center">
                                <div class="spinner-border" style="width: 3rem; height: 3rem;" role="status">
                                    <span class="visually-hidden">Loading...</span>
                                </div>
                            </div>
                            `;

        const selectedLang = $('#language').find(':selected').val();
            var data = {
                lang: selectedLang,
                _token: $('meta[name="_token"]').attr('content')
            }

            $.ajax({
                type: 'POST',
                url: '/lang',
                dataType: 'json',           
                data: data,
                success: function(data) {
                    const { articles, status, totalResults } = data;
                    console.log(data);
                    newsAPIComponent(articles);
                },
                error: function() {
                    console.log("Error");
                }
            });
    };

    const newsAPIComponent = (articles) => {
        const centerDiv = document.querySelector('.card-template');
        let component = '';

        articles.forEach(article => {
            const { author, source, title, description, publishedAt, url, urlToImage } = article;
            let text = (title !== null)? title : "No title";
            let htmlSegment = `
                <div class="col">
                    <div class="card">
                        <img src=${(urlToImage !== null)? urlToImage : '{{ asset("images/default1.png") }}'}>
                        <div class="card-body">
                            <form action="/article/news" method="POST" >
                                @csrf
                                <h2 class="card-title">
                                    <input id="hideInput" name="link" value="${url}" style="display: none;" >
                                    <button type="submit">
                                        <a href="${url}">${title}</a>
                                    </button>
                                </h2>
                            </form>
                            <div class="card-text">
                                <p>${text}...</p>
                            </div>
                            <p class="card-text">
                                <small class="text-muted">${publishedAt}</small>
                            </p>
                        </div>
                    </div>
                </div>
            `;
            component += htmlSegment;
        });

        centerDiv.innerHTML = component;
    };

</script>
<script src="{{ asset('js/index.js') }}"></script>