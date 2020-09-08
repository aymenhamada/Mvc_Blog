<?php if(!empty($user)) : ?>
<?= h($user->role) == 'admin' ? "<div class='admin'>".$this->Html->link(__('Go to admin panel'),'/admin', ['class' => 'btn btn-info']).'</div>' : ''; ?>

<p class="presentation"><?= 'Welcome <span class="black">'.h($user->username)."</span>" ?></p>

<?= $this->Form->postLink('Delete your account',['controller' => 'Users', 'action' => 'delete', $user->id],
    ['class' => 'btn btn-danger']);?>
<div class="button-middle">
<?= $this->Html->link(
    'Discover the post',
    ['controller' => 'Posts', 'action' => 'index'],
    ['class' => 'btn btn-danger']);?>
</div>
<?php else :?>
<?= $this->Form->create('Log', ['action' => 'login']) ?>
  <fieldset>
    <legend>Connectez vous !</legend>

    <div class="form-group">
      <label for="userNick">Nom d'utilisateur</label>
      <input type="text" class="form-control" id="exampleInputPassword1" placeholder="Nom d'utilisateur" name="username" autocomplete="off">
    </div>
    <div class="form-group">
      <label for="userPass">Password</label>
      <input type="password" class="form-control" id="exampleInputPassword1" placeholder="Password" name="password">
    </div>
    <?= $this->Form->submit('Login', ['class' => 'btn btn-primary' ]) ?>
<?= $this->Form->end(); ?>
<p class="lead">Pas encore inscrit? inscrivez vous <?= $this->Html->link('Ici', '/inscription' ) ?> </p>
<?php endif; ?>