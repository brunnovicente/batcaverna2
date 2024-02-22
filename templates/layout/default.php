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
$nome = explode(" ", $user['professor']->nome)[0];
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
    <?= $this->Html->meta('icon', '/img/batman.png', array('type' => 'icon')) ?>

    <?= $this->Html->css(['bootstrap.min', 'all.min','croppie.min']) ?>

    <?= $this->fetch('meta') ?>
    <?= $this->fetch('css') ?>
    <?= $this->Html->script('bootstrap.bundle.min.js')?>
    <?= $this->Html->script('croppie.min.js')?>
    <?= $this->Html->script('preview.js')?>
    <?= $this->Html->script('jquery-3.6.4.min.js')?>
    <?= $this->fetch('script') ?>

</head>
<body>
<div class="container-fluid m-0 p-0">

    <nav class="navbar bg-dark text-white">
        <div class="container-fluid">
            <a class="navbar-brand navbar-dark" href="/principal">Batcaverna</a>
            <div class="dropdown">
                <button class="btn btn-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                    <i class="fas fa-user-tie"></i> <?= $nome ?>
                </button>
                <ul class="dropdown-menu dropdown-menu-end">
                    <li><a class="dropdown-item" href="/users/view/<?= $user['id'] ?>"><i class="far fa-id-card"></i> Meus Dados</a></li>
                    <li><a class="dropdown-item" href="/users/alterarsenha"><i class="fas fa-key"></i> Alterar Senha</a></li>
                    <div class="dropdown-divider"></div>
                    <li>

                        <?= $this->Html->link('<i class="fas fa-sign-out-alt"></i> Sair',['controller'=>'users','action'=>'logout'] ,['class'=>'dropdown-item','escape'=>false]) ?>
                    </li>
                </ul>
            </div>
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
