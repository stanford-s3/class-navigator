<div class="klasses view">
<h2>
    <?php echo h($klass['Klass']['name']); ?>
    <small>(<?php echo implode(', ', $code_names); ?>)</small>
</h2>
<div class="row">
    <div class="well col-md-4">
        <?php if ($loggedIn): ?>
            <?php foreach ($past_enrollments as $past_enrollment): ?>
                <div class="row text-center">
                    <?php echo __('You took this class in <strong>%s</strong>.', $past_enrollment); ?>
                </div>
            <?php endforeach; ?>
            <div class="row row-btns">
                <div class="col-md-12">
                    <?php
                        if ($enrolled_this_quarter) {
                            echo $this->Html->link(__("Drop this class"),
                                array('action' => 'remove_self', $klass['Klass']['id']),
                                array('class' => 'btn btn-danger btn-block block-center'));
                        } else {
                            echo $this->Html->link(__("I'm in this class!"),
                                array('action' => 'add_self', $klass['Klass']['id']),
                                array('class' => 'btn btn-primary btn-block block-center'));
                        }
                    ?>
                </div>
            </div>
        <?php endif; ?>
        <div class="row">
            <div class="col-md-6"><strong><?php echo __('Units'); ?></strong></div>
            <div class="col-md-6"><?php echo h($klass['Klass']['units']); ?></div>
        </div>
        <div class="row">
            <div class="col-md-6"><strong><?php echo __('Repeatable for credit'); ?></strong></div>
            <div class="col-md-6"><?php echo h($klass['Klass']['repeatable_for_credit'] ? __('Yes') : __('No')); ?></div>
        </div>
        <div class="row">
            <div class="col-md-6"><strong><?php echo __('Grading style'); ?></strong></div>
            <div class="col-md-6"><?php echo h($klass['GradingStyle']['description']); ?></div>
        </div>
    </div>
    <div class="col-md-8">
        <p><?php echo h($klass['Klass']['description']); ?></p>
    </div>
</div>
</div>
<!--<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Klass'), array('action' => 'edit', $klass['Klass']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Klass'), array('action' => 'delete', $klass['Klass']['id']), null, __('Are you sure you want to delete # %s?', $klass['Klass']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Klasses'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Klass'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Grading Styles'), array('controller' => 'grading_styles', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Grading Style'), array('controller' => 'grading_styles', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Klass Codes'), array('controller' => 'klass_codes', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Klass Code'), array('controller' => 'klass_codes', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Users'), array('controller' => 'users', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New User'), array('controller' => 'users', 'action' => 'add')); ?> </li>
	</ul>
</div>-->

<h2>Students</h2>

<div class="well row">
    <div class="col-md-7">
        <h3>Current students</h3>

        <ul>
            <?php foreach ($students_current as $student): ?>
                <li><?php echo h($student['User']['username'] . ' (' . $student['quarter_label'] . ')'); ?></li>
            <?php endforeach; ?>
        </ul>
    </div>
    <div class="col-md-5">
        <h3>Past students</h3>

        <ul>
            <?php foreach ($students_past as $student): ?>
                <li><?php echo h($student['User']['username'] . ' (' . $student['quarter_label'] . ')'); ?></li>
            <?php endforeach; ?>
        </ul>
    </div>
</div>