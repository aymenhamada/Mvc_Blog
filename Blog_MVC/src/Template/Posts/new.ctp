<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Post $post
 * @var \App\Model\Entity\Comment $comment
 */
?>
<div class="posts form large-9 medium-8 columns content">
    <?= $this->Form->create($post) ?>
    <fieldset>
        <legend><?= __('Add Post') ?></legend>
        <?php
            echo $this->Form->control('title');
            echo $this->Form->control('tags');
            echo $this->Form->input('content', ['type' => 'textarea', 'required' => false]);
        ?>
    </fieldset>
    <?= $this->Html->link('Back', ['action' => 'index'], ['class' => 'btn btn-danger']);?>
    <?= $this->Form->button(__('Add Post'), ['class' => 'btn btn-info']) ?>
    <?= $this->Form->end() ?>
</div>
