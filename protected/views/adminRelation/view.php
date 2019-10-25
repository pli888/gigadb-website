<?php
$this->breadcrumbs=array(
	'Relations'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List Relation', 'url'=>array('index')),
	array('label'=>'Create Relation', 'url'=>array('create')),
	array('label'=>'Update Relation', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete Relation', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Relation', 'url'=>array('admin')),
);
?>

<div class="container" id="view_relation_page">
    <section class="page-title-section">
        <div class="page-title">
            <ol class="breadcrumb pull-right">
                <li><a href="/">Home</a></li>
                <li><a href="/">Relation</a></li>
                <li class="active">View</li>
            </ol>
            <h4>View Relation #<?php echo $model->id; ?></h4>
        </div>
    </section>
    <section>
        <?php $this->widget('zii.widgets.CDetailView', array(
            'data'=>$model,
            'attributes'=>array(
                'id',
                'dataset_id',
                'related_doi',
                //'relationship',
            ),
        )); ?>
    </section>
</div>







