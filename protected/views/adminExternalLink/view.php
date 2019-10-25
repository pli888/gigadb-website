<div class="container" id="view_external_link_page">
    <section class="page-title-section">
        <div class="page-title">
            <ol class="breadcrumb pull-right">
                <li><a href="/">Home</a></li>
                <li><a href="/">External Link</a></li>
                <li class="active">View</li>
            </ol>
            <h4>View ExternalLink #<?php echo $model->id; ?></h4>
        </div>
    </section>
    <section>
        <? if (Yii::app()->user->checkAccess('admin')) { ?>
        <div class="actionBar">
        [<?= CHtml::link('Manage External Links', array('admin')) ?>]
        </div>
        <? } ?>

        <?php $this->widget('zii.widgets.CDetailView', array(
            'data'=>$model,
            'attributes'=>array(
                'id',
                'dataset_id',
                'url',
                'external_link_type_id',
            ),
        )); ?>
    </section>
</div>
