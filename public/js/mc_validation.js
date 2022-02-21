$(document).ready(function () {
  $('#finish').click(function(){
     validateForm();

    function validateForm() {
      var radio = $('.radio'), formValid = true;
      console.log(radio.length);
      for( var j=0; j<radio.length; j++ ) {
        if( isNnChecked(radio[j], "radio") ) {
          formValid = false;
        }
        
      }
      if(formValid){
        var conf = confirm("Are you sure want to submit it???");
       
        if(conf==true){
          $('#finish').hide();
        }else{
          $('#finish').show();
          return false;
        }
      }else{
        alert("Submission Failed!");
      }
      return formValid;
    }
    
    function isNnChecked(sel) {
      // All <input> tags...
      var chx = sel.getElementsByTagName('input');
      for (var i=0; i<chx.length; i++) {
        // If you have more than one radio group, also check the name attribute
        // for the one you want as in && chx[i].name == 'choose'
        // Return true from the function on first match of a checked item
        if (chx[i].type == 'radio' && chx[i].value == 'NN' && chx[i].checked) {
          return true;
        } 
      }
      // End of the loop, return false
      return false;
    }

    
    // $('.radio').each(function () {
    //   if ($(this).find('input:radio[value=NN]').is(':checked')) {
    //     const number = [$(this).find('span').text()];
        
    //     confirm('You missed question number ' + number);
    //   }
    // }); 
    // $('.radio').each(function () {
    //   if ($(this).find('input:radio').is(':checked')) {
    //       alert('This works ' + $(this).find('span').text());
    //   } else {
    //       alert('You missed question number ' + $(this).find('span').text());
    //   }
    // }); 
  })
});