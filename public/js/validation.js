$(document).ready(function () {
  $('#essay_form').validate({
    errorClass: "is-invalid",
    // options, etc.
  });

  $('textarea[id^="answer_id"]').each(function () {
    $(this).rules('add', {
        required: true,
        // another rule, etc.
    });
  }); 
});