<?php $this->assign('title','Usuários') ?>
<section class="content" style="margin-top: -25px">

<h3>Lista de Usuários</h3>
<div class="row-fluid">
	<p>Escolha ou adicione um novo profissional</p>
	<div class="row-fluid">
		<span class="span2"><a href="<?= $this->Html->url(array('controller' => 'users', 'action' => 'add')) ?>" class="btn btn-primary">Novo Usuário</a></span>
	</div>
</div>
<br><br>
	<table class="table table-striped">
	<tr>
			<th><?php echo $this->Paginator->sort('id'); ?></th>
			<th><?php echo $this->Paginator->sort('username','Usuário'); ?></th>
			<th><?php echo $this->Paginator->sort('password','Senha'); ?></th>
			<th><?php echo $this->Paginator->sort('active','Ativo'); ?></th>
			<th><?php echo $this->Paginator->sort('adm','Adm'); ?></th>
			<th><?php echo $this->Paginator->sort('created','Criado'); ?></th>
			<th><?php echo $this->Paginator->sort('modified','Modificado'); ?></th>
			<th class="actions"><?php echo __('Actions','Ações'); ?></th>
	</tr>
	<?php foreach ($users as $user): ?>
	<tr>
		<td><?php echo h($user['User']['id']); ?>&nbsp;</td>
		<td><?php echo h($user['User']['username']); ?>&nbsp;</td>
		<td><?php echo h($user['User']['password']); ?>&nbsp;</td>
		<td><?php echo h($user['User']['active']); ?>&nbsp;</td>
		<td><?php echo h($user['User']['adm']); ?>&nbsp;</td>
		<td><?php echo h($user['User']['created']); ?>&nbsp;</td>
		<td><?php echo h($user['User']['modified']); ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View |'), array('url' => 'view', $user['User']['id'])); ?>
			<?php echo $this->Html->link(__('Edit |'), array('url' => 'edit', $user['User']['id'])); ?>
			<?php echo $this->Form->postLink(__('Delete'), array('url' => 'delete', $user['User']['id']), null, __('Tem certeza que deseja deletar o usuário %s?', $user['User']['id'])); ?>
		</td>
	</tr>
<?php endforeach; ?>
	</table>

</section>

	
	<?= $this->element('paginator');?>

