function addToChat(data)
{
    $('#chat-display-message').append('<span class="chat-sender">' + data.user.username + '</span>' + data.message.message + '<br/>');
    //console.log(data);
}

webroot = document.location.href;

// Send message
$('#chat-send').submit(function(e){
    e.preventDefault();

    var msg_data = {
        'message': $('input[name=message]', this).val(),
        'chat_id': $('input[name=chat_id]', this).val(),
    };

    $.ajax({
      type: "POST",
      url: webroot + 'chat/addMessage',
      data: msg_data,
      dataType: 'json',
      success: function(data){
        data.message = msg_data;
        console.log(data);
        addToChat(msg_data)
      },
    });
});