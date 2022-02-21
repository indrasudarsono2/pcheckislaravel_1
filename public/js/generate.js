$(document).ready(function () {
  $('#generate').click(function () {
    var rand = function () {
      return Math.random().toString(36).substr(2);
    };
    var token = function () {
      return rand() // to make it longer
    };
    $('#token').val(token);
  })
});