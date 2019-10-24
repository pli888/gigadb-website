<?php
$this->breadcrumbs=array(
	'File Types'=>array('index'),
	$model->name=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List FileType', 'url'=>array('index')),
	array('label'=>'Create FileType', 'url'=>array('create')),
	array('label'=>'View FileType', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage FileType', 'url'=>array('admin')),
);
?>

<div class="container" id="update_file_type_page">
    <section class="page-title-section">
        <div class="page-title">
            <ol class="breadcrumb pull-right">
                <li><a href="/">Home</a></li>
                <li><a href="/">File Type</a></li>
                <li class="active">Update</li>
            </ol>
            <h4>Update FileType <?php echo $model->id; ?></h4>
        </div>
    </section>
    <section>
        <?php echo $this->renderPartial('_form', array('model'=>$model)); ?>
    </section>
</div>
