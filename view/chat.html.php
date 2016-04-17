<div id="chat-container" chatid="<?php echo $chat_id ?>">
    <div id="inner-chat-container">
        <div id="chat-messages-display">
            <?php foreach ($chatMessages as $msg): ?>
                <span class="chat-sender">[<?php echo $msg->getDate()->format('G:i') ?>] <?php echo $msg->getUser()->getUsername(); ?></span>: <?php echo $msg->getContent(); ?><br />
            <?php endforeach; ?>
        </div>
        <div id="chat-send-container">
            <form action="<?php echo WEBROOT ?>chat/addMessage" method="POST" id="chat-send">
                <input autocomplete="off" type="text" name="content">
                <input type="hidden" name="chat_id" value="<?php echo $chat_id ?>">
                <input type="submit" value="Send message">
            </form>
        </div>
    </div>
</div>
<script type="text/javascript" src="<?php echo WEBROOT ?>web/js/jquery-1.12.3.min.js"></script>
<script type="text/javascript" src="<?php echo WEBROOT ?>web/js/chat.js"></script>