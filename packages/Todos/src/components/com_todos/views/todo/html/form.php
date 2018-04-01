<? defined('KOOWA') or die('Restricted access'); ?>

<? $todo = empty($todo) ? @service('repos:todos.todo')->getEntity()->reset() : $todo; ?>

<? $url = $todo->getURL().'&oid='.$actor->id; ?>

<form method="post" action="<?= @route($url) ?>" class="an-entity">
	<fieldset>
		<legend><?= ($todo->persisted()) ? @text('COM-TODOS-TODO-EDIT') : @text('COM-TODOS-TODO-ADD') ?></legend>

		<div class="control-group">
			<label class="control-label" for="title"><?= @text('COM-TODOS-MEDIUM-TITLE') ?></label>
			<div class="controls">
				<input required name="title" class="input-block-level" value="<?= @escape($todo->title) ?>" size="50" maxlength="255" type="text">
			</div>
		</div>

		<div class="control-group">
			<label class="control-label" for="todo-description"><?= @text('COM-TODOS-MEDIUM-DESCRIPTION') ?></label>
			<div class="controls">
                <textarea maxlength="5000" class="input-block-level" name="description" cols="50" rows="5"><?= @escape($todo->description) ?></textarea>
            </div>
		</div>

		<div class="control-group">
			<label class="control-label" for="priority"><?= @text('COM-TODOS-TODO-PRIORITY') ?></label>
			<div class="controls">
				<?= @helper('prioritylist', $todo->priority)?>
			</div>
		</div>

		<div class="control-group">
			<label class="control-label" id="privacy" ><?= @text('LIB-AN-PRIVACY-FORM-LABEL') ?></label>
			<div class="controls">
				<?= @helper('ui.privacy', array('entity' => $todo, 'auto_submit' => false, 'options' => $actor)) ?>
			</div>
		</div>

		<div class="form-actions">
			<? if ($todo->persisted()): ?>
				<? if (KRequest::type() == 'AJAX'): ?>
				<a data-action="cancel" class="btn" href="<?= @route($url.'&layout=list') ?>">
					<?= @text('LIB-AN-ACTION-CANCEL') ?>
				</a>
				<? else : ?>
				<? $cancelURL = ($todo->persisted()) ? $todo->getURL() : 'view=todos&oid='.$actor->id ?>
				<a class="btn" href="<?= @route($cancelURL) ?>">
					<?= @text('LIB-AN-ACTION-CANCEL') ?>
				</a>
				<? endif; ?>

				<button type="submit" class="btn btn-primary" data-loading-text="<?= @text('LIB-AN-MEDIUM-UPDATING') ?>">
					<?= @text('LIB-AN-ACTION-UPDATE') ?>
				</button>
			<? else : ?>
			<a data-trigger="CancelAdd" class="btn" href="<?= @route('view=todos&oid='.$actor->id) ?>">
				<?= @text('LIB-AN-ACTION-CANCEL') ?>
			</a>

			<button data-trigger="Add" class="btn btn-primary" data-loading-text="<?= @text('LIB-AN-MEDIUM-POSTING') ?>">
				<?= @text('LIB-AN-ACTION-ADD') ?>
			</button>
			<? endif; ?>
		</div>
	</fieldset>
</form>
