
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
                                            <div class="col-3 text-end" id="bookmarkBx">
                                                @auth
                                                    <button onClick={bookmark()}>    
                                                        <i class="fas fa-regular fa-bookmark"></i>
                                                    </button>
                                                @else
                                                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
                                                        <i class="fas fa-regular fa-bookmark"></i>
                                                    </button>
                                                    <!-- Modal -->
                                                    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                        <div class="modal-dialog modal-dialog-centered" role="document">
                                                            <div class="modal-content rounded-6 shadow">
                                                                <div class="modal-header border-bottom-0">
                                                                    <h5 class="modal-title">Modal title</h5>
                                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                                </div>
                                                                <div class="modal-body py-0">
                                                                    <p>This is a modal sheet, a variation of the modal that docs itself to the bottom of the viewport like the newer share sheets in iOS.</p>
                                                                </div>
                                                                <div class="modal-footer flex-column border-top-0">
                                                                    <button type="button" class="btn btn-lg btn-primary w-100 mx-0 mb-2">Save changes</button>
                                                                    <button type="button" class="btn btn-lg btn-light w-100 mx-0" data-bs-dismiss="modal">Close</button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                @endauth
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

    async function bookmark() {
        const bookmarkBx = document.querySelector('#bookmarkBx');
        bookmarkBx.innerHTML = `
                                <div class="spinner-border spinner-border-sm" role="status">
                                    <span class="visually-hidden">Loading...</span>
                                </div>
                            `
        let articles = await getEndPoint();

        if (articles.status === "ok") {

            // Destructuring Nested Objects and array
            const { article: { source_url, published, title, text, authors, top_image } } = articles;
            const [author, ...rest] = authors;

            var data = {
                source_url: source_url,
                published: published,
                title: title,
                text: text,
                url: link,
                author: author,
                image: top_image,
                _token: '{{csrf_token()}}'
            };
            $.ajax({
                type: 'POST',
                url: '/bookmark/article',
                dataType: 'json',           
                data: data,
                success: function(data) {
                    bookmarkBx.innerHTML = `
                                            <i class="fas fa-solid fa-check"></i>
                                        `
                },
                error: function() {
                    console.log("Error");
                }
            });
        }
    }

    // For triggering toast component when unauth user click bookmark button
    // function toastTrigger() {
    //     const toast = document.querySelector('#liveToast');

    //     var toastLive = new bootstrap.Toast(toast)
    //     toastLive.show()
    // }
</script>