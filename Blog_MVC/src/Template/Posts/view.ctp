<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Post $post
 */
?>
<div class="content-light">
<p> <?= 'Bloggeur : '?> <?= h($post->user->username) ?> </p>
  <div class="card-header"><?= 'Date : '.h($post->created) ?><br> <?= $post->updated ? 'Updated on '.$post->updated."<br>" : '' ?> <?= 'Tags : '.$post->tags ?></div>
  <div class="card-body">
    <h2 class="card-title"><?= 'Titre : '.h($post->title) ?> </h2>
    <p class="card-text"><?= 'Content : '.$post->content ?> </p>
  </div>
</div>
<legend>Commentaires</legend>
<?php if(!empty($commentary)) : ?>
<?php foreach($commentary as $comment) : ?>
<p> <?= 'Utilisateur : '.$comment->user->username ?> </p>
<p> <?= 'Commentaire : '.$comment->content ?><br> <?= 'Commenté le '.$comment->created ?> </p>
<?php endforeach; ?>
<?php endif; ?>
<div class="posts form large-9 medium-8 columns content">
    <?= $this->Form->create($newComment) ?>
    <fieldset>
        <legend><?= __('Add Comment') ?></legend>
        <?php
            echo $this->Form->control('content', ['type' => 'textarea']);
        ?>
    </fieldset>
    <?= $this->Html->link('Back', ['action' => 'index'], ['class' => 'btn btn-danger']);?>
    <?= $this->Form->button(__('Add a Comment'), ['class' => 'btn btn-info']) ?>
    <?= $this->Form->end() ?>
<script>
  const ligth = <?=  "'".$keyword."'" ?>;
  if(ligth.length > 0){
    const header = document.querySelector('.card-header');
    const title = document.querySelector('.card-title');
    const textHeader = header.innerHTML;
    const textTitle = title.innerHTML;
    const regex = new RegExp(ligth, 'gi');
    header.innerHTML = textHeader.replace(regex, `<span style="background-color:yellow;">${ligth}</span>`);
    title.innerHTML = textTitle.replace(regex, `<span style="background-color:yellow;">${ligth}</span>`);
  }
</script>