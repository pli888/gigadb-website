<div class="container" id="create_author_page">
    <section class="page-title-section">
        <div class="page-title">
            <ol class="breadcrumb pull-right">
                <li><a href="/">Home</a></li>
                <li><a href="/">Author</a></li>
                <li class="active">Create</li>
            </ol>
            <h4>Create Author</h4>
            <? if (Yii::app()->user->checkAccess('admin')) { ?>
                <div class="actionBar">
                    [<?= CHtml::link('Manage Authors', array('admin')) ?>]
                </div>
            <? } ?>
        </div>
    </section>
    <section>
        <?php echo $this->renderPartial('_form', array('model'=>$model)); ?>
    </section>
</div>
