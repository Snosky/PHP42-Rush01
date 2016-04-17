<main>
	<div class="ingame_display">
	</div>
	<a class="launcher-button" href="<?php echo (WEBROOT."/game/leave/".$game->getId());?>">Leave dah game</a>
	<div class="ingame_chat">
		<p class="ingame_chat_title">Welcome to <span class="bold"><?php echo $game->getAdmin()->getUsername(); ?></span>'s game!<br><br>
		</p>
		<p>Online Players :<BR><BR></p>
		<?php foreach ($game->getPlayers() as $player) : ?>
			<p><?php echo $player->getUsername(); ?></p>
		<?php endforeach; ?>
		<iframe src="<?php echo WEBROOT ?>chat/home/<?php echo $game->getId() ?>" frameborder="0"
		class="yoloswag"></iframe>
	</div>
</main>