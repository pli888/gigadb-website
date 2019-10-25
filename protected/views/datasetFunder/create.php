<div class="container" id="create_dataset_funder_page">
    <section class="page-title-section">
        <div class="page-title">
            <ol class="breadcrumb pull-right">
                <li><a href="/">Home</a></li>
                <li><a href="/">Dataset Funder</a></li>
                <li class="active">Create</li>
            </ol>
            <h4>Create Dataset Funder</h4>
        </div>
    </section>
    <section>
        <a href="/datasetFunder/admin">Back</a>

        <?php echo $this->renderPartial('_form', array('model'=>$model, 'datasets'=>$datasets, 'funders'=>$funders)); ?>
    </section>
</div>
