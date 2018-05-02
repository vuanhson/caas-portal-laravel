$(function() {});
//     $('#login-form').submit(function(e) {
//         e.preventDefault();
//         var data = {};
//         $(this).find('input').each(function() {
//             data[this.name] = $(this).val();
//         });
//         var url = $(this).attr('action');
//         var json = 
//         var jsonResponse = request(json, url);
//         //console.log(jsonResponse);
//     })
// })


// function request(jsonData, url) {
//     var result = {};
//     $.ajax({
//        type: "POST",
//        url: url,
//        contentType: "application/json",
//        dataType: "json",
//        headers: {
//                 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
//         },
//        data: 'abc',
//        success: function (response) {
//            console.log(response);
//        },
//    });
//     return null;
// }