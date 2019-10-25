<div class="container" id="create_attribute_page">
    <section class="page-title-section">
        <div class="page-title">
            <ol class="breadcrumb pull-right">
                <li><a href="/">Home</a></li>
                <li><a href="/">Attribute</a></li>
                <li class="active">Create</li>
            </ol>
            <h4>Create Attribute</h4>
        </div>
    </section>
    <section>
        <a href="/attribute/admin">Back</a>

        <?php echo $this->renderPartial('_form', array('model'=>$model)); ?>
    </section>
</div>
