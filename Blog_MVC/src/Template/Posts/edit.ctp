<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Post $post
 */
?>
<div class="posts form large-9 medium-8 columns content">
    <?= $this->Form->create($post) ?>
    <fieldset>
        <legend><?= __('Edit Post') ?></legend>
        <?php
            echo $this->Form->control('title');
            echo $this->Form->control('tags');
            echo $this->Form->control('content', ['type' => 'textarea']);
        ?>
    </fieldset>
    <?= $this->Html->link('Back', ['action' => 'index'], ['class' => 'btn btn-danger']);?>
    <?= $this->Form->button(__('Edit Post'), ['class' => 'btn btn-info']) ?>
    <?= $this->Form->end() ?>
</div>
