<div class="container" id="create_dataset_funder_page">
    <section class="page-title-section">
        <div class="page-title">
            <ol class="breadcrumb pull-right">
                <li><a href="/">Home</a></li>
                <li><a href="/">Dataset Funder</a></li>
                <li class="active">Create</li>
            </ol>
            <h4>View Dataset Funder #<?php echo $model->id; ?></h4>
        </div>
    </section>
    <section>
        <a href="/datasetFunder/admin">Back</a>
    </section>
    <section>
        <?php $this->widget('zii.widgets.CDetailView', array(
            'data'=>$model,
            'attributes'=>array(
                'id',
                array(
                    'label' => 'Dataset',
                    'value' => $model->dataset->identifier,
                ),
                array(
                    'label' => 'Funder',
                    'value' => $model->funder->primary_name_display,
                ),
                'grant_award',
                'awardee',
                'comments',
            ),
        )); ?>
    </section>
</div>



