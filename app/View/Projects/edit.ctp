<div class="projects form">
<?php echo $this->Form->create('Project'); ?>
	<fieldset>
		<legend><?php echo __('Edit Project'); ?></legend>
	<?php
		echo $this->Form->input('id', array('type' => 'hidden'));
		echo $this->Form->input('requestor');
		echo $this->Form->input('request_date');
		echo $this->Form->input('deadline');
		echo $this->Form->input('priority');
		echo $this->Form->input('program');
		echo $this->Form->input('type');
		echo $this->Form->input('title');
		echo $this->Form->input('description', array('type' => 'textarea'));
		echo $this->Form->input('status');
		echo $this->Form->input('completetion_date');
		echo $this->Form->input('notes');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>