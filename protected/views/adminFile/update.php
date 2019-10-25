<?php
$this->breadcrumbs=array(
    'Files'=>array('index'),
    $model->name=>array('view','id'=>$model->id),
    'Update',
);

$this->menu=array(
    array('label'=>'List File', 'url'=>array('index')),
    array('label'=>'Create File', 'url'=>array('create')),
    array('label'=>'View File', 'url'=>array('view', 'id'=>$model->id)),
    array('label'=>'Manage File', 'url'=>array('admin')),
);
?>

<div class="container" id="update_file_page">
    <section class="page-title-section">
        <div class="page-title">
            <ol class="breadcrumb pull-right">
                <li><a href="/">Home</a></li>
                <li><a href="/">File</a></li>
                <li class="active">Update</li>
            </ol>
            <h4>Update File <?php echo $model->id; ?></h4>
        </div>
    </section>
    <section>
        <?php echo $this->renderPartial('_form', array('model'=>$model, 'attribute'=>$attribute)); ?>
    </section>
</div>
