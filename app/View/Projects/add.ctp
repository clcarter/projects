<div class="projects form">
<?php echo $this->Form->create('Project'); ?>
	<fieldset>
		<legend><?php echo __('Add Project from SharePoint'); ?></legend>
	<?php
		echo $this->Html->tag('a','Manual', array('onclick' => 'switchInput()', 'href' => '#', 'id'=>'switch'));
	?>
		
		<span id="urlSpan">
	<?php
		echo $this->Form->input('url', array('type' => 'url', 'id' => 'sharepointUrl')); 
	?>
		</span>
		<span id="manualSpan" style="display:none">
	<?php
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
		echo $this->Form->input('notes', array('type' => 'textarea'));
		?>
</span>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
	
</div>

<script type="text/javascript">
	function switchInput(){
		var url = document.getElementById('urlSpan');
		url.style.display = url.style.display == 'none' ? 'block' : 'none';
		
		var manual = document.getElementById('manualSpan');
		manual.style.display = manual.style.display == 'none' ? 'block' : 'none';
		
		var auto = document.getElementById('switch');
		auto.innerHTML = auto.innerHTML == 'Manual' ? 'Automatic' : 'Manual';
	}
</script>