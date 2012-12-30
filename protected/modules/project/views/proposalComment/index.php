<?php
$this->breadcrumbs=array(
	'Proposal Comments',
);

$this->menu=array(
	array('label'=>'Create ProposalComment', 'url'=>array('create', 'pid' => $proposal->id)),
	array('label'=>'Manage ProposalComment', 'url'=>array('admin', 'pid' => $proposal->id)),
);
?>

<h1>Proposal Comments</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
