$(document).ready(function () {
  $('#keyword').on('keyup', function () {
    $('.loader_findFiles').show();
    console.log("coba");
    getMedex();
  });
});

function getMedex() {
  var keyword = $('#keyword').val();
    console.log(keyword);
  $.ajax({
    type: "get",
    data: {
      'keyword': keyword
    },
    url: 'searching_medex/{keyword}',
    success: function (data) {
      $('#container').html(data);
      $('.loader_findFiles').hide();
    }
  })
}