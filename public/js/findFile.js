// $(document).ready(function () {
//   $('#keyword').on('keyup', function () {
//     $value = $(this).val();
//     $.ajax({
//       url: "{{ route('searching_files') }}",
//       type: "get",
//       data: { 'keyword': $value },
//       success: function (data) {
//         $('#container').html(data);
//       }
//     })
//   });
// });

// $(document).ready(function () {
//   $('#keyword').on('keyup', function () {
//     var str = $('#keyword').val();
//     if (str == "") {
//       $("#container").html("<b> search again..</b>");
//     } else {
//       $.get("{{ url('/searching_files?keyword=') }}" + str, function (data) {
//         $("#container").html(data);
//       })
//     }
//   });
// });

// $(document).ready(function (){

//   function searching_files(query='')
//   {
//     $.ajax({
//       url : "{{ route('searching_files') }}",
//       method : 'GET',
//       data : {'query':$query},
//       dataType: 'json'

//       success:function(data){
//        ('#container').html(data); 
//       }
//     })
//   }
// })

$(document).ready(function () {
  $('#keyword').on('keyup', function () {
    $('.loader_findFiles').show();
    getFiles();
  });
});

function getFiles() {
  var keyword = $('#keyword').val();
  $.ajax({
    type: "get",
    data: {
      'keyword': keyword
    },
    url: 'searching_files/{keyword}',
    success: function (data) {
      $('#container').html(data);
      $('.loader_findFiles').hide();
    }
  })
}