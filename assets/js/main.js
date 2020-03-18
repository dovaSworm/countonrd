// $(document).ready(function() {
//     console.log("obj")
//     $('#create-inv-btn').click(function() {
//         console.log("obj");
//         $.ajax({
//             url: "<?php echo base_url();?>invoices/get_invoices",
//             dataType: 'text',
//             type: "POST",
//             success: function(result) {
//                 var obj = $.parseJSON(result);
//                 console.log(obj);
//                 // $.each(result.results,function(item){
//                 //     $('ul').append('<li>' + item + '</li>')
//                 // })
//             }
//         })
//         $('#div_list').toggle(900)
//     });
// });