
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
    const categoryComponent = (curTab) => {
        const sideNav = document.querySelector("#sideNav");
    }

    const mainDiv = () => {
        const contentDiv = document.querySelector('#mainDiv');
        contentDiv.innerHTML = `
                                <div class="text-center">
                                    <div class="spinner-border" style="width: 3rem; height: 3rem;" role="status">
                                        <span class="visually-hidden">Loading...</span>
                                    </div>
                                </div>
                                `;

        const getData = {
            category: 'general',
            lang: 'en',
            
        }
    }

    const pagination = () => {
        const paginator = document.querySelector("#pagination")
    }

    const rightNav = () => {
        const rightNavBar = document.querySelector('#rightNav');
    }

    window.addEventListener("load", () => {
        // Trigger once the page load
        mainDiv();
    });
</script>
<script src="{{ asset('js/main.js') }}"></script>