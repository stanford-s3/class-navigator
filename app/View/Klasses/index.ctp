<div class="klasses index">
	<h2 class="sub-header"><?php echo __('Classes'); ?></h2>
	<table class="table table-striped">
  <thead>
	<tr>
			<th><?php echo $this->Paginator->sort('name'); ?></th>
			<th><?php echo $this->Paginator->sort('description'); ?></th>
			<th><?php echo $this->Paginator->sort('units', 'Units'); ?></th>
			<th><?php echo $this->Paginator->sort('repeatable_for_credit'); ?></th>
			<th><?php echo $this->Paginator->sort('grading_style_id'); ?></th>
			<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
  </thead>
  <tbody>
	<?php foreach ($klasses as $klass): ?>
	<tr>
		<td><?php echo h($klass['Klass']['name']); ?>&nbsp;</td>
		<td><?php echo h($klass['Klass']['description']); ?>&nbsp;</td>
		<td><?php echo h($klass['Klass']['units']); ?>&nbsp;</td>
		<td><?php echo h($klass['Klass']['repeatable_for_credit'] ? __('Yes') : __('No')); ?>&nbsp;</td>
		<td>
			<?php echo h(__($klass['GradingStyle']['description'])); ?>
		</td>

		<td class="actions">
			<?php echo $this->Html->link(__('View'), array('action' => 'view', $klass['Klass']['id'])); ?>
			<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $klass['Klass']['id'])); ?>
			<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $klass['Klass']['id']), null, __('Are you sure you want to delete # %s?', $klass['Klass']['id'])); ?>
		</td>
	</tr>
<?php endforeach; ?>
  </tbody>
	</table>
  <?php echo $this->Paginator->pagination(array('ul' => 'pagination')); ?>
<!--	<p>
	<?php
	echo $this->Paginator->counter(array(
	'format' => __('Page {:page} of {:pages}, showing {:current} records out of {:count} total, starting on record {:start}, ending on {:end}')
	));
	?>	</p>-->
</div>
