<div class="users form">
<?php echo $this->Form->create('User', array(
      'inputDefaults' => array(
          'div' => 'form-group',
          'label' => array('class' => 'col col-md-3 control-label'),
          'wrapInput' => 'col col-md-9',
          'class' => 'form-control'
      ),
      'class' => 'well form-horizontal'
)); ?>
	<?php
		echo $this->Form->input('username');
		echo $this->Form->input('password');
	?>

  <div class="form-group">
      <?php echo $this->Form->submit('Sign up', array(
          'div' => 'col col-md-9 col-md-offset-3',
          'class' => 'btn btn-default'
      )); ?>
  </div>
<?php echo $this->Form->end(); ?>
</div>
