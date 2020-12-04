<!DOCTYPE html>
<html style="margin-top: -20px;"> 
	<head>
		<?php echo $this->Html->charset(); ?>
		<!--<meta name="viewport" content="width=device-width; initial-scale=1.0; maximum-scale=1.0; user-scalable=0;">-->
		<meta name="viewport" content="width=device-width, height=device-height, initial-scale=1.0, user-scalable=yes">
	<title>
		<?=	$this->fetch('title');	?>
	</title>
	<?= $this->Html->meta('icon', 'app/favicon.ico'); ?>
		
	<?php $this->start('css') ?>
	<?=  $this->Html->css('bootstrap');?>
	<?=	 $this->Html->css('font-awesome.min');?>
	<?=  $this->Html->css('ionicons.min');?>
	<?=	 $this->Html->css('AdminLTE');?>
    <?=  $this->Html->css('projeto');?>
	<?=	 $this->Html->css('morris/morris');?>
	<?php $this->end() ?>
	
	<?php $this->start('script') ?>
	<?=  $this->Html->script('jquery');?>
	<?=  $this->Html->script('bootstrap.min');?>
	<?=	 $this->Html->script('AdminLTE/app');?>
	<?=	 $this->Html->script('plugins/flot/jquery.flot.min');?>
	<?=	 $this->Html->script('plugins/flot/jquery.flot.pie.min');?>
	<?=	 $this->Html->script('plugins/flot/jquery.flot.resize.min');?>
	<?=	 $this->Html->script('plugins/flot/jquery.flot.axislabels');?>
	<?=	 $this->Html->script('plugins/morris/Raphael');?>
	<?=	 $this->Html->script('plugins/morris/morris.min');?>
	<?=	 $this->Html->script('plugins/sparkline/jquery.sparkline.min');?>
	<?php $this->end() ?>


	<?=	$this->fetch('meta');	?>
	<?=	$this->fetch('css');	?>
	<?= $this->fetch('script');	?>
	
	<?php echo $this->element('google-analytics'); ?>

	</head>
	
		<?php echo $this->fetch('content'); ?>
	
</html>
