
    const paginationReq = (curPage) => {
        const paginationGrid = document.querySelector('#pagination');
        const container = document.querySelector('.card-template')
        container.innerHTML = `
                            <div class="card mb-3" style="max-width: 540px;">
                                <div class="row g-0">
                                    <div class="col-md-4">
                                        <div class="spinner-grow text-secondary" style="width: 3rem; height: 3rem;" role="status">
                                            <span class="visually-hidden">Loading...</span>
                                        </div>
                                    </div>
                                    <div class="col-md-8">
                                        <div class="card-body placeholder-glow">
                                            <h5 class="card-title">
                                                <span class="placeholder col-10"></span>
                                            </h5>
                                            <p class="card-text">
                                                <span class="placeholder col-7"></span>
                                                <span class="placeholder col-4"></span>
                                                <span class="placeholder col-4"></span>
                                                <span class="placeholder col-6"></span>
                                                <span class="placeholder col-8"></span>
                                            </p>
                                            <p class="card-text">
                                                <small class="text-muted">
                                                    <span class="placeholder col-7"></span>
                                                </small>
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            `;

            paginationGrid.innerHTML = `
                                        <div class="text-center">
                                            <div class="spinner-border spinner-border-sm" role="status">
                                                <span class="visually-hidden">Loading...</span>
                                            </div>
                                        </div>
                                    `;
        var data = {
            currentPage: curPage,
            _token: $('meta[name="_token"]').attr('content')
        }
        $.ajax({
            type: 'POST',
            url: '/page/getPages',
            dataType: 'json',           
            data: data,
            success: function(data) {
                const { status, total_hits, total_pages, page, page_size, articles } = JSON.parse(data);
                paginationComponent(page, total_pages);
                newsComponent(articles);
            },
            error: function() {
                console.log("Error");
            }
        });
    }

    const paginationComponent = (page, total_pages) => {
        const paginationGrid = document.querySelector('#pagination');
        const activePage = document.querySelector('#activePage');
        let templatePagination = ``;
        const paginateButton = {
            previous: null,
            next: null
        };
        paginateButton.previous = (page <= 1)? 'disabled' : null;
        paginateButton.next = (page == total_pages)? 'disabled' : null;
        let pagination = `
                        <nav>
                            <ul class="pagination justify-content-center">
                                <li class="page-item ${ paginateButton.previous }">
                                    <a class="page-link" href="#" onClick={paginationReq(${page - 1})}>Previous</a>
                                </li>
                                <li class="page-item active">
                                    <a class="page-link" href="#" id="activePage">${page}</a>
                                </li>
                                <li class="page-item ${ paginateButton.next }" >
                                    <a class="page-link" href="#" onClick={paginationReq(${page + 1})}>Next</a>
                                </li>
                            </ul>
                        </nav>
                        `;
        templatePagination += pagination;
        paginationGrid.innerHTML = templatePagination;
    };

    window.addEventListener("load", () => {
        paginationReq(1);
    });