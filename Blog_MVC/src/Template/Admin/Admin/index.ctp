<?= $this->Html->link('See All Users',
['controller' => 'users', 'action' => 'index'],
['class' => 'btn btn-success']); ?>
<div class="card text-white bg-primary mb-3" style="max-width: 20rem;">
  <div class="card-header">Last users</div>
  <div class="card-body">
  <?php if(!empty($users)) : ?>
  <?php foreach($users as $user) : ?>
    <p class="card-text"> <?= $user->username ?> </p>
  <?php  endforeach; ?>
  <?php endif; ?>
  </div>
</div>

<?= $this->Html->link('See All Posts',
['controller' => 'posts', 'action' => 'index'],
['class' => 'btn btn-success']); ?>
<div class="card text-white bg-primary mb-3" style="max-width: 20rem;">
  <div class="card-header">Last Posts</div>
  <div class="card-body">
  <?php if(!empty($posts)) : ?>
  <?php foreach($posts as $post) : ?>
    <p class="card-text"> <?= $post->title ?> </p>
  <?php  endforeach; ?>
  <?php endif; ?>
  </div>
</div>


<?= $this->Html->link('See All Comments',
['controller' => 'comments', 'action' => 'index'],
['class' => 'btn btn-success']); ?>
<div class="card text-white bg-primary mb-3" style="max-width: 20rem;">
  <div class="card-header">Last Comments</div>
  <div class="card-body">
  <?php if(!empty($comments)) : ?>
  <?php foreach($comments as $comment) : ?>
    <p class="card-text"> <?= $comment->content ?> </p>
  <?php  endforeach; ?>
  <?php endif; ?>
  </div>
</div>