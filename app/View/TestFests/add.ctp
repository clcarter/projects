<div class="testfests form">
<?php echo $this->Form->create('TestFest', array('type' =>'file')); ?>
	<fieldset>
		<legend><?php echo __('Add Test Fest'); ?></legend>
	<?php
		echo $this->Form->input('file', array('type' => 'file', 'onChange' => 'displayResult()', 'id' => 'fileInput'));
		echo $this->Form->input('filePath', array('id' => 'filePath', 'type' => 'hidden', 'value' => 'Z:/mta-test-fest/'));
		echo $this->Form->input('organization');
		echo $this->Form->input('location');
		echo $this->Form->input('eventDate');
		echo $this->Form->input('eventStartTime');
		echo $this->Form->input('eventEndTime');
		echo $this->Form->input('eventCost');
		echo $this->Form->input('isPreRequisiteRequired');
		echo $this->Form->input('isReviewIncluded');
		echo $this->Form->input('eventManager');
		echo $this->Form->input('eventSummary');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>

<script type="text/javascript">
function displayResult()
{
var x=document.getElementById("fileInput");
var x = x.value;
var y = document.getElementById("filePath").value;
alert(y);
}
</script>