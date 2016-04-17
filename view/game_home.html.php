<table>
    <thead>
        <tr>
            <td id="refresh-game-btn" onclick="refreshGamesList()">Refresh</td>
            <td>Game</td>
            <td>Players</td>
            <td></td>
        </tr>
    </thead>
    <tbody id="games-list">
    <?php foreach ($games as $game): ?>
    <tr>
        <td>
            <?php if ($game->getPassword()): ?>
            Password required
            <?php endif; ?>
        </td>
        <td><?php echo $game->getAdmin()->getUsername() ?>'s game</td>
        <td>
            <?php echo count($game->getPlayers()) + 1; ?>/4
        </td>
        <td>
            <a href="<?php echo WEBROOT; ?>game/join/<?php echo $game->getId() ?>" class="btn">Join game</a>
        </td>
    </tr>
    <?php endforeach; ?>
    </tbody>
</table>
<script>
    function refreshGamesList() {
        webroot = window.location.origin;
        console.log(webroot);
        $.ajax({
            url: document.location.href,
            dataType: 'json',
            success: function (data) {
                var gamesList = document.getElementById("games-list");
                while(gamesList.firstChild){
                    gamesList.removeChild(gamesList.firstChild);
                }
                console.log(data.games);
                $.each(data.games, function(key, value){
                    var father = document.createElement("tr");
                    var node = document.createElement("td");
                    var textnode;
                    if (value.password)
                        textnode = document.createTextNode("Password required");
                    else
                        textnode = document.createTextNode("");
                    node.appendChild(textnode);
                    father.appendChild(node);
                    document.getElementById("games-list").appendChild(father);
                    node = document.createElement("td");
                    textnode = document.createTextNode(value.admin.username + "'s game");
                    node.appendChild(textnode);
                    father.appendChild(node);
                    var players = 0;
                    $.each(value.players, function(key, value){ players++; });
                    node = document.createElement("td");
                    textnode = document.createTextNode((players + 1) + "/4");
                    node.appendChild(textnode);
                    father.appendChild(node);
                    node = document.createElement("td");
                    textnode = document.createElement("a");
                    var link = document.createTextNode("Join game");
                    textnode.appendChild(link);
                    textnode.href = "#";
                    node.appendChild(textnode);
                    father.appendChild(node);
                });
            }
        })
    }
</script>