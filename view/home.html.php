<main id="home-container">
    <div class="left-home-container">
        <div class="left-top-home-part">
            <div class="lore-link">
                <a href="#">
                    -Lore-
                </a>
            </div>
            <div class="game-launcher">
                <a href=<?php echo WEBROOT ?>game/create class="launcher-button">Create Game</a>
                <a href=<?php echo WEBROOT ?>game class="launcher-button">Join Game</a>
            </div>
        </div>
        <div class="rules">
            <h1>-Rules-</h1>
            <p>Treat your opponents as you would treat your mother.</p>
            <p>Don't be a crybaby, losing is a part of the game just as much as winning.</p>
            <p>No aimbot.</p>
            <p>Bug exploiting is allowed as long as you don't use a third party program to do it.</p>
        </div>
    </div>
    <div id="chat-container">
            <?php if ($isConnected): ?>
                <a href=<?php echo WEBROOT ?>user/disconnect class="sign-button">Log out</a>
            <?php endif ; if (!$isConnected): ?>
                <a href=<?php echo WEBROOT ?>user class="sign-button">Sign in / Sign up</a>
            <?php endif; ?>
            <div id="inner-chat-container">
            <div id="chat-messages-display">
                <?php foreach ($chatMessages as $msg): ?>
                    <span class="chat-sender">[<?php echo $msg->getDate()->format('G:i') ?>] <?php echo $msg->getUser()->getUsername(); ?></span>: <?php echo $msg->getContent(); ?><br />
                <?php endforeach; ?>
            </div>
            <div id="chat-send-container">
                <form action="<?php echo WEBROOT ?>chat/addMessage" method="POST" id="chat-send">
                    <input type="text" name="content">
                    <input type="hidden" name="chat_id" value="0">
                    <input type="submit" value="Send message">
                </form>
            </div>
        </div>
    </div>
</main>