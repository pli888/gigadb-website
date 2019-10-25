<div class="container" id="view_funder_page">
    <section class="page-title-section">
        <div class="page-title">
            <ol class="breadcrumb pull-right">
                <li><a href="/">Home</a></li>
                <li><a href="/">Funder</a></li>
                <li class="active">View</li>
            </ol>
            <h4>View Funder #<?php echo $model->id; ?></h4>
        </div>
    </section>
    <section>
        <a href="/funder/admin">Back</a>

        <?php $this->widget('zii.widgets.CDetailView', array(
            'data'=>$model,
            'attributes'=>array(
                'id',
                'uri',
                'primary_name_display',
                'country',
            ),
        )); ?>
    </section>
</div>

