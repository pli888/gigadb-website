<div class="container" id="create_datasetauthor_page">
    <section class="page-title-section">
        <div class="page-title">
            <ol class="breadcrumb pull-right">
                <li><a href="/">Home</a></li>
                <li><a href="/">Dataset Author</a></li>
                <li class="active">Create</li>
            </ol>
            <h4>Create Dataset - Author</h4>
        </div>
    </section>
    <section>
        <?php echo $this->renderPartial('_form', array('model'=>$model)); ?>    </section>
</div>

<?php
$this->breadcrumbs=array(
	'Dataset Authors'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List DatasetAuthor', 'url'=>array('index')),
	array('label'=>'Manage DatasetAuthor', 'url'=>array('admin')),
);
?>
