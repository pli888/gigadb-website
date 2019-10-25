<?php
$this->breadcrumbs=array(
	'File Formats'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List FileFormat', 'url'=>array('index')),
	array('label'=>'Manage FileFormat', 'url'=>array('admin')),
);
?>

<div class="container" id="create_file_format_page">
    <section class="page-title-section">
        <div class="page-title">
            <ol class="breadcrumb pull-right">
                <li><a href="/">Home</a></li>
                <li><a href="/">File Format</a></li>
                <li class="active">Create</li>
            </ol>
            <h4>Create FileFormat</h4>
        </div>
    </section>
    <section>
        <?php echo $this->renderPartial('_form', array('model'=>$model)); ?>
    </section>
</div>
