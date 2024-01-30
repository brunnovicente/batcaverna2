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
 * @var \App\View\AppView $this
 */

$cakeDescription = 'BatCaverna';

?>
<!DOCTYPE html>
<html>
<head>
    <?= $this->Html->charset() ?>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>
        <?= $cakeDescription ?>:
        <?= $this->fetch('title') ?>
    </title>
    <?= $this->Html->meta('icon') ?>

    <?= $this->Html->css(['bootstrap.min', 'all.min','croppie.min']) ?>

    <?= $this->fetch('meta') ?>
    <?= $this->fetch('css') ?>
    <?= $this->Html->script('bootstrap.bundle.min.js')?>
    <?= $this->Html->script('croppie.min.js')?>
    <?= $this->Html->script('preview.js')?>
    <?= $this->fetch('script') ?>

</head>
<body>
<div class="container-fluid m-0 p-0">

    <nav class="navbar bg-body-tertiary">
        <div class="container-fluid">
            <span>
                <?= $this->Html->image('batman.png', ['width'=>'30', 'class'=>'d-inline-block align-text-top']) ?>
            <a class="navbar-brand" href="#">
                BatCaverna
            </a>
            </span>
            <?= $this->Html->link('<i class="fa-solid fa-key"></i> Login', ['controller'=>'principal','action'=>'index'], ['class'=>'btn btn-outline-dark', 'escape'=>false]) ?>
        </div>
    </nav>

    <main class="main">
        <div class="container-fluid">
            <?= $this->Flash->render() ?>
            <?= $this->fetch('content') ?>
        </div>
    </main>
    <footer>
    </footer>
</div>
</body>
</html>
