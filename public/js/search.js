
    const userInput = passData.input // Pass php variable to js
    async function getSearchedNews() {
        const options = {
            method: 'GET',
            headers: {
                'X-RapidAPI-Key': passData.apiKey,
                'X-RapidAPI-Host': passData.apiHost,
            }
        };
        try {
            let res = await fetch(`https://free-news.p.rapidapi.com/v1/search?q=${passData.input}&lang=en`, options);
            return await res.json();
            
        } catch (error) {
            console.log(error);
        }
    }

    async function renderUsers() {
        let results = await getSearchedNews();
        let html = '';
        const element = document.querySelector('#result');
        if (results.status === 'ok') {

            results.articles.forEach(article => {
                const { title, summary, author, clean_url, country, link, media, published_date, language } = article;
            let renders = `
                            <div class="card mb-3" style="max-width: 540px;">
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
                            </div>
                                `;
                    html += renders;
            });
            element.innerHTML = html;
        } else {
            window.location.href = "/404";
        }
    }
    renderUsers();