<? if (!defined('KOOWA')) {
    die;
} ?>

<div class="page-header">
    <h1><?= @text('TMPL-ERROR-DEFAULT-HEADER') ?></h1>
</div>


<div class="alert alert-block alert-error">
<h4 class="alert-heading"><? print AnTranslator::_('TMPL-ERROR-DEFAULT-TITLE') ?></h4>
<p><? print AnTranslator::_('TMPL-ERROR-DEFAULT-DESC') ?></p>
</div>
