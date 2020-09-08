<?php
/**
 * CakePHP(tm) : Rapid Development Framework (https://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 * @link          https://cakephp.org CakePHP(tm) Project
 * @since         0.10.0
 * @license       https://opensource.org/licenses/mit-license.php MIT License
 */
?>
<!DOCTYPE html>
<html>
<head>
    <?= $this->Html->charset() ?>
    <title>
        <?= $this->fetch('title') ?>
    </title>
    <?= $this->Html->meta('icon') ?>
    <?= $this->Html->css('bootstrap') ?>
    <?= $this->Html->css('style.css') ?>
    <?= $this->Html->css('base.css') ?>
    <?= $this->Html->css('error.css'); ?>

    <?= $this->fetch('meta') ?>
    <?= $this->fetch('css') ?>
    <?= $this->fetch('script') ?>
</head>
<body>
<nav class="top-bar expanded" data-topbar role="navigation">
        <ul class="title-area large-3 medium-4 columns">
            <li class="name">
                <h1><a href=""> My MVC Blog</a></h1>
            </li>
        </ul>
        <div class="top-bar-section">
        <ul class="title-area large-3 medium-4 columns">
            <li class="name">
                <?= $this->Html->link('Home','/', ['class' => 'btn btn-info']); ?>
            </li>
            <li class="name">
                <?= $this->Html->link('Logout',['controller' => 'Users', 'action' => 'logout'], ['class' => 'btn btn-info']); ?>
            </li>
            <li class="name">
                <?= $this->Html->link('Contact','/contact', ['class' => 'btn btn-info']); ?>
            </li>
            <li class="name">
                <?= $this->Html->link('Popular trends', ['controller' => 'posts', 'action' => 'popular']); ?>
            </li>
        </ul>
</nav>
        <div id="content">
            <?= $this->Flash->render() ?>

            <?= $this->fetch('content') ?>
        </div>
        <div id="footer">
            <?= $this->Html->link(__('Back'), 'javascript:history.back()') ?>
        </div>
    </div>
</body>
</html>
