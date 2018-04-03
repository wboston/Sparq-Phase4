<? defined('KOOWA') or die;?>
<!DOCTYPE html>
<html>
    <head>
  		<meta name="viewport" content="width=device-width, initial-scale=1.0 maximum-scale=1.0, user-scalable=0" charset="UTF-8">
        <?= @render('favicon') ?>
        <?= @render('style') ?>
  	</head>
    <body>
        <?= @template('tmpl/navbar') ?>

        <div class="container">
    	<?= $this->getView()->content; ?>
    	</div>

    	<?= @template('tmpl/js') ?>
        <?= @template('tmpl/analytics') ?>
    </body>
</html>
