<?php
$this->breadcrumbs=array(
	'File Types'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List FileType', 'url'=>array('index')),
	array('label'=>'Manage FileType', 'url'=>array('admin')),
);
?>

<div class="container" id="create_file_type_page">
    <section class="page-title-section">
        <div class="page-title">
            <ol class="breadcrumb pull-right">
                <li><a href="/">Home</a></li>
                <li><a href="/">File Type</a></li>
                <li class="active">Create</li>
            </ol>
            <h4>Create FileType</h4>
        </div>
    </section>
    <section>
        <?php echo $this->renderPartial('_form', array('model'=>$model)); ?>
    </section>
</div>
