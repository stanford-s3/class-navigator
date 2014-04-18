<!DOCTYPE html>
<html>
<head>
    <?php echo $this->Html->charset(); ?>
    <title>
        <?php echo __('Class Navigator'); ?>:
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
                <?php echo $this->Html->link(__('Class Navigator'), array('action' => 'index'), array('class' => 'navbar-brand')); ?>
            </div>

            <div class="collapse navbar-collapse navbar-ex1-collapse">
                <ul class="nav navbar-nav">
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">Classes <strong class="caret"></strong></a>
                        <ul class="dropdown-menu">
                            <li><?php echo $this->Html->link('Explore classes', array('controller' => 'classes', 'action' => 'index')); ?></li>
                            <?php if (AuthComponent::user('id')): ?>
                                <li><?php echo $this->Html->link('My classes', array('controller' => 'classes', 'action' => 'my')); ?></li>
                            <?php endif; ?>
                        </ul>
                    </li>
                </ul>

                <ul class="nav navbar-nav navbar-right">
                  <li><?php if (AuthComponent::user('id'))
                            echo $this->Html->link('Log out', array('controller' => 'users', 'action' => 'logout'));
                    else echo $this->Html->link('Log in', array('controller' => 'users', 'action' => 'login')); ?></li>
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
