webroot = 'http://' + document.location.host;

function addToChat(data)
{
    if (data.date && data.date !== 'undefined')
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
    var chat_id = $('#chat-container').attr('chatid');
    $.ajax({
        url: webroot + '/getMessages/' + chat_id,
        dataType: 'json',
        success: function(data){
            $('#chat-messages-display').html('');
            $.each(data.chatMessages, function(key, value){
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
    setInterval(reloadChat, 500);

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
          url: webroot + '/chat/addMessage',
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
