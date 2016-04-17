function addToChat(data)
{
    $('#chat-messages-display').append('<span class="chat-sender">' + data.user.username + '</span>' + data.message.message + '<br/>');
}

function reloadChat()
{

}


webroot = document.location.href;

// Send message
$('#chat-send').submit(function(e){
    e.preventDefault();

    var input_message = $('input[name=message]', this);

    var msg_data = {
        'message': input_message.val(),
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
        addToChat(data);
        input_message.val("");
      },
    });
});