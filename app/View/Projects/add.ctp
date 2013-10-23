<div class="projects form">
<?php echo $this->Form->create('Project'); ?>
	<fieldset>
		<legend><?php echo __('Add Project from SharePoint'); ?></legend>
	<?php
		/*echo $this->Form->input('requestor');
		echo $this->Form->input('request_date');
		echo $this->Form->input('deadline');
		echo $this->Form->input('priority');
		echo $this->Form->input('program');
		echo $this->Form->input('type');
		echo $this->Form->input('title');
		echo $this->Form->input('description');
		echo $this->Form->input('status');
		echo $this->Form->input('completetion_date');
		echo $this->Form->input('notes');*/
		
		echo $this->Form->input('url');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
	
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('List Projects'), array('action' => 'index')); ?></li>
		<li><?php echo $this->Html->link(__('List Attachments'), array('controller' => 'attachments', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Attachment'), array('controller' => 'attachments', 'action' => 'add')); ?> </li>
	</ul>
</div>
