<?php
$this->breadcrumbs=array(
	'External Links'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List ExternalLink', 'url'=>array('index')),
	array('label'=>'Create ExternalLink', 'url'=>array('create')),
	array('label'=>'View ExternalLink', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage ExternalLink', 'url'=>array('admin')),
);
?>

<div class="container" id="update_external_link_page">
    <section class="page-title-section">
        <div class="page-title">
            <ol class="breadcrumb pull-right">
                <li><a href="/">Home</a></li>
                <li><a href="/">External Link</a></li>
                <li class="active">Update</li>
            </ol>
            <h4>Update ExternalLink <?php echo $model->id; ?></h4>
        </div>
    </section>
    <section>
        <?php echo $this->renderPartial('_form', array('model'=>$model)); ?>
    </section>
</div>
