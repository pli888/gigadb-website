<?php
$this->breadcrumbs=array(
	'Prefix'=>array('index'),
	$model->prefix=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List Prefix', 'url'=>array('index')),
	array('label'=>'Create Prefix', 'url'=>array('create')),
	array('label'=>'View Prefix', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage Prefix', 'url'=>array('admin')),
);

//$this->widget('zii.widgets.CBreadcrumbs', array(
//    'links'=>$this->breadcrumbs,
//));

?>

<div class="container" id="update_link_prefix_page">
    <section class="page-title-section">
        <div class="page-title">
            <ol class="breadcrumb pull-right">
                <li><a href="/">Home</a></li>
                <li><a href="/">Link Prefix</a></li>
                <li class="active">Update</li>
            </ol>
            <h4>Update Prefix <?php echo $model->id; ?></h4>
        </div>
    </section>
    <section>
        <?php echo $this->renderPartial('_form', array('model'=>$model)); ?>
    </section>
</div>
