webroot = 'http://' + document.location.host;

String.prototype.removeAccent = function(){
    var accent = [
        /[\300-\306]/g, /[\340-\346]/g, // A, a
        /[\310-\313]/g, /[\350-\353]/g, // E, e
        /[\314-\317]/g, /[\354-\357]/g, // I, i
        /[\322-\330]/g, /[\362-\370]/g, // O, o
        /[\331-\334]/g, /[\371-\374]/g, // U, u
        /[\321]/g, /[\361]/g, // N, n
        /[\307]/g, /[\347]/g, // C, c
    ];
    var noaccent = ['A','a','E','e','I','i','O','o','U','u','N','n','C','c'];

    var str = this;
    for(var i = 0; i < accent.length; i++){
        str = str.replace(accent[i], noaccent[i]);
    }

    return str;
}

function htmlEntities(str) {
    return String(str).replace(/&/g, '&amp;').replace(/</g, '&lt;').replace(/>/g, '&gt;').replace(/"/g, '&quot;');
}

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
    $('#chat-messages-display').append('<span class="chat-sender">[' + date.toLocaleString("fr-FR", dateOption) + '] ' + data.user.username + '</span>: ' + htmlEntities(data.content.removeAccent()) + '<br/>');
}

function reloadChat()
{
    var chat_id = $('#chat-container').attr('chatid');
    $.ajax({
        url: webroot + '/chat/getMessages/' + chat_id,
        dataType: 'json',
        success: function(data){
            $('#chat-messages-display').html('');
            $.each(data.chatMessages, function(key, value){
                addToChat(value);
            });
        },
        error: function(data){
            console.log('Can\'t reload chat.');
            console.log(data);
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
            'content': htmlEntities(input_message.val()).removeAccent(),
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
