<?php
$this->breadcrumbs=array(
	'File Formats'=>array('index'),
	$model->name=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List FileFormat', 'url'=>array('index')),
	array('label'=>'Create FileFormat', 'url'=>array('create')),
	array('label'=>'View FileFormat', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage FileFormat', 'url'=>array('admin')),
);
?>

<div class="container" id="update_file_format_page">
    <section class="page-title-section">
        <div class="page-title">
            <ol class="breadcrumb pull-right">
                <li><a href="/">Home</a></li>
                <li><a href="/">File Format</a></li>
                <li class="active">Update</li>
            </ol>
            <h4>Update FileFormat <?php echo $model->id; ?></h4>
        </div>
    </section>
    <section>
        <?php echo $this->renderPartial('_form', array('model'=>$model)); ?>
    </section>
</div>
