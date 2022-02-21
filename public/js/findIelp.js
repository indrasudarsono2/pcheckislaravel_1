$(document).ready(function () {
  $('#keyword').on('keyup', function () {
    $('.loader_findFiles').show();
    console.log("coba");
    getIelp();
  });
});

function getIelp() {
  var keyword = $('#keyword').val();
    console.log(keyword);
  $.ajax({
    type: "get",
    data: {
      'keyword': keyword
    },
    url: 'searching_ielp/{keyword}',
    success: function (data) {
      $('#container').html(data);
      $('.loader_findFiles').hide();
    }
  })
}