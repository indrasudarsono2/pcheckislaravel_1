$(document).ready(function () {
  $('#keyword').on('keyup', function () {
    $('.loader_findFiles').show();
    getFile();
  });
});

function getFile() {
  var keyword = $('#keyword').val();

  $.ajax({
    type: "get",
    data: {
      'keyword': keyword
    },
    url: 'aplication_files/searching_file/{keyword}',
    success: function (data) {
      $('#container').html(data);
      $('.loader_findFiles').hide();
    }
  })
}