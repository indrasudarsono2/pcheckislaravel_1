$(document).ready(function () {
  $('#address').keyup(function () {
    var len = this.value.length;
    if (len >= 49) {
      this.value = this.value.substring(0, 50);
    }
    $('#count').text(50 - len);
  });



  $('#address_user').keyup(function () {
    var len = this.value.length;
    if (len >= 49) {
      this.value = this.value.substring(0, 50);
    }
    $('#count_user').text(50 - len);
  });



  $('#rating_confirm').hide();
  $('#input_lainnya').hide();

  $('#rc_yes_rd').click(function () {
    $('#rating_confirm').show();
  });

  $('#rc_no_rd').click(function () {
    $('#rating_confirm').hide();
  });

  $('#dicabut').click(function () {
    $('#input_lainnya').hide();
  });

  $('#dibekukan').click(function () {
    $('#input_lainnya').hide();
  });

  $('#lainnya').click(function () {
    $('#input_lainnya').show();
  });



  $('#medex_confirm').hide();

  $('#md_yes_rd').click(function () {
    $('#medex_confirm').show();
  });

  $('#md_no_rd').click(function () {
    $('#medex_confirm').hide();
  });



  $('#ielp_confirm').hide();

  $('#ielp_yes_rd').click(function () {
    $('#ielp_confirm').show();
  });

  $('#ielp_no_rd').click(function () {
    $('#ielp_confirm').hide();
  });



  $('#date_of_birth').change(function () {
    var birth_date = $('#date_of_birth').val();
    var today = new Date();
    var birthday = new Date(birth_date);
    var year = 0;
    if (today.getMonth() < birthday.getMonth()) {
      year = 1;
    }
    else if ((today.getMonth() == birthday.getMonth()) && today.getDate() < birthday.getDate()) {
      year = 1;
    }
    var age = (today.getFullYear() - birthday.getFullYear() - year) + "tahun";
    $('#age').val(age);
  });



  $('#medex_date').change(function () {
    $('#medexInput').show();
    var age = $('#age').val();
    var medex_released = new Date($('#medex_date').val());
    var dob = new Date($('#date_of_birth').val());
    var year = 0;
    if (medex_released.getMonth() < dob.getMonth()) {
      year = 1;
    }
    else if ((medex_released.getMonth() == dob.getMonth()) && medex_released.getDate() < dob.getDate()) {
      year = 1;
    }
    var diff = medex_released.getFullYear() - dob.getFullYear() - year;
    
    if (diff <= 50) {
      
      var h = new Date(medex_released.getFullYear() + 2, medex_released.getMonth(), medex_released.getDate());
      var year_medex = h.getFullYear();
      var month_medex = h.getMonth() + 1;
      var day_medex = h.getDate();

      var medex_expired = day_medex + "-" + month_medex + "-" + year_medex;
      $('#expiredMedex').val(medex_expired);
    }
    // else if (diff <= 50) {
      
    //   var h = new Date(medex_released.getFullYear() + 2, medex_released.getMonth(), medex_released.getDate());
    //   var year_medex = h.getFullYear();
    //   var month_medex = h.getMonth() + 1;
    //   var day_medex = h.getDate();

    //   var medex_expired = day_medex + "-" + month_medex + "-" + year_medex;
    //   $('#expiredMedex').val(medex_expired);
    // }
    else {
      var h = new Date(medex_released.getFullYear() + 1, medex_released.getMonth(), medex_released.getDate());
      var year_medex = h.getFullYear();
      var month_medex = h.getMonth() + 1;
      var day_medex = h.getDate();

      var medex_expired = day_medex + "-" + month_medex + "-" + year_medex;
      $('#expiredMedex').val(medex_expired);
    }
  });


  $('#level').change(function () {
    var level = $('#level').val();
    var date = $('#ielp_date').val();
    var d = new Date(date);
    if (level == 4) {
      var e = new Date(d.getFullYear() + 3, d.getMonth(), d.getDate());
      var year = e.getFullYear();
      var month = d.getMonth() + 1;
      var day = d.getDate();
      var expired = day + "-" + month + "-" + year;
      $('#expiredIelp').val(expired);
    }
    else if (level == 5) {
      var e = new Date(d.getFullYear() + 6, d.getMonth(), d.getDate());
      var year = e.getFullYear();
      var month = d.getMonth() + 1;
      var day = d.getDate();
      var expired = day + "-" + month + "-" + year;
      $('#expiredIelp').val(expired);
    }
    else if (level == 6) {
      var e = new Date(d.getFullYear() + 99, d.getMonth(), d.getDate());
      var year = e.getFullYear();
      var month = d.getMonth() + 1;
      var day = d.getDate();
      var expired = day + "-" + month + "-" + year;
      $('#expiredIelp').val(expired);
    }
    else {
      $('#expiredIelp').val(0);
    }
  });

  $('#ielp_date').change(function () {
    var level = $('#level').val();
    var date = $('#ielp_date').val();
    var d = new Date(date);
    if (level == 4) {
      var e = new Date(d.getFullYear() + 3, d.getMonth(), d.getDate());
      var year = e.getFullYear();
      var month = d.getMonth() + 1;
      var day = d.getDate();
      var expired = day + "-" + month + "-" + year;
      $('#expiredIelp').val(expired);
    }
    else if (level == 5) {
      var e = new Date(d.getFullYear() + 6, d.getMonth(), d.getDate());
      var year = e.getFullYear();
      var month = d.getMonth() + 1;
      var day = d.getDate();
      var expired = day + "-" + month + "-" + year;
      $('#expiredIelp').val(expired);
    }
    else if (level == 6) {
      var e = new Date(d.getFullYear() + 99, d.getMonth(), d.getDate());
      var year = e.getFullYear();
      var month = d.getMonth() + 1;
      var day = d.getDate();
      var expired = day + "-" + month + "-" + year;
      $('#expiredIelp').val(expired);
    }
    else {
      $('#expiredIelp').val(0);
    }
  });



  $('#control_confirm').hide();

  $('#control_yes_rd').click(function () {
    $('#control_confirm').show();
  });

  $('#control_no_rd').click(function () {
    $('#control_confirm').hide();
  });

  $('#create').click(function () {
    $('#create').hide();
  })




  $('#ojti_id').on('keyup', function () {
    var ojti_id = $('#ojti_id').val();
    $('#ojti_name').show();
    if (ojti_id == "") {
      $('#ojti_name').html(ojti_id);
    }
    else {
      $.ajax({
        type: "get",
        data: {
          'ojti_id': ojti_id
        },
        url: '/aplication_files/searching/' + ojti_id,
        success: function (data) {
          $('#ojti_name').html(data);
        }
      });
    }
  });


});

