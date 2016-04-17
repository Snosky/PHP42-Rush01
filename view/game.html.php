You're in a game.
Admin :
<p><?php echo $game->getAdmin()->getUsername(); ?></p>
Players :
<ul>
    <?php foreach ($game->getPlayers() as $player) : ?>
        <li><?php echo $player->getUsername(); ?></li>
    <?php endforeach; ?>
</ul>
<iframe src="<?php echo WEBROOT ?>chat/home/<?php echo $game->getId() ?>" frameborder="0"></iframe>