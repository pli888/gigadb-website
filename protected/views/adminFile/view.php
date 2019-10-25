<div class="container" id="view_file_page">
    <section class="page-title-section">
        <div class="page-title">
            <ol class="breadcrumb pull-right">
                <li><a href="/">Home</a></li>
                <li><a href="/">File</a></li>
                <li class="active">View</li>
            </ol>
            <h4>View File #<?php echo $model->id; ?></h4>
        </div>
    </section>
    <section>
        <? if (Yii::app()->user->checkAccess('admin')) { ?>
            <div class="actionBar">
                [<?= CHtml::link('Manage Files', array('admin')) ?>]
            </div>
        <? } ?>
    </section>
    <section>
        <?php
        $sample_id = FileSample::model()->find('file_id=:file_id', array(':file_id'=>$model->id));
        if(isset($sample_id))
        {
            $sample_name= Sample::model()->find('id=:id',array(':id'=>$sample_id->sample_id));
        }

        $name="Not Set";

        if(isset($sample_id)&&isset($sample_name))
        {
            $name=$sample_name->name;
        }
        $this->widget('zii.widgets.CDetailView', array(
            'data'=>$model,
            'attributes'=>array(
                'id',
                'dataset_id',
                'name',
                'location',
                'extension',
                'size',
                'description',
                'date_stamp',
                'format_id',
                'type_id',
                array(
                    'name'=>'Sample',
                    'value'=> $name,

                ),
            ),
        )); ?>
    </section>
</div>
