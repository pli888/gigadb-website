<?php
$this->breadcrumbs=array(
	'Rss Messages'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List RssMessage', 'url'=>array('index')),
	array('label'=>'Create RssMessage', 'url'=>array('create')),
	array('label'=>'View RssMessage', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage RssMessage', 'url'=>array('admin')),
);
?>

<div class="container" id="update_rss_message_page">
    <section class="page-title-section">
        <div class="page-title">
            <ol class="breadcrumb pull-right">
                <li><a href="/">Home</a></li>
                <li><a href="/">RSS Message</a></li>
                <li class="active">Update</li>
            </ol>
            <h4>Update RssMessage <?php echo $model->id; ?></h4>
        </div>
    </section>
    <section>
        <?php echo $this->renderPartial('_form', array('model'=>$model)); ?>
    </section>
</div>
