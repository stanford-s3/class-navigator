<div class="klasses form">
<?php echo $this->Form->create('Klass'); ?>
	<fieldset>
		<legend><?php echo __('Edit Klass'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('name');
		echo $this->Form->input('description');
		echo $this->Form->input('units_min');
		echo $this->Form->input('units_max');
		echo $this->Form->input('repeatable_for_credit');
		echo $this->Form->input('grading_style_id');
		echo $this->Form->input('User');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $this->Form->value('Klass.id')), null, __('Are you sure you want to delete # %s?', $this->Form->value('Klass.id'))); ?></li>
		<li><?php echo $this->Html->link(__('List Klasses'), array('action' => 'index')); ?></li>
		<li><?php echo $this->Html->link(__('List Grading Styles'), array('controller' => 'grading_styles', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Grading Style'), array('controller' => 'grading_styles', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Klass Codes'), array('controller' => 'klass_codes', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Klass Code'), array('controller' => 'klass_codes', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Users'), array('controller' => 'users', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New User'), array('controller' => 'users', 'action' => 'add')); ?> </li>
	</ul>
</div>
