<main id="main-games-list">
    <div onclick="refreshGamesList()">refresh list</div>
    <table class="games-list-container left-home-container">
        <thead>
            <tr>
                <td>Private/Public</td>
                <td style="font-weight: bolder;">Game</td>
                <td>Players</td>
            </tr>
        <tr>

        </tr>
        </thead>
        <tbody id="games-list">
            <!-- Here is the list of games -->
        </tbody>
    </table>
    <div id="chat-container">
        <div id="inner-chat-container">
            <div id="chat-messages-display">
                <?php foreach ($chatMessages as $msg): ?>
                    <span class="chat-sender">[<?php echo $msg->getDate()->format('G:i') ?>] <?php echo $msg->getUser()->getUsername(); ?></span>: <?php echo $msg->getContent(); ?><br />
                <?php endforeach; ?>
            </div>
            <div id="chat-send-container">
                <form action="<?php echo WEBROOT ?>chat/addMessage" method="POST" id="chat-send">
                    <input autocomplete="off" type="text" name="content">
                    <input type="hidden" name="chat_id" value="0">
                    <input type="submit" value="Send message">
                </form>
            </div>
        </div>
    </div>
</main>
<script>
    function refreshGamesList() {
        webroot = window.location.origin;
        $.ajax({
            url: document.location.href,
            dataType: 'json',
            success: function (data) {
                var gamesList = document.getElementById("games-list");
                while(gamesList.firstChild){
                    gamesList.removeChild(gamesList.firstChild);
                }
                $.each(data.games, function(key, value){
                    var players = 0;
                    $.each(value.player, function(key, value){ players++; });
                    var father = document.createElement("tr");
                    var node = document.createElement("td");
                    var textnode;
                    if (value.password)
                        textnode = document.createTextNode("Password required");
                    else
                        textnode = document.createTextNode("");
                    node.className = 'password-games';
                    node.appendChild(textnode);
                    father.appendChild(node);
                    document.getElementById("games-list").appendChild(father);
                    node = document.createElement("td");
                    textnode = document.createTextNode(value.admin.username + "'s game");
                    switch(players){
                        case 0:
                            node.className = "oneP ";
                            break;
                        case 1:
                            node.className = "twoP ";
                            break;
                        case 2:
                            node.className = "threeP ";
                            break;
                        case 3:
                            node.className = "fourP ";
                    }
                    node.className += 'name-games';
                    node.appendChild(textnode);
                    father.appendChild(node);
                    var players = 0;
                    $.each(value.player, function(key, value){ players++; });
                    node = document.createElement("td");
                    textnode = document.createTextNode((players + 1) + "/4");
                    switch(players){
                        case 0:
                            node.className = "oneP ";
                            break;
                        case 1:
                            node.className = "twoP ";
                            break;
                        case 2:
                            node.className = "threeP ";
                            break;
                        case 3:
                            node.className = "fourP ";
                    }
                    node.className += 'player-count-games';
                    node.appendChild(textnode);
                    father.appendChild(node);
                    node = document.createElement("td");
                    textnode = document.createElement("a");
                    var link = document.createTextNode("Join game");
                    textnode.appendChild(link);
                    node.className = 'join-game-link-games';
                    textnode.href = document.location.href + "/join/" + value.id;
                    node.appendChild(textnode);
                    father.appendChild(node);
                });
            }
        })
    }
    refreshGamesList();
    setInterval(refreshGamesList, 30 * 1000);
</script>