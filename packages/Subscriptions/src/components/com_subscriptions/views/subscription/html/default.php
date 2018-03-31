<? defined('KOOWA') or die('Restricted access'); ?>

<div class="row">
	<div class="span8">

	    <?= @helper('ui.header') ?>

        <? if (!$actor->hasSubscription()): ?>
        <div class="alert alert-warning">
        	<p><?= @text('COM-SUBSCRIPTIONS-SUBSCRIPTIONS-NOT-SUBSCRIBED') ?></p>
        	<p>
        		<a href="<?= @route('view=packages') ?>" class="btn">
        			<?= @text('COM-SUBSCRIPTIONS-SUBSCRIPTION-ACTION-SIGN-ME-UP') ?>
        		</a>
        	</p>
        </div>

        <? elseif ($subscription->expired()): ?>
        <div class="alert alert-error">
        	<p><?= @text('COM-SUBSCRIPTIONS-PACKAGE-HAS-EXPIRED') ?></p>

        	<p>
        		<a href="<?= @route('view=packages') ?>" class="btn btn-warning">
        			<?= @text('COM-SUBSCRIPTIONS-PACKAGE-ACTION-SUBSCRIBE-RENEW') ?>
        		</a>
        	</p>
        </div>
        <? else: ?>
        <? $package = $subscription->package; ?>
        <div id="sub-package">
        	<h3 class="package-title"><?= @escape($package->name) ?></h3>

        	<div class="package-info">
        		<div class="key"><?= @text('COM-SUBSCRIPTIONS-BILLING-PERIOD') ?>:</div>
        		<div class="value"><?= ($package->recurring) ? @text('COM-SUBSCRIPTIONS-BILLING-PERIOD-RECURRING-'.$package->billingPeriod) : @text('COM-SUBSCRIPTIONS-BILLING-PERIOD-'.$package->billingPeriod) ?></div>
        	</div>

        	<div class="package-info">
        		<div class="key"><?= @text('COM-SUBSCRIPTIONS-PACKAGE-PRICE') ?>:</div>
        		<div class="value"><?= $package->price.' '.get_config_value('subscriptions.currency', 'US') ?></div>
        	</div>

        	<div class="package-description">
        		<?= @content($package->description) ?>

        		<? if (!$package->recurring && $package->authorize('upgradepackage')) : ?>
        		<p>
        			<a href="<?=@route(array('view' => 'signup', 'id' => $package->id))?>" class="btn">
        				<?= @text('COM-SUBSCRIPTIONS-PACKAGE-ACTION-UPGRADE-NOW') ?>
        			</a>
        		</p>
        		<? elseif ($package->authorize('subscribepackage')) : ?>
        		<p>
        			<a href="<?=@route(array('view' => 'signup', 'id' => $package->id))?>" class="btn">
        				<?= @text('COM-SUBSCRIPTIONS-PACKAGE-ACTION-SUBSCRIBE-NOW') ?>
        			</a>
        		</p>
        		<? endif; ?>
        	</div>

        	<? if (!$package->recurring): ?>
        	<? $daysLeft = ceil(AnHelperDate::secondsTo('day', $subscription->getTimeLeft())); ?>
        	<div class="alert alert-<?= ($daysLeft < 31) ? 'warning' : 'success' ?>">
        		<p><?= sprintf(@text('COM-SUBSCRIPTIONS-PACKAGE-ABOUT-TO-EXPIRE'), $daysLeft); ?></p>

        		<? if ($daysLeft < 31) : ?>
        		<p>
        			<a href="<?= @route('view=packages') ?>" class="btn btn-warning">
        				<?= @text('COM-SUBSCRIPTIONS-PACKAGE-ACTION-SUBSCRIBE-RENEW') ?>
        			</a>
        		</p>
        		<? endif; ?>
        	</div>
        	<? endif; ?>
        </div>
        <? endif; ?>
	</div>
</div>
