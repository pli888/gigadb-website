<div class="container" id="manage_rss_message_page">
    <section class="page-title-section">
        <div class="page-title">
            <ol class="breadcrumb pull-right">
                <li><a href="/">Home</a></li>
                <li><a href="/">RSS Message</a></li>
                <li class="active">Manage</li>
            </ol>
            <h4>Manage RSS Messages</h4>
        </div>
    </section>
    <section>
        <a href="/rssMessage/create" class="btn-green">Create an RSS Message</a>

        <?php $this->widget('zii.widgets.grid.CGridView', array(
            'id'=>'rss-message-grid',
            'dataProvider'=>$model->search(),
            'filter'=>$model,
            'itemsCssClass'=>'table table-bordered',
            'columns'=>array(
                'id',
                'message',
                'publication_date',
                array(
                    'class'=>'CButtonColumn',
                ),
            ),
        )); ?>
    </section>
</div>





