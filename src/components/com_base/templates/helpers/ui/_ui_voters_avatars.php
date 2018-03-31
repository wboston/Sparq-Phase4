<? defined('KOOWA') or die; ?>
<? if ($entity->voteUpCount > 0) : ?>

<div class="modal-header">
	<?= $entity->voteUpCount == 1 ? @text('LIB-AN-VOTE-ONE-VOTED') : sprintf(@text('LIB-AN-VOTE-OTHER-VOTED'), $entity->voteUpCount)?>
</div>

<div class="modal-body">
	<div class="an-entities">
		<? foreach ($entity->voteups->voter as $actor) : ?>
		<div class="an-entity">
			<div class="entity-portrait-square">
				<?= @avatar($actor) ?>
			</div>
			<div class="entity-container">
				<h4 class="entity-title"><?= @name($actor) ?></h4>

				<div class="entity-description">
					<?= @helper('text.truncate', strip_tags($actor->description), array('length' => 200)); ?>
				</div>

				<div class="entity-meta">
					<?= $actor->followerCount ?>
					<span class="stat-name"><?= @text('COM-ACTORS-SOCIALGRAPH-FOLLOWERS') ?></span>
				</div>
			</div>
		</div>
		<? endforeach; ?>
	</div>
</div>
<? endif;?>
