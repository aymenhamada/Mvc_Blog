<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Post[]|\Cake\Collection\CollectionInterface $posts
 */
?>
<h1>View All Users</h1>
<table class="table table-hover">
  <thead>
    <tr>
      <th scope="col">Users</th>
      <th scope="col">username</th>
      <th scope="col">name</th>
      <th scope="col">lastname</th>
      <th scope="col">birthdate</th>
      <th scope="col">email</th>
      <th scope="col">role</th>
      <th scope="col">Action</th>
    </tr>
  </thead>
  <tbody>
  <?php if(!empty($users)):?>
  <?php foreach($users as $user):?>
    <tr>
      <th scope="row"> <?= $user->id ?></th>
      <td><?= h($user->username) ?></td>
      <td><?= h($user->name) ?></td>
      <td><?= h($user->lastname) ?></td>
      <td><?= h($user->birthdate) ?></td>
      <td> <?= h($user->email) ?><br>
      <td> <?= h($user->role) ?> </td>
      <td><?= $this->Html->link(
    'View',
    ['controller' => 'users', 'action' => 'view', 'prefix' => false, $user->id],
    ['class' => 'btn btn-info'])?>
        <?=  $this->Html->link(
    'Edit',
    ['controller' => 'users', 'action' => 'edit', 'prefix' => false, $user->id],
    ['class' => 'btn btn-success']);?>
    <?=  $this->Html->link(__(
    'Delete'),
    ['action' => 'delete', $user->id],
    ['class' => 'btn btn-danger']) ;?>
    <?= $user->active ? $this->Html->link(__('Block this account'),
    ['action' => 'block', $user->id],
    ['class' => 'btn btn-primary']) : $this->Html->link(__('Unlock this account'),
    ['action' => 'unlock', $user->id],
    ['class' => 'btn btn-info'])  ?> </td>
    </tr>
<?php endforeach;?>
<?php else:?>
    <tr>
      <th scope="row">No records found</th>
    </tr>
<?php endif;?>
</tbody>
</table>
<div class="paginator">
        <ul class="pagination">
            <?= $this->Paginator->first('<< ' . __('first')) ?>
            <?= $this->Paginator->prev('< ' . __('previous')) ?>
            <?= $this->Paginator->numbers() ?>
            <?= $this->Paginator->next(__('next') . ' >') ?>
            <?= $this->Paginator->last(__('last') . ' >>') ?>
        </ul>
        <p><?= $this->Paginator->counter(['format' => __('Page {{page}} of {{pages}}, showing {{current}} record(s) out of {{count}} total')]) ?></p>
    </div>
</div>

