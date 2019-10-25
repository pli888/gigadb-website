<?php
$this->breadcrumbs=array(
	'Publishers'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Publisher', 'url'=>array('index')),
	array('label'=>'Manage Publisher', 'url'=>array('admin')),
);
?>

<div class="container" id="create_publisher_page">
    <section class="page-title-section">
        <div class="page-title">
            <ol class="breadcrumb pull-right">
                <li><a href="/">Home</a></li>
                <li><a href="/">Publisher</a></li>
                <li class="active">Create</li>
            </ol>
            <h4>Create Publisher</h4>
        </div>
    </section>
    <section>
        <?php echo $this->renderPartial('_form', array('model'=>$model)); ?>
    </section>
</div>
