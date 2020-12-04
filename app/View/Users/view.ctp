<section class="content" style="margin-top: -25px">

<div class="users view">
<h3><?php  echo __('User'); ?></h3>
	<dl class='dl-horizontal'>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($user['User']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Username'); ?></dt>
		<dd>
			<?php echo h($user['User']['username']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Password'); ?></dt>
		<dd>
			<?php echo h($user['User']['password']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Active'); ?></dt>
		<dd>
			<?php echo h($user['User']['active']); ?>
			&nbsp;
		</dd>
		
		<dt><?php echo __('Adm'); ?></dt>
		<dd>
			<?= h($user['User']['adm']); ?>
			&nbsp;
		</dd>
		
		<dt><?php echo __('Created'); ?></dt>
		<dd>
			<?php echo h($user['User']['created']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Modified'); ?></dt>
		<dd>
			<?php echo h($user['User']['modified']); ?>
			&nbsp;
		</dd>
	</dl>
</div>



<div class="actions">
	<?= $this->Html->link('<i class="fa fa-arrow-left"></i> Voltar',array('action'=>'index'),array('class'=>'btn btn-primary','escape'=>false)) ?>
	<?= $this->Html->link('<i class="fa fa-edit"></i> Editar',array('action'=>'edit',$user['User']['id']),array('class'=>'btn btn-primary','escape'=>false)) ?>
	<?= $this->Form->postLink('<i class="fa fa-trash-o"></i> Deletar',array('action'=>'delete',$user['User']['id']),array('class'=>'btn btn-primary','escape'=>false),'Tem certeza que deseja deletar este usuario?') ?>
</div>

</section>

