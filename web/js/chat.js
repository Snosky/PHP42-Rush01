function success(data)
{
    console.log(data);
}

webroot = document.location.href;

var data = {
    'message': 'Mon 1er message',
    'chat_id': 0,
}

$.ajax({
  type: "POST",
  url: webroot + 'chat/addMessage',
  data: data,
  success: success,
  dataType: 'json'
});
