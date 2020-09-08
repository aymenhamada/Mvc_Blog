<h1> The most popular posts of the site ! </h1>
<?php if(!empty($popularBlog)) : ?>
<?php foreach($popularBlog as $post): ?>
<h1> Author : <?= $post->user->username ?> </h1>
<p> <?= 'Title : '.$post->title ?> </p>
<p> <?= 'Created: '.$post->created ?> </p>
<p> <?= 'Tags: '.$post->tags ?> </p>
<p> <?= substr($post->content, 0, 100000) ?> </p><br>
<?php if($post->has('comments')) :?>
<?= 'Comments : '.count($post->comments) ?>
<?php endif; ?>
<br> <?= $this->Html->link(__('View this post'),
        ['controller' => 'Posts', 'action' => 'view', $post->id],
        ['class' => 'btn btn-info']);?>
<?php endforeach; ?>
<?php endif; ?>

<?php if(!empty($mostActive)) : ?>
<?php foreach($mostActive as $user): ?>
<h1> The most Active blogger is </h1> <p> <?= $user->user->name." With ".$max." Decent Posts, Congratulation !" ?> </p>
<?php break; ?>
<?php endforeach; ?>
<?php endif; ?>