webroot = document.location.href;

function addToChat(data)
{
    $('#chat-messages-display').append('<span class="chat-sender">' + data.user.username + '</span>: ' + data.content + '<br/>');
}

function reloadChat()
{
    $.ajax({
        url: webroot + 'chat/getMessages/',
        dataType: 'json',
        success: function(data){
            $('#chat-messages-display').html('');
            $.each(data.messages, function(key, value){
                addToChat(value);
                scrollToBot();
            });
        }
    });
    console.log('Chat Reload');
}

function scrollToBot()
{
    var div = $('#chat-messages-display');
    div.scrollTop = div.scrollHeight;
}

// Send message
$('#chat-send').submit(function(e){
    e.preventDefault();

    var input_message = $('input[name=content]', this);

    var msg_data = {
        'content': input_message.val(),
        'chat_id': $('input[name=chat_id]', this).val(),
    };

    $.ajax({
      type: "POST",
      url: webroot + 'chat/addMessage',
      data: msg_data,
      dataType: 'json',
      success: function(data){
        msg_data.user = data.user;
        addToChat(msg_data);
        input_message.val("");
        scrollToBot();
      },
    });
});

scrollToBot();
setInterval(reloadChat, 2000)