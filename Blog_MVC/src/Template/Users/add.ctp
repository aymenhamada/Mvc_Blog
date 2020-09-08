<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\User $user
 */
?>
  <fieldset>
    <legend>Inscription</legend>
    <?= $this->Form->create($user); ?>
     <div class="form-group">
      <label for="userNick">Nom d'utilisateur</label>
      <input type="text" class="form-control" id="userNick" aria-describedby="emailHelp" placeholder="Enter nickname" name="username">
    </div>
    <div class="form-group">
      <label for="userPass">Mot de passe</label>
      <input type="password" class="form-control" id="userPass" placeholder="Password" name="password">
    </div>
    <div class="form-group">
      <label for="userName">Nom</label>
      <input type="text" class="form-control" id="userName" aria-describedby="emailHelp" placeholder="Enter name" name="name">
    </div>
    <div class="form-group">
      <label for="userPrename">Prenom</label>
      <input type="text" class="form-control" id="userPrename" aria-describedby="emailHelp" placeholder="Enter prename" name="lastname">
    </div>
    <div class="form-group">
      <label for="userBirth">Date de naissance</label>
      <input type="date" class="form-control" id="userBirth" aria-describedby="emailHelp" placeholder="Enter birth" name="birthdate">
    </div>
    <div class="form-group">
      <label for="userEmail">Adresse email</label>
      <input type="email" class="form-control" id="userEmail" aria-describedby="emailHelp" placeholder="Enter email" name="email">
      <small id="emailHelp" class="form-text text-muted">Nous ne partagerons jamais votre email avec un tiers.</small>
    </div>
      <?= $this->Form->submit('Register', ['class' => 'btn btn-primary' ]) ?>
    <?= $this->Form->end();
