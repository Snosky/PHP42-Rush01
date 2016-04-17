<table>
    <thead>
        <tr>
            <td id="refresh-game-btn" onclick="refreshGameList()">Refresh</td>
            <td>Game</td>
            <td>Players</td>
            <td></td>
        </tr>
    </thead>
    <tbody id="game-list">
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
    function refreshGameList(){
        $("#game-list").load(location.href + " #game-list>*","");
    }
</script>