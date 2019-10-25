<div class="container" id="view_update_logs_page">
    <section class="page-title-section">
        <div class="page-title">
            <ol class="breadcrumb pull-right">
                <li><a href="/">Home</a></li>
                <li><a href="/">Update Logs</a></li>
                <li class="active">View</li>
            </ol>
            <h4>Modify Update Log <?php echo $model->id; ?></h4>
        </div>
    </section>
    <section>
        <? if (Yii::app()->user->checkAccess('admin')) { ?>
            <div class="actionBar">
                [<?= CHtml::link('Manage Update Logs', array('admin')) ?>]
            </div>
        <? } ?>

        <?php echo $this->renderPartial('_form', array('model'=>$model)); ?>
    </section>
</div>
