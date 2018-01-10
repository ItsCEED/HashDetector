$('#myForm').submit(function(e){
  e.preventDefault();
  var tags = $('#tags').val();
  if(tags ==''){
    alert('the text box can\'t be empty');
    return false;
  }
  else{
    startProcessing(tags);
  }
});

$('#copy').click(function(){
  $('#tagsArea').select();
  //copy content to clipboard
  document.execCommand('copy');
});

$('#reset').click(function(){
  //go back to home 
  document.location.href = '';
});

function startProcessing(tags){
  $('#myForm').hide();
  $('#processing').show();
  $.ajax({
        type: "POST",
        url: 'process',
        data: {tags: tags},
        success: function (data) {
            $('#processing').hide();
            $('#tagsResults').show();
            $("#tagsArea").html(data);
        },
        error: function (xhr, ajaxOptions, thrownError) {
        }
    });
}