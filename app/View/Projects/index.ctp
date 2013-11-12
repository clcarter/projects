<?php 
echo $this->element('scripts');
echo $this->element('header'); ?>
<div class="projects index">
	<h2><?php echo __('Projects'); ?></h2>
	<table cellpadding="0" cellspacing="0">
	<tr> 
			<th><?php echo $this->Paginator->sort('priority'); ?></th>
			<th><?php echo $this->Paginator->sort('requestor'); ?></th>
			<th><?php echo $this->Paginator->sort('title'); ?></th>
			<th><?php echo $this->Paginator->sort('status'); ?></th>
			<th><?php echo $this->Paginator->sort('deadline'); ?></th>
			<th><?php echo $this->Paginator->sort('completetion_date'); ?></th>
			<!--th><?php /* echo $this->Paginator->sort('notes'); ?></th>
			<th><?php echo $this->Paginator->sort('created'); ?></th>
			<th><?php echo $this->Paginator->sort('modified');*/ ?></th-->
			<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php foreach ($projects as $project): ?>
	<tr onclick="viewProject(<?php print $project['Project']['id']; ?>)">
		<td><?php echo h($project['Project']['priority']); ?>&nbsp;</td>
		<td><?php echo h($project['Project']['requestor']); ?>&nbsp;</td>
		<td><?php echo h($project['Project']['title']); ?>&nbsp;</td>
		<td><?php echo h($project['Project']['status']); ?>&nbsp;</td>
		<td><?php echo h($project['Project']['deadline']); ?>&nbsp;</td>
		<td><?php echo h($project['Project']['completetion_date']); ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View'), array('action' => 'view', $project['Project']['id'])); ?>
			<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $project['Project']['id'])); ?>
			<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $project['Project']['id']), null, __('Are you sure you want to delete # %s?', $project['Project']['id'])); ?>
		</td>
	</tr>
<?php endforeach; ?>
	</table>
	<p>
	<?php
	echo $this->Paginator->counter(array(
	'format' => __('Page {:page} of {:pages}, showing {:current} records out of {:count} total, starting on record {:start}, ending on {:end}')
	));
	?>	</p>
	<div class="paging">
	<?php
		echo $this->Paginator->prev('< ' . __('previous'), array(), null, array('class' => 'prev disabled'));
		echo $this->Paginator->numbers(array('separator' => ''));
		echo $this->Paginator->next(__('next') . ' >', array(), null, array('class' => 'next disabled'));
	?>
	</div>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->tag('a','New Project', array('href' => '#','onclick' => "newProject()")); ?></li>
		<li><?php echo $this->Html->link(__('List Attachments'), array('controller' => 'attachments', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Attachment'), array('controller' => 'attachments', 'action' => 'add')); ?> </li>
	</ul>
</div>

<div class="dialog" id='dialog-message'></div>

<script type="text/javascript">
	
	function viewProject(id){
		var width = $(window).width()*0.6;
		$('#dialog-message').load('/projects/view/'+id).dialog({
      modal: true,
		width: width,
		position:['middle', 'top'],
      buttons: {
        Edit: function() {
          $('#dialog-message').load('/projects/edit/'+id);
        },
		Exit: function() {
          $( this ).dialog( "close" );
        }
      }
    }).dialog("open");
}

function newProject(){
	var width = $(window).width()*0.6;
	$('#dialog-message').load('/projects/add').dialog({
		width: width,
		position:['middle', 'top']
	}).dialog("open");
}

</script>