<div class="container" id="manage_files_page">
    <section class="page-title-section">
        <div class="page-title">
            <ol class="breadcrumb pull-right">
                <li><a href="/">Home</a></li>
                <li><a href="/">Files</a></li>
                <li class="active">Manage</li>
            </ol>
            <h4>Manage Files</h4>
        </div>
    </section>
    <section>
        <a href="/adminFile/create" class="btn-green">Create New File</a>&nbsp;&nbsp;<a href="/adminFile/linkFolder" class="btn-green">Link Temp File Folder</a>

        <?php $this->widget('zii.widgets.grid.CGridView', array(
            'id'=>'file-grid',
            'dataProvider'=>$model->search(),
            'itemsCssClass'=>'table table-bordered',
            'filter'=>$model,
            'columns'=>array(
                array('name'=> 'doi_search', 'value'=>'$data->dataset->identifier'),
                'code',
                array(
                    'name' => 'name',
                    'value'=>'$data->name',
                    'htmlOptions' => array('style' => 'width:20px;'),
                ),
                //'location',
                //'extension',

                'date_stamp',
                array('name'=> 'format_search', 'value'=>'$data->format->name'),
                array('name'=> 'type_search', 'value'=>'$data->type->name'),
                array('name'=> 'download_count', 'value'=>'$data->download_count'),

                array(
                    'class'=>'CButtonColumn',
                ),
            ),
        )); ?>
    </section>
</div>
