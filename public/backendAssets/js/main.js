//sort-tender with ajax
// window.getTenderByLocation = function (e, url) {
//     var location_name = $(e).html();  // Get the selected district name
//     $('.sort_btn span').html(location_name);  // Change button text dynamically

//     $.ajax({
//         type: "get",
//         url: url,
//         success: function (response) {
//             // Check if 'status' exists in the response and show 'nothing found' message
//             if (response.status === 'nothing found') {
//                 $('.tender_result').html('<span class="text-black fw-bold text-center wow fadeInUp">Nothing Found</span>');
//             } else {
//                 // Replace the tender list with the updated content from the view
//                 $('.tender_result').html(response);
//             }
//         },
//         error: function (xhr, status, error) {
//             console.log(error);
//         }
//     });
// };


//search-tender with ajax
// $(document).ready(function () {
//     $("#tender_search").on('keyup', function (e) {
//         e.preventDefault();
//         let search_string = $('#tender_search').val();
//         var url = $(this).data('url');

//         $.ajax({
//             url: url,
//             method: "GET",
//             data: {
//                 search_string: search_string
//             },
//             success: function (res) {
//                 $('.tender_result').html(res);
//                 if (res.status === 'nothing found') {
//                     $('.tender_result').html('<span class="text-black fw-bold text-center wow fadeInUp">Nothing Found</span>');
//                 }
//             },
//             error: function () {
//                 $('.tender_result').html('<span class="text-danger">Error occurred while searching.</span>');
//             }
//         });
//     });
// });
