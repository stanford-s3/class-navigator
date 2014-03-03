<?php
/**
 *
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       app.View.Layouts
 * @since         CakePHP(tm) v 0.10.0.1076
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */

$cakeDescription = __d('home_title', 'Class Navigator');
?>
<!DOCTYPE html>
<html>
<head>
    <?php echo $this->Html->charset(); ?>
    <title>
        <?php echo $cakeDescription ?>:
        <?php echo $title_for_layout; ?>
    </title>
    <?php
        echo $this->Html->meta('icon');

        echo $this->Html->css('bootstrap.min');
        echo $this->Html->css('site');

        echo $this->fetch('meta');
        echo $this->fetch('css');
        echo $this->fetch('script');
    ?>
</head>
<body>

    <div class="navbar navbar-default navbar-fixed-top" role="navigation">
        <div class="container">
            <div class="navbar-header">
                <?php echo $this->Html->link($cakeDescription, array('action' => 'index'), array('class' => 'navbar-brand')); ?>
            </div>

            <div class="collapse navbar-collapse navbar-ex1-collapse">
                <ul class="nav navbar-nav">
                    <li><?php echo $this->Html->link('Classes', array('controller' => 'classes', 'action' => 'index')); ?></li>
                </ul>
            </div>
        </div>
    </div>

    <div class="container">
            <?php echo $this->Session->flash(); ?>

            <?php echo $this->fetch('content'); ?>
    </div>

    <?php
    echo $this->Html->script('jquery.min');
    echo $this->Html->script('bootstrap.min');
    ?>

</body>
</html>
