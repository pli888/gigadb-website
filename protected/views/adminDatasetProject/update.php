<?php
$this->breadcrumbs=array(
	'Dataset Projects'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List DatasetProject', 'url'=>array('index')),
	array('label'=>'Create DatasetProject', 'url'=>array('create')),
	array('label'=>'View DatasetProject', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage DatasetProject', 'url'=>array('admin')),
);
?>

<div class="container" id="update_dataset_projects_page">
<section class="page-title-section">
    <div class="page-title">
        <ol class="breadcrumb pull-right">
            <li><a href="/">Home</a></li>
            <li><a href="/">Dataset - Projects</a></li>
            <li class="active">Update</li>
        </ol>
        <h4>Update DatasetProject <?php echo $model->id; ?></h4>
    </div>
</section>
<section>
<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>
</section>
</div>
