<!DOCTYPE html>
<style>
body {
  min-height: 2000px;
  padding-top: 70px;
}
</style>
<html lang="en">
  <head>
    <?= $this->Html->charset(); ?>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>
      Laukkoski.com
    </title>
    <?php
        echo $this->Html->meta('icon');

        echo $this->Html->css('https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/css/bootstrap.min.css');
				echo $this->Html->css('https://cdnjs.cloudflare.com/ajax/libs/bootstrap-social/5.1.1/bootstrap-social.min.css');


        echo $this->fetch('meta');
        echo $this->fetch('css');
        echo $this->fetch('script');

        echo $this->Html->script('https://code.jquery.com/jquery-3.2.1.min.js');
        echo $this->Html->script('https://cdnjs.cloudflare.com/ajax/libs/tether/1.4.0/js/tether.min.js'); #, array('block' => 'scriptBottom'));
        echo $this->Html->script('https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/js/bootstrap.min.js');

				echo $this->fetch('scriptTop');

    ?>
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->

  </head>
  <body>

    <?= $this->element('Blog.header') ?>

    <div id="content" class="container">

      <?= $this->Flash->render(); ?>
      
      <div class="row">

        <?= $this->fetch('content'); ?>

      </div>

    </div>

    <?= $this->element('Blog.footer') ?>

    <?= $this->fetch('scriptBottom');?>

  </body>
</html>
