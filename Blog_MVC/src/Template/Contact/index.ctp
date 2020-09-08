<?= $this->Form->create('Contact', ['url' => '/contact/sendemail']); ?>
<?= $this->Form->control('about', ['required' => true]); ?>
<?= $this->Form->control('content', ['type' => 'textarea'], ['required' => true]) ?>
<?= $this->Form->button(__('Send message to admin'), ['class' => 'btn btn-info']) ?>
<?= $this->Form->end();