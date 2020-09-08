<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Post[]|\Cake\Collection\CollectionInterface $posts
 */
?>
<h1>View All Posts</h1>
<?= $this->Html->link(
    'Add a post',
    ['controller' => 'Posts','action' => 'new'],
    ['class' => 'btn btn-info']);?>
<table class="table table-hover">
  <thead>
    <tr>
      <th scope="col">Posts</th>
      <th scope="col">Author</th>
      <th scope="col">title</th>
      <th scope="col">content</th>
      <th scope="col">tags</th>
      <th scope="col">Comments</th>
      <th scope="col">Action</th>
    </tr>
  </thead>
  <tbody>
  <?php if(!empty($billets)):?>
  <?php foreach($billets as $billet):?>
    <tr>
      <th scope="row"> <?= $billet->id ?></th>
      <td><?= $billet->has('user') ? h($billet->user->username) : 'undefined' ?></td>
      <td><?= h($billet->title) ?></td>
      <td><?= strlen($billet->content) > 25 ? substr($billet->content, 0, 25).$this->Html->link("...", ['action' => 'view', $billet->id]) : $billet->content ?></td>
      <td><?= h($billet->tags) ?></td>
      <td> <?= count($billet->comments) ?><br>
      <?= $this->Html->link('Commenter',
      ['controller' => 'Posts', 'action' => 'view', $billet->id]); ?></td>
      <td><?= $this->Html->link(
    'View',
    ['controller' => 'Posts','action' => 'view', $billet->id],
    ['class' => 'btn btn-info'])?>
        <?= $billet->user->id == $sessionId ? $this->Html->link(
    'Edit',
    ['controller' => 'Posts','action' => 'edit', $billet->id],
    ['class' => 'btn btn-success']) : '';?>
    <?= $billet->user->id == $sessionId ? $this->Html->link(__(
    'Delete'),
    ['controller' => 'Posts','action' => 'delete', $billet->id],
    ['class' => 'btn btn-danger']): '' ;?></td>
    </tr>
<?php endforeach;?>
<?php else:?>
    <tr>
      <th scope="row">Defafafault</th>
      <td>Column content</td>
      <td>Column content</td>
      <td>Column content</td>
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

