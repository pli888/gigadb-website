<div class="container" id="create_author_page">
    <section class="page-title-section">
        <div class="page-title">
            <ol class="breadcrumb pull-right">
                <li><a href="/">Home</a></li>
                <li><a href="/">Author</a></li>
                <li class="active">Create</li>
            </ol>
            <h4>Update User <?=$model->id?></h4>
        </div>
    </section>
    <section>
        <? if (Yii::app()->user->checkAccess('admin')) { ?>
            <div class="actionBar">
                [<?= CHtml::link('Manage Users', array('admin')) ?>]
            </div>
        <? } ?>
    </section>
    <section>
        <?= $this->renderPartial('_form', array(
            'model'=>$model,
            'scenario'=>'update',
            'update'=>true
        )) ?>
    </section>
</div>
