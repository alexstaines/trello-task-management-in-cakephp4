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
?>
<!DOCTYPE html>
<html>
<head>
    <?= $this->Html->charset() ?>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= $this->fetch('meta') ?>
    <?= $this->Html->meta('icon') ?>
    <title>
        <?= $this->fetch('title') ?>
    </title>

    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet">

    <!-- Bootstrap v5 Styles -->
    <?= $this->Html->css(['bootstrap/bootstrap.css']) ?>
    <?= $this->Html->css(['custom.css']) ?>
    <?= $this->fetch('css') ?>

</head>
<body>

    <main>
        <div class="container-fluid py-4">
            <?= $this->fetch('content') ?>
        </div>
    </main>

    <footer>
    </footer>

    <?= $this->Flash->render() ?>

    <!-- Bootstrap core JavaScript-->
    <?= $this->Html->script('/vendor/jquery/jquery-3.6.0.min.js') ?>
    <?= $this->Html->script('/js/bootstrap/bootstrap.min.js') ?>

    <?= $this->fetch('script') ?>
</body>


</html>
