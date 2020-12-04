<?php $params = $this->Paginator->params(); ?>
<?php $params['limit'] = 5 ?>
<div class="row-fluid pagination">
    <div class="span3" >
        <?= $this->Paginator->counter('Página {:page} de {:pages}') ?>
    </div>
    <div class="span6">
    <?php if ($params['pageCount'] > 1): ?>
            <ul>
            <?php
                echo $this->Paginator->prev('&larr;', array(
                    'class' => 'prev',
                    'tag' => 'li',
                    'escape' => false
                ), '<a onclick="return false;">&larr;</a>', array(
                    'class' => 'prev disabled',
                    'tag' => 'li',
                    'escape' => false
                ));
                echo $this->Paginator->numbers(array(
                    'separator' => '',
                    'tag' => 'li',
                    'currentClass' => 'active',
                    'currentTag' => 'a',
                    'modulus' => 4,
                    'ellipsis' => '<li class="disabled"><a onclick="return false;">...</a></li>',
                    'first' => 2,
                    'last' => 2
                ));
                echo $this->Paginator->next('&rarr;', array(
                    'class' => 'next',
                    'tag' => 'li',
                    'escape' => false
                ), '<a onclick="return false;">&rarr;</a>', array(
                    'class' => 'next disabled',
                    'tag' => 'li',
                    'escape' => false
                )); ?>
            </ul>
    <?php endif ?>
    </div>
    <div class="" style="float:right;">
        Total:<b> <?= $this->Paginator->counter('{:count}'); ?> </b>- 
        Itens por página: 
        <?= $this->Paginator->link('1',array('limit'=>1,'page'=>1))?> |
        <?= $this->Paginator->link('2',array('limit'=>2,'page'=>1))?> |
        <?= $this->Paginator->link('5',array('limit'=>5,'page'=>1))?>
    </div>
</div>