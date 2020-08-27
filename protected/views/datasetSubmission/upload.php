<div class="clear"></div>

<div class="content">
    <div class="container">
        <section>
            <div class="tab-content">
                <div role="tabpanel" class="tab-pane active" id="edit">
<?php if (isset($_GET['status'])): ?>
    <?php if ($_GET['status'] == 'successful'): ?>
                    <div class="row">
                        <div class="col-xs-12">
                            <div class="form well light-green">
                                Your GigaDB submission has been received and is currently under review. If you do not hear from us within 5 working days please contact <a href="mailto:#"> database@gigasciencejournal.com </a>
                                <br/><br/>
                                <a href="/datasetSubmission/upload" class="btn">Back to upload new dataset</a>
                            </div>
                        </div>
                    </div>
    <?php elseif ($_GET['status'] == 'failed'): ?>
                    <div class="row">
                        <div class="col-xs-12">
                            <div class="form well">
                                <p class="error">
                                    Upload failed. Please contact <a href="mailto:#"> database@gigasciencejournal.com </a>
                                    <br/><br/>
                                    <a href="/datasetSubmission/upload" class="btn">Back to upload new dataset</a>
                                </p>
                            </div>
                        </div>
                    </div>
    <?php endif; ?>
<?php else: ?>
                    <div class="row">
                        <div class="col-xs-12">
                            <div class="page-title">
                                <h4 style="display: inline-block">Upload your dataset metadata from a spreadsheet</h4>
                                <a class="myHint" style="float: none;" data-placement="bottom" data-content="You may prepare all the dataset metadata in a special GigaDB Excel submission template file with instructions within the template. Download the empty “Template File” and upload it here after you have completed it. There are also example files you can download to see how it should be completed." data-original-title="" title=""></a>
                            </div>
                        </div>
                    </div>
                    <div class="form well profile-panel">
                        <div class="row form-group">
                            <div class="col-lg-12">
                                <p>You will need to complete the spreadsheet following the instructions provided within.</p>
                                <div class="row form-group">
                                    <div class="col-lg-8">
                                        <p>Please download the template spreadsheet here</p>
                                    </div>
                                    <div class="col-lg-4">
                                        <a href="/files/GigaDBUploadForm.xlsx" class="btn background-btn btn-block pull-right">Download template spreadsheet (Excel)</a>
                                        <a href="/files/GigaDBUploadForm.ods" class="btn background-btn btn-block pull-right">Download template spreadsheet (Open Office)</a>
                                    </div>
                                </div>
                                <div class="row form-group">
                                    <div class="col-lg-8">
                                        <p>To assist you in completing the information you may wish to see an example of a completed spreadsheet, you may download an example here</p>
                                    </div>
                                    <div class="col-lg-4">
                                        <a href="/files/GigaDBUploadForm-example1.xls" class="btn background-btn btn-block pull-right">Download Example 1 (Excel)</a>
                                        <a href="/files/GigaDBUploadForm-example1.ods" class="btn background-btn btn-block pull-right">Download Example 1 (Open Office)</a>
                                    </div>
                                </div>
                                <div class="row form-group">
                                    <div class="col-lg-12">
                                        <p>After you have completed the spreadsheet please use the upload facility below to send the completed spreadsheet to us.</p>
                                    </div>
                                </div>
                                <div class="row form-group">
                                    <div class="col-lg-4">

                                    </div>
                                    <div class="col-lg-4">
                                        <div class="text-center">
                                            <input id="agree-checkbox" type="checkbox" style="margin-right:5px"/><a target="_blank" href="/site/term">I have read GigaDB's Terms and Conditions</a>
                                        </div>
                                    </div>
                                    <div class="col-lg-4">

                                    </div>
                                </div>
                                <div class="row form-horizontal">
                                    <div class="col-lg-3">
                                    </div>
                                    <div class="col-lg-6 input-group form-search">
                                        <?php echo CHtml::form(Yii::app()->createUrl('datasetSubmission/upload'), 'post', array('enctype' => 'multipart/form-data')); ?>
                                        <?php echo CHtml::hiddenField('userId', Yii::app()->user->id); ?>
                                        <?php echo CHtml::label('Excel File', 'xls'); ?>
                                        <?php echo CHtml::fileField('xls', null, array('disabled' => 'disabled', 'class' => 'upload-control', 'title' => 'You must agree to the terms and conditions before continuing.')); ?>
                                        <?php echo CHtml::submitButton('Upload New Dataset', array('class' => 'btn background-btn upload-control', 'disabled' => 'disabled', 'title' => 'You must agree to the terms and conditions before continuing.')); ?>
                                        <?php echo CHtml::endForm(); ?>
                                    </div>
                                    <div class="col-lg-3">
                                    </div>
                                </div>
                                <div class="row form-group">
                                    <div class="col-lg-12">
                                        <p>Prefer to use the wizard instead? Click <a href="/datasetSubmission/create1">here</a>.</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
</div>
    <script>
        $(function() {
            $('#agree-checkbox').click(function() {
                if ($(this).is(':checked')) {
                    $('.upload-control').attr('disabled', false);
                } else {
                    $('.upload-control').attr('disabled', true);
                }
            });
        });
    </script>
<?php endif; ?>
