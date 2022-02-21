$(document).ready(function () {
  $('#btn_provision').click(function () {
    $('#btn_provision').hide();

    let provision_input = $('#provision_input').val();
    $.ajax({
      type: "get",
      data: {
        'token': provision_input
      },
      url: '/provisionss_token/{token}',
      success: function (data) {
        $('#container').html(data);
      }
    });
  });
});