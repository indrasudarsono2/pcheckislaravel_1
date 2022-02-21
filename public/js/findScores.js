$(document).ready(function () {
  $('#keyword').on('keyup', function () {
    $('.loader_findFiles').show();
    getUsers();
  });
});

function getUsers() {
  var keyword = $('#keyword').val();

  $.ajax({
    type: "get",
    data: {
      'keyword': keyword
    },
    url: '/searching_scores/{keyword}',
    success: function (data) {
      $('#container').html(data);
      $('.loader_findFiles').hide();
    }
  })
}