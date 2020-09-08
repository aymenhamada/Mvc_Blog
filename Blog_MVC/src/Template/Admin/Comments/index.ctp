<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Post[]|\Cake\Collection\CollectionInterface $posts
 */
?>
<h1>View All Comments</h1>
<table class="table table-hover">
  <thead>
    <tr>
      <th scope="col">Comments</th>
      <th scope="col">Author</th>
      <th scope="col">Post</th>
      <th scope="col">content</th>
      <th scope="col">created</th>
      <th scope="col">Action</th>
    </tr>
  </thead>
  <tbody>
  <?php if(!empty($comments)):?>
  <?php foreach($comments as $comment):?>
    <tr>
      <th scope="row"> <?= $comment->id ?></th>
      <td><?= $comment->has('user') ? h($comment->user->username) : 'undefined' ?></td>
      <td><?= $comment->has('post') ? h($comment->post->title) : 'undefined' ?></td>
      <td><?= h($comment->content) ?></td>
      <td><?= h($comment->created) ?></td>
      <td><?= $this->Html->link(__(
      'Delete'),
      ['action' => 'delete', $comment->id],
      ['class' => 'btn btn-danger']);?></td>
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

