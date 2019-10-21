<div class="container" id="update_dataset_page">
    <section class="page-title-section">
        <div class="page-title">
            <ol class="breadcrumb pull-right">
                <li><a href="/">Home</a></li>
                <li><a href="/">Dataset</a></li>
                <li class="active">Update</li>
            </ol>
            <h4>Update Dataset <?php echo $model->identifier; ?></h4>
        </div>
    </section>
    <section>
        <?php echo $this->renderPartial('_form', array('model' => $model, 'dataset_id' => $dataset_id, 'curationlog' => $curationlog)); ?>
    </section>
</div>