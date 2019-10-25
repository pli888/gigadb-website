<div class="container" id="view_rss_message_page">
    <section class="page-title-section">
        <div class="page-title">
            <ol class="breadcrumb pull-right">
                <li><a href="/">Home</a></li>
                <li><a href="/">RSS Message</a></li>
                <li class="active">View</li>
            </ol>
            <h4>View RSS Message #<?php echo $model->id; ?></h4>
        </div>
    </section>
    <section>
        <? if (Yii::app()->user->checkAccess('admin')) { ?>
            <div class="actionBar">
                [<?= CHtml::link('Manage RSS Messages', array('admin')) ?>]
            </div>
        <? } ?>
    </section>
    <section>
        <?php $this->widget('zii.widgets.CDetailView', array(
            'data'=>$model,
            'attributes'=>array(
                'id',
                'message',
                'publication_date',
            ),
        )); ?>
    </section>
</div>










