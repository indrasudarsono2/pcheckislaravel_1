$(document).ready(function () {
  $('#keyword').on('keyup', function () {
    $('.loader').show();
    getAcpQuestions();
  });
});

function getAcpQuestions() {
  var keyword = $('#keyword').val();
  $.ajax({
    type: "get",
    data: {
      'keyword': keyword
    },
    url: 'searching_acp/{keyword}',
    success: function (data) {
      $('#container').html(data);
      $('.loader').hide();
    }
  });
}