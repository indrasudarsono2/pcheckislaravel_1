$(document).ready(function () {
   $('#1').click(function () {
    var varian = $('#1').val();
    $.ajax({
      type: "get",
      data: {
        'varian': varian
      },
      url: 'varian/{varians}',
      success: function (data) {
        $('#container').html(data);
        $('.loader').hide();
      }
    });
  });
  $('#2').click(function () {
    var varian = $('#2').val();
    $.ajax({
      type: "get",
      data: {
        'varian': varian
      },
      url: 'varian/{varians}',
      success: function (data) {
        $('#container').html(data);
        $('.loader').hide();
      }
    });
  });
});