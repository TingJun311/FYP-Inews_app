
<x-layout>
        <div class="text-center" id="result">
            <div class="spinner-border" style="width: 3rem; height: 3rem;" role="status">
                <span class="visually-hidden">Loading...</span>
            </div>
        </div>
</x-layout>
<script>
    // For passingdata to external JS file
    const passData = {
        input: {!! json_encode($searchData) !!},
        apiKey: '{{ env("API_KEY") }}',
        apiHost: '{{ env("API_HOST") }}'
    }; // Pass php varibe to js
</script>
<script src="{{ asset('js/search.js') }}"></script>