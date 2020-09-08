<?php
use Cake\Core\Configure;
use Cake\Error\Debugger;

$this->layout = 'error';
?>
<div id="notfound">
		<div class="notfound">
			<div class="notfound-404">
				<h1>Oops!</h1>
			</div>
			<h2>404 - Page not found</h2>
			<p>The page you are looking for might have been removed had its name changed or is temporarily unavailable.</p>
			<?= $this->Html->link('Go to homepage', ['controller' => 'users', 'action' => 'index']); ?>
		</div>
	</div>
