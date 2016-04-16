<main id="home-container">
    <div class="left-home-container">
        <div class="left-top-home-part">
            <div class="lore-link">
                <a href="#">
                    -Lore-
                </a>
            </div>
            <div class="game-launcher">
                <a href=<?php echo WEBROOT ?>game/create class="launcher-button">Create</a>
                <a href=<?php echo WEBROOT ?>game class="launcher-button">Join</a>
            </div>
        </div>
        <div class="rules">
            <h1>-Rules-</h1>
            <p>Treat your opponents as you would treat your mother.</p>
            <p>Don't be a crybaby, losing is a part of the game just as much as winning</p>
            <p>No aimbot</p>
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
                <span class="chat-sender">Matt</span><span class="chat-message">: Wesh !<br/>
                <span class="chat-sender">Keth</span><span class="chat-message">: Wesh, c'est qui le meilleur??<br/>
                <span class="chat-sender">Matt</span><span class="chat-message">: C'est toi, ô beau mâle !!!!<br/>
                <span class="chat-sender">Keth</span><span class="chat-message">: Hmmm... OUiiiii !<br/>
         </div>
            <div id="chat-send-container">
                <input type="text"><input type="submit">
            </div>
        </div>
    </div>
</main>