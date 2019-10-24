<?php
$this->breadcrumbs=array(
	'File Types'=>array('index'),
	$model->name,
);

$this->menu=array(
	array('label'=>'List FileType', 'url'=>array('index')),
	array('label'=>'Create FileType', 'url'=>array('create')),
	array('label'=>'Update FileType', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete FileType', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage FileType', 'url'=>array('admin')),
);
?>

<div class="container" id="view_file_type_page">
    <section class="page-title-section">
        <div class="page-title">
            <ol class="breadcrumb pull-right">
                <li><a href="/">Home</a></li>
                <li><a href="/">File Type</a></li>
                <li class="active">View</li>
            </ol>
            <h4>View FileType #<?php echo $model->id; ?></h4>
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

