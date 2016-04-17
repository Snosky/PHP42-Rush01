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
                console.log(data.games[1].password);
                data.games.each(function(key, value){
                    var node = document.createElement("td");
                    var textnode;
                    if (value.password)
                        textnode = "Password required";
                    else
                        textnode = "";
                    
                    $("#games-list").appendChild("<div>");
                })
            }
        })
    }
</script>