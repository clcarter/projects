<div class="projects view">
<?php
App::uses('UrlLinker','Model');
$urlMaker = new UrlLinker();
?>
	<dl style="width:100%">
		<dt><?php echo __('Requestor'); ?></dt>
		<dd>
			<?php echo h($project['Project']['requestor']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Request Date'); ?></dt>
		<dd>
			<?php echo h($project['Project']['request_date']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Deadline'); ?></dt>
		<dd>
			<?php echo h($project['Project']['deadline']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Priority'); ?></dt>
		<dd>
			<?php echo h($project['Project']['priority']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Program'); ?></dt>
		<dd>
			<?php echo h($project['Project']['program']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Type'); ?></dt>
		<dd>
			<?php echo h($project['Project']['type']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Title'); ?></dt>
		<dd>
			<?php echo h($project['Project']['title']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Description'); ?></dt>
		<dd>
			<?php
			$markup = $urlMaker->htmlEscapeAndLinkUrls($project['Project']['description']);
			echo $markup; ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Status'); ?></dt>
		<dd>
			<?php echo h($project['Project']['status']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Completetion Date'); ?></dt>
		<dd>
			<?php echo h($project['Project']['completetion_date']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Notes'); ?></dt>
		<dd>
			<?php $markup = $urlMaker->htmlEscapeAndLinkUrls($project['Project']['notes']);
			echo $markup; ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Created'); ?></dt>
		<dd>
			<?php echo h($project['Project']['created']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Modified'); ?></dt>
		<dd>
			<?php echo h($project['Project']['modified']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<!--div class="actions">
	<h3><?php /* echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Project'), array('action' => 'edit', $project['Project']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Project'), array('action' => 'delete', $project['Project']['id']), null, __('Are you sure you want to delete # %s?', $project['Project']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Projects'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Project'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Attachments'), array('controller' => 'attachments', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Attachment'), array('controller' => 'attachments', 'action' => 'add'));*/ ?> </li>
	</ul>
</div-->
<div class="related">
	<h3><?php echo __('Attachments'); ?></h3>
	<?php if (!empty($project['Attachment'])): ?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php echo __('Url'); ?></th>
		<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php foreach ($project['Attachment'] as $attachment): ?>
		<tr>
			<td><a href="<?php echo $attachment['url']; ?>"><?php echo preg_replace('/^.*\/(.*)$/','\1',$attachment['url']); ?></a></td>
			<td class="actions">
				<?php /* echo $this->Html->link(__('View'), array('controller' => 'attachments', 'action' => 'view', $attachment['id']));*/ ?>
				<?php echo $this->Html->link(__('Edit'), array('controller' => 'attachments', 'action' => 'edit', $attachment['id'])); ?>
				<?php echo $this->Form->postLink(__('Delete'), array('controller' => 'attachments', 'action' => 'delete', $attachment['id']), null, __('Are you sure you want to delete # %s?', $attachment['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New Attachment'), array('controller' => 'attachments', 'action' => 'add')); ?> </li>
		</ul>
	</div>
</div>

<?php

?>