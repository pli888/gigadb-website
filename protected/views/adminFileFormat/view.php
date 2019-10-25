<?php
$this->breadcrumbs=array(
	'File Formats'=>array('index'),
	$model->name,
);

$this->menu=array(
	array('label'=>'List FileFormat', 'url'=>array('index')),
	array('label'=>'Create FileFormat', 'url'=>array('create')),
	array('label'=>'Update FileFormat', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete FileFormat', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage FileFormat', 'url'=>array('admin')),
);
?>

<div class="container" id="view_file_format_page">
    <section class="page-title-section">
        <div class="page-title">
            <ol class="breadcrumb pull-right">
                <li><a href="/">Home</a></li>
                <li><a href="/">File Format</a></li>
                <li class="active">View</li>
            </ol>
            <h4>View FileFormat #<?php echo $model->id; ?></h4>
        </div>
    </section>
    <section>
        <?php $this->widget('zii.widgets.CDetailView', array(
            'data'=>$model,
            'attributes'=>array(
                'id',
                'name',
                'description',
            ),
        )); ?>
    </section>
</div>
