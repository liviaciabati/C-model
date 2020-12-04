<!-- File: /app/View/Posts/index.ctp  (links para edi��o adicionados) -->

<h1>Blog posts</h1>
<p><?php echo $this->Html->link("Add Post", array('url' => 'add')); ?></p>
<table>
    <tr>
        <th>Id</th>
        <th>Title</th>
        <th>Action</th>
        <th>Created</th>
    </tr>

<!-- Aqui � onde n�s percorremos nossa matriz $posts, imprimindo
as informa��es dos posts -->

<?php foreach ($posts as $post): ?>
    <tr>
        <td><?php echo $post['Post']['id']; ?></td>
        <td>
            <?php echo $this->Html->link($post['Post']['title'], array('url' => 'view', $post['Post']['id']));?>
                </td>
                <td>
            <?php echo $this->Form->postLink(
                'Delete',
                array('url' => 'delete', $post['Post']['id']),
                array('confirm' => 'Are you sure?')
            )?>
            <?php echo $this->Html->link('Edit', array('url' => 'edit', $post['Post']['id']));?>
        </td>
        <td><?php echo $post['Post']['created']; ?></td>
    </tr>
<?php endforeach; ?>

</table>