<? defined('KOOWA') or die; ?>

<? if ($actorbar->getTitle() && $actorbar->getActor()) : ?>
<div class="an-media-header">
	<div class="clearfix">
		<div class="avatar">
			<?= @avatar($actorbar->getActor())?>
		</div>

		<div class="info">
			<h2 class="title"><?= $actorbar->getTitle() ?></h2>
			<? if ($actorbar->getDescription()) : ?>
			<div class="description"><?= $actorbar->getDescription() ?></div>
			<? endif; ?>
		</div>
	</div>

	<ul class="toolbar inline">
	<? foreach ($actorbar->getCommands() as $command) : ?>
		<li><?= @helper('ui.command', $command) ?></li>
	<? endforeach; ?>
		<li class="profile visible-desktop">
			<a href="<?=@route($actorbar->getActor()->getURL())?>">
			<?= @text('COM-ACTORS-BACK-TO-PROFILE') ?>
			</a>
		</li>
	</ul>
</div>
<? endif;?>
