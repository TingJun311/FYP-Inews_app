// Dropdown Menu Fade
// jQuery(document).ready(function () {
//     $(".dropdown").hover(
//         function () {
//             $(".dropdown-menu", this).fadeIn("fast");
//         },
//         function () {
//             $(".dropdown-menu", this).fadeOut("fast");
//         }
//     );
// });

function searchNews() {
    const searchValue = document.querySelector("#searchBox").value
    if (searchValue) {
        var data = {
            value: searchValue,
            _token: $('meta[name="_token"]').attr('content')
        };
        $.ajax({
            type: 'POST',
            url: '/search/news',
            dataType: 'json',           
            data: data,
            success: function(data) {
                console.log(data);
            },
            error: function() {
                console.log("Error");
            }
        });
    } else {
        alert("Empty")
    }
}
