<div class="row" style="margin-bottom: 5px; margin-top: 10px;">
    <div class="col-xs-12">
        <div class="col-xs-6">
            <span>Actionable code in CodeOceans</span>
        </div>
        <div class="col-xs-3">
            <a href="#"
               id="codes-no"
               data-target="others-grid"
               data-target2="codes"
               data-url="/adminExternalLink/deleteExLinks"
               data-id="<?= $model->id ?>"
               data-type="<?= AIHelper::CODES ?>"
               class="btn btn-default others-button <?php if ($isCodes === false): ?>btn-success btn-disabled<?php else: ?>js-no-button<?php endif; ?>"/>No</a>

            <a href="#"
               id="codes-yes"
               data-target="codes"
               class="btn btn-default others-button <?php if ($isCodes === true): ?>btn-success btn-disabled<?php else: ?>js-yes-button<?php endif; ?>"/>Yes</a>
        </div>
    </div>
</div>

<div class="row" id="codes"<?php if ($isCodes !== true): ?> style="display: none"<?php endif; ?>>
    <div class="control-group">
        <div class="col-md-4">
            <label class='control-label'>Please provide CodeOceans “Embed code widget”:</label>
        </div>
        <div class="controls col-md-4">
            <?= CHtml::textField('link', '', array('class'=>'form-control js-ex-link others-input', 'size' => 60, 'maxlength' => 100, 'style' => 'width: 100%;', 'placeholder' => "<script src=\"https://codeocean.com/widget.js?id=0a812d9b-0ff3-4eb7-825f-76d3cd049a43\" async></script>")); ?>
        </div>
        <div class="col-md-4">
            <a href="#" dataset-id="<?=$model->id?>" data-type="<?= AIHelper::CODES ?>" class="btn btn-success disabled js-not-allowed" />Add Link</a>
        </div>
    </div>
</div>
