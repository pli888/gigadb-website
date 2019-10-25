<div class="container" id="view_attribute_page">
    <section class="page-title-section">
        <div class="page-title">
            <ol class="breadcrumb pull-right">
                <li><a href="/">Home</a></li>
                <li><a href="/">Attribute</a></li>
                <li class="active">View</li>
            </ol>
            <h4>View Attribute #<?php echo $model->id; ?></h4>
        </div>
    </section>
    <section>
        <a href="/attribute/admin">Back</a>

        <?php $this->widget('zii.widgets.CDetailView', array(
            'data'=>$model,
            'attributes'=>array(
                'id',
                'attribute_name',
                'definition',
                'model',
                'structured_comment_name',
                'value_syntax',
                'allowed_units',
                'occurance',
                'ontology_link',
                'note',
            ),
        )); ?>
    </section>
</div>
