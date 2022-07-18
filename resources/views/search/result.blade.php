
<x-layout>
    <div class="card mb-3" style="max-width: 540px;" id="result">
        <div class="text-center">
            <div class="spinner-border" style="width: 3rem; height: 3rem;" role="status">
                <span class="visually-hidden">Loading...</span>
            </div>
        </div>
    </div>
</x-layout>
<script>
    const userInput = {!! json_encode($searchData) !!} // Pass php varibe to js
    async function getSearchedNews() {
        const options = {
            method: 'GET',
            headers: {
                'X-RapidAPI-Key': '{{ env("API_KEY") }}',
                'X-RapidAPI-Host': '{{ env("API_HOST") }}',
            }
        };
        try {
            let res = await fetch(`https://free-news.p.rapidapi.com/v1/search?q=${userInput}&lang=en`, options);
            return await res.json();
            
        } catch (error) {
            console.log(error);
        }
    }

    async function renderUsers() {
        let results = await getSearchedNews();
        let html = '';
        
        results.articles.forEach(article => {
            const { title, summary, author, clean_url, country, link, media, published_date, language } = article;
            let renders = `
                            <div class="row g-0">
                                <div class="col-md-4">
                                    <img src="${media}" class="img-fluid rounded-start" alt="...">
                                </div>
                                <div class="col-md-8">
                                    <div class="card-body">
                                        <h5 class="card-title">${title}</h5>
                                        <p class="card-text">
                                            ${summary.substring(0, 100)}
                                        </p>
                                        <p class="card-text">
                                            <small class="text-muted">${published_date}</small>
                                        </p>
                                    </div>
                                </div>
                            </div>
                        `;
            html += renders;
        });
        const element = document.querySelector('#result');
        element.innerHTML = html;
    }
    renderUsers();
</script>