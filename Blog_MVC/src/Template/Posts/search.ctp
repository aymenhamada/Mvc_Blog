<?php if(!empty($posts)) : ?>
<?php foreach($posts as $post) : ?>
<?php similar_text($keyword, $post->tags, $perc) ?>
<?php if($perc >= 50  || $post->title == $keyword) : ?>
<h1> Author : <?= $post->user->username ?> </h1>
<p> <?= 'Title : '.$this->Html->link(__($post->title), ['controller' => 'Posts', 'action' => 'view', $post->id, $keyword]) ?> </p>
<p> <?= 'Created: '.$post->created ?> </p>
<p> <?= 'Tags: '.$post->tags ?> </p>
<p> <?= substr($post->content, 0, 200) ?> </p><br>
<?php if($post->has('comments')) :?>
<?= 'Comments : '.count($post->comments) ?>
<?php endif; ?>
<br> <?= $this->Html->link(__('View this post'),
        ['controller' => 'Posts', 'action' => 'view', $post->id, $keyword],
        ['class' => 'btn btn-info']);?>
<?php endif; ?>
<?php endforeach; ?>
<?php else: ?>
<?= 'lol' ?>
<?php endif; ?>