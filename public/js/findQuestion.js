$(document).ready(function () {
  $('#keyword').on('keyup', function () {
    $('.loader').show();
    getQuestions();
  });
});

function getQuestions() {
  var keyword = $('#keyword').val();
  $.ajax({
    type: "get",
    data: {
      'keyword': keyword
    },
    url: 'mc_questions/searching_question/{keyword}',
    success: function (data) {
      $('#container').html(data);
      $('.loader').hide();
    }
  });
}