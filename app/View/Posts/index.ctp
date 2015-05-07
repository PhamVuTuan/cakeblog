<h1>Blog posts</h1>
<p><?php echo $this->Html->link('En', array('action' => 'change','en')); ?>|
    <?php echo $this->Html->link('Vi', array('action' => 'change','vi')); ?></p>
<p><?php echo $this->Html->link(__('Add Post'), array('action' => 'add')); ?></p>
<table>
    <tr>
        <th>Id</th>
        <th><?php echo __('Title') ?></th>
        <th><?php echo  __('Action') ?></th>
        <th><?php echo  __('Created')?></th>
    </tr>

    <!-- Here's where we loop through our $posts array, printing out post info -->

    <?php foreach ($posts as $post): ?>
        <tr>
            <td><?php echo $post['Post']['id']; ?></td>
            <td>
                <?php
                echo $this->Html->link(
                    $post['Post']['title'],
                    array('action' => 'view', $post['Post']['id'])
                );
                ?>
            </td>
            <td>
                <?php
               /* echo $this->Form->postLink(
                    'Delete',
                    array('action' => 'delete', $post['Post']['id']),
                    array('confirm' => 'Are you sure?')
                );*/

                echo $this->Html->link(
                    __('Delete'),
                     array('action'=>'delete',$post['Post']['id'])
                    );
                ?>
                <?php
                echo $this->Html->link(
                    __('Edit'),
                    array('action' => 'edit', $post['Post']['id'])
                );
                ?>
            </td>
            <td>
                <?php echo $post['Post']['created']; ?>
            </td>
        </tr>
    <?php endforeach; ?>

</table>