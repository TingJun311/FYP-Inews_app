
<style>
    *{
        box-sizing: border-box;
    }

    body{
        padding: 0;
        margin: 0;
    }

    a{
        text-decoration: none;
    }

    .mt-5{
        margin-top: 5rem;
    }

    .our-blog{
        background-color: #f8f9fa;
        padding: 100px 0;
    }

    .container{
        max-width: 960px;
        margin: 0 auto;
    }

    .row{
        display: flex;
        justify-content: center;
        flex-wrap: wrap;
    }

    .text-center{
        text-align: center;
        font-size: 18px;
    }

    .text-center h2{
        font-weight: 500;
        font-size: 1.6em;
    }

    .text-center h2 span{
        font-weight: 800;
    }

    .text-center p{
        max-width: 500px;
        margin: 0 auto;
        color: #6c757d;
        line-height: 1.5;
        font-size: 1em;
    }

    .col{
        width: 33.3333333%;
        overflow: hidden;
        padding: 15px;
    }

    .col .card{
        width: 100%;
        box-shadow: 0px 0px 20px rgba(0,0,0,0.2);
        transition: transform 0.3s ease;
    }

    .col img{
        width: 100%;
        height: auto;
        border: 0;
    }

    .col .card-body{
        padding: 0 15px 15px 15px;
        background-color: #fff;
        border-bottom-left-radius: 15px;
        border-bottom-right-radius: 15px;
    }

    .card-body h5{
        font-size: 24px;
        margin: 7px 0;
    }

    .card:hover{
        transform: translateY(-10px);
        transition: transform 0.3s ease;
    }

    .card p{
        color: #6c757d;
    }

    .card-body .date-author span{
        color: #e74c3c;
    }

    .card-body h5 a{
        color: #222;
    }

    @media(min-width: 577px) and (max-width: 768px){
        .col{
            width: 50%;
        }
    }

    @media(max-width: 576px){
        .col{
            width: 100%;
        }
    }
</style>
<x-layout>
    <div class="container-fluid">
        <div class="row">
            <div class="col-3">
                <x-sideNav :curCategory="$category" />
            </div>
            <div class="col-7">
                <div id="contentDiv">
                    <div id="laodingBx"></div>
                </div>
            </div>
            <div class="col-2">

            </div>
        </div>
    </div>
</x-layout>
<script>
    const category = {!! json_encode($category) !!};
    async function getNews(category, page) {
        const options = {
            method: 'GET',
            headers: {
                'X-RapidAPI-Key': '{{ env("API_KEY") }}',
                'X-RapidAPI-Host': '{{ env("API_HOST") }}',
            }
        };

        try {
            const response = await fetch(`https://free-news.p.rapidapi.com/v1/search?q=${category}&lang=en&page=${page}`, options);

            return await response.json();
        } catch (error) {
            console.log(error);
        }
    }
    async function renderComponent(category, curPage) {
        const centerDiv = document.querySelector("#contentDiv");
        laodingScreen() // Laoding
        const response = await getNews(category, curPage);
        const { articles, status, page, page_size, total_hits, total_pages  } = response;
        centerDiv.innerHTML = contentComponent(articles);
    }
    window.addEventListener("load", () => {
        renderComponent(category, 1);
    });

    const laodingScreen = () => {
        const div = document.querySelector('#laodingBx');

        div.innerHTML = `
                        <div class="text-center">
                            <div class="spinner-border" style="width: 3rem; height: 3rem;" role="status">
                                <span class="visually-hidden">Loading...</span>
                            </div>
                        </div>
                        `;
    };

    const contentComponent = (articles) => {
        const divStart = ` <section class="our-blog">
                                <div class="container">
                                    <div class="row mt-5">`;

        const divEnd = `        </div>
                            </div>
                        </section>`;
        let template = '';
        template += divStart;
        articles.forEach(article => {
            const { author, clean_url, country, language, link, media, published_date, rights, summary, title } = article;
            
            let div = `
                    <div class="col-xxl-6 col col-sm-12 col-12">
                        <div class="card">
                            <img src="${(media !== null)? media : '{{ asset("images/default1.png") }}'}" alt="">
                            <div class="card-body">
                                <h5 class="card-title">
                                    <a href="${link}">${title}</a>
                                </h5>
                                <p class="date-author">
                                    ${published_date} <span class="author">By ${author}</span>
                                </p>
                                <p class="card-text">
                                    ${summary}
                                </p>
                            </div>
                        </div>
                    </div>
                    `;
            template += div;
        });

        template += divEnd;
        return template;
    };
</script>