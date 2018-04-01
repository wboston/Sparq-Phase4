<? defined('KOOWA') or die('Restricted access');?>

<div class="an-entity">
	<div class="clearfix">
		<div class="entity-portrait-square">
			<?= @avatar($topic->author) ?>
		</div>

		<div class="entity-container">
		    <? if ($topic->owner->authorize('administration') && $topic->pinned): ?>
            <span class="label label-info pull-right"><?= @text('LIB-AN-PINNED') ?></span>
            <? endif; ?>
			<h4 class="author-name"><?= @name($topic->author) ?></h4>
			<ul class="an-meta inline">
				<li><?= @date($topic->creationTime) ?></li>
				<? if (!$topic->owner->eql($topic->author)): ?>
				<li><?= @name($topic->owner) ?></li>
				<? endif; ?>
			</ul>
		</div>
	</div>

	<h3 class="entity-title">
		<a href="<?= @route($topic->getURL()) ?>">
            <?= @escape($topic->title) ?>
        </a>
	</h3>

	<div class="entity-description">
	<?= @helper('text.truncate',
        @content($topic->body,
           array('exclude' => 'gist')),
           array('length' => 200, 'consider_html' => true));
    ?>
	</div>

	<div class="entity-meta">
		<ul class="an-meta inline">
			<li><?= sprintf(@text('LIB-AN-MEDIUM-NUMBER-OF-COMMENTS'), $topic->numOfComments) ?></li>
		</ul>

		<div class="an-meta vote-count-wrapper" id="vote-count-wrapper-<?= $topic->id ?>">
			<?= @helper('ui.voters', $topic); ?>
		</div>
	</div>
</div>
