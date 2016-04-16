function success(data)
{
    console.log(data);
}

webroot = document.location.href;

var data = {
    'message': 'Mon 1er message',
    'chat_id': 0,
}
/*
$.ajax({
  type: "POST",
  url: webroot + 'chat/addMessage',
  data: data,
  success: success,
  dataType: 'json'
});
*/
// Send message
$('#chat-send').submit(function(e){
    e.preventDefault();

    var data = {
        'message': $('input[name=message]', this).val(),
        'chat_id': $('input[name=chat_id]', this).val(),
    };

    $.ajax({
      type: "POST",
      url: webroot + 'chat/addMessage',
      data: data,
      dataType: 'json',
      success: function(data){
        console.log(data);
      },
    });
});