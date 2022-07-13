
<x-layout>
    <div class="card-template">
        <div class="card mb-3 m-5">
            <br>
            <br>
            <br>
            <br>
            <br>
            <div class="text-center">
                <div class="spinner-grow text-secondary" style="width: 3rem; height: 3rem;" role="status">
                    <span class="visually-hidden">Loading...</span>
                </div>
            </div>
            <br>
            <br>
            <br>
            <br>
            <br>
            <div class="card-body">
                <h5 class="card-title placeholder-glow">
                    <span class="placeholder col-6"></span>
                </h5>
                <br>
                <p class="card-text placeholder-glow">
                    <span class="placeholder col-7"></span>
                    <span class="placeholder col-4"></span>
                    <span class="placeholder col-4"></span>
                    <span class="placeholder col-6"></span>
                    <span class="placeholder col-8"></span>
                    <span class="placeholder col-11"></span>
                    <span class="placeholder col-10"></span>
                    <span class="placeholder col-9"></span>
                    <span class="placeholder col-8"></span>
                    <span class="placeholder col-12"></span>
                    <span class="placeholder col-7"></span>
                    <span class="placeholder col-4"></span>
                    <span class="placeholder col-10"></span>
                    <span class="placeholder col-9"></span>
                    <span class="placeholder col-12"></span>
                </p>
            </div>
        </div>
    </div>
</x-layout>
<script>
    var link = {!! json_encode($link) !!};
    async function getEndPoint() {
        const options = {
            method: 'GET',
            headers: {
                'X-RapidAPI-Key': '{{ env("EXTRACT_NEWS") }}',
                'X-RapidAPI-Host': '{{ env("EXTRACT_NEWS_HOST") }}'
            }
        };
        try {
            let res = await fetch(`https://extract-news.p.rapidapi.com/v0/article?url=${link}`, options);
            return await res.json();
            
        } catch (error) {
            console.log(error);
        }
    } 

    async function renderArticle() {
        let article = await getEndPoint();
        let html = '';
        
        if (article.status === "ok") {
            let template = `
                            <div class="card mb-3 m-5">
                                <img src="${article.article.top_image}" class="card-img-top" alt="...">
                                <div class="card-body">
                                    <h5 class="card-title">
                                        <strong>
                                            ${article.article.title}
                                        </strong>
                                    </h5>
                                    <br>
                                    <div class="container-fluid">
                                        <div class="row">
                                            <div class="col-9">
                                                visit <a href=${link} >${link.substring(0, 50)}</a>...  to read more
                                            </div>
                                            <div class="col-3 text-end">
                                                <a href="/bookmark/{${article}}">    
                                                    <i class="fas fa-regular fa-bookmark"></i>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                    <p class="card-text">
                                        ${article.article.text}
                                    </p>
                                    <p class="card-text justify-content-center">
                                        <small class="text-muted">
                                            Source 
                                            <a href=${article.article.source_url}>${article.article.source_url}</a>
                                        </small>
                                        <br>
                                        <small class="text-muted">Published ${article.article.published}</small>
                                    </p>
                                </div>
                            </div>
                        `
                html += template;
                const container = document.querySelector('.card-template');
                container.innerHTML = html;
        } else {
            window.location.href = "/404";
        }
    }
    renderArticle();
</script>