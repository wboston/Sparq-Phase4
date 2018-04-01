<? defined('KOOWA') or die ?>

<? if (count($sets)): ?>
	<div id="sets" class="an-entities">
	<? foreach ($sets as $set): ?>
	<div class="an-entity an-record">

		<div class="entity-portrait-square">
			<a href="<?= @route($set->getURL()) ?>">
				<img src="<?= $set->getCoverSource('square') ?>" alt="<?= $set->alias ?>" />
			</a>
		</div>

		<div class="entity-container">
			<h4 class="entity-title">
				<a href="<?= @route($set->getURL()) ?>">
					<?= @helper('text.truncate',  @escape($set->title), array('length' => 25, 'omission' => '...')) ?>
				</a>
			</h4>

			<div class="entity-meta">
				<?= sprintf(@text('COM-PHOTOS-SET-META-PHOTOS'), $set->getPhotoCount()) ?>
			</div>
		</div>
	</div>
	<? endforeach; ?>
	</div>
<? else: ?>
<?= @message(@text('COM-PHOTOS-PHOTO-NO-RELATED-SETS')) ?>
<? endif; ?>
