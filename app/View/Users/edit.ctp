<section class="content" style="margin-top: -25px">
<div class="">
	<?php echo $this->Form->create('User'); ?>
	
		<h3><?php echo __('Editar Usuário'); ?></h3>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('username');
		echo $this->Form->input('password');
		echo $this->Form->input('active', array('div'=>false));
		echo $this->Form->input('adm', array('div'=>false));
	?>
	
	<div>
	<?= $this->Html->link('<i class="fa fa-arrow-left"></i> Voltar',array('action'=>'index'),array('class'=>'btn btn-primary','escape'=>false)) ?>
	<?php echo $this->Form->button('<i class="fa fa-save"></i> Salvar', array('type' => 'submit','escape' => false,'class' => 'btn btn-primary')); ?>
	</div>
</div>
</section>
