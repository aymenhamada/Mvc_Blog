<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\User $user
 */
?>
<div class="users form large-9 medium-8 columns content">
    <?= $this->Form->create($user) ?>
    <fieldset>
        <legend><?= __('Edit User') ?></legend>
        <?php
            echo $this->Form->control('username');
            echo $this->Form->control('name');
            echo $this->Form->control('lastname');
            echo $this->Form->control('birthdate');
            echo $this->Form->control('email');
            echo $this->Form->select('role', ['bloggeur' => 'Bloggeur simple','admin' =>  'Administrateur','Viewers' =>  'Viewers']);
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
