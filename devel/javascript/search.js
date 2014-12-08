$(document).ready(function(){

  $('#results').html('<p>Enter a search term to start filtering.</p>');

  $('#searchData').keyup(function() {
     
    var searchVal = $(this).val();
    if(searchVal !== '') {
      
      $.get('./search.php?searchData='+searchVal, function(returnData) {
        if (!returnData) {
          $('#results').html('<p style="padding:5px;">Search term entered does not return any data.</p>');
        } else {
          $('#results').html(returnData);
        }
      });
    } else {
      $('#results').html('<p>Enter a search term to start filtering.</p>');
    }

  });

});