webroot = document.location.href;

function addToChat(data)
{
console.log('addtochat');
    if (data.date !== 'undefined')
    {
        date = Date.parse(data.date.date);
        date = new Date(date);
    }
    else
        date = new Date((new Date).getTime());
    dateOption = {hour: 'numeric', minute: 'numeric'}
    $('#chat-messages-display').append('<span class="chat-sender">[' + date.toLocaleString("fr-FR", dateOption) + '] ' + data.user.username + '</span>: ' + data.content + '<br/>');
}

function reloadChat()
{
    $.ajax({
        url: webroot + 'chat/getMessages/',
        dataType: 'json',
        success: function(data){
            $('#chat-messages-display').html('');
            if (data.messages === 'undefined')
                data.messages = date.getMessages;
            $.each(data.messages, function(key, value){
                addToChat(value);
            });
        },
        error: function(){
            console.log('Can\'t reload chat.');
        }
    });
    scrollToBot();
}

function scrollToBot()
{
    $('#chat-messages-display').scrollTop(1000000000);
}

$(document).ready(function(){
    scrollToBot();
    setInterval(reloadChat, 1000);

    // Send message
    $('#chat-send').submit(function(e){
        e.preventDefault();

        var input_message = $('input[name=content]', this);

        var msg_data = {
            'content': input_message.val(),
            'chat_id': $('input[name=chat_id]', this).val(),
        };

        input_message.val("");

        $.ajax({
          type: "POST",
          url: webroot + 'chat/addMessage',
          data: msg_data,
          dataType: 'json',
          success: function(data){
            msg_data.user = data.user;
            addToChat(msg_data);
            scrollToBot();
          },
        });
    });
});
