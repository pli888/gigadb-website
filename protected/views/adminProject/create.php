<div class="container" id="create_project_page">
    <section class="page-title-section">
        <div class="page-title">
            <ol class="breadcrumb pull-right">
                <li><a href="/">Home</a></li>
                <li><a href="/">Projects</a></li>
                <li class="active">Create</li>
            </ol>
            <h4>Create Project</h4>
        </div>
    </section>
    <section>
        <? if (Yii::app()->user->checkAccess('admin')) { ?>
            <div class="actionBar">
                [<?= CHtml::link('Manage Projects', array('admin')) ?>]
            </div>
        <? } ?>
    </section>
    <section
        <?php echo $this->renderPartial('_form', array('model'=>$model)); ?>
    </section>
</div>

