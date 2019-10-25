<?php
$this->breadcrumbs=array(
	'Manuscripts'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List Manuscript', 'url'=>array('index')),
	array('label'=>'Create Manuscript', 'url'=>array('create')),
	array('label'=>'Update Manuscript', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete Manuscript', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Manuscript', 'url'=>array('admin')),
);
?>

<div class="container" id="view_manuscript_page">
    <section class="page-title-section">
        <div class="page-title">
            <ol class="breadcrumb pull-right">
                <li><a href="/">Home</a></li>
                <li><a href="/">Manuscript</a></li>
                <li class="active">View</li>
            </ol>
            <h4>View Manuscript #<?php echo $model->id; ?></h4>
        </div>
    </section>
    <section>
        <?php $this->widget('zii.widgets.CDetailView', array(
            'data'=>$model,
            'attributes'=>array(
                'id',
                'identifier',
                'pmid',
                'dataset_id',
            ),
        )); ?>
    </section>
</div>
