<div class="row" style="margin-bottom: 5px; margin-top: 10px;">
    <div class="span9">
        <span>Actionable code in CodeOceans</span>

        <!-- Render NO button to add manuscript -->
        <!-- If there are no manuscripts (false) then No button is green and disabled, and js-no-button functionality added -->
        <!-- No button is grey if $isManuscripts is null and js-no-button functionality added -->
        <a href="#"
           id="codes-no"
           data-target="others-grid"
           data-target2="codes"
           data-url="/adminExternalLink/deleteExLinks"
           data-id="<?= $model->id ?>"
           data-type="<?= AIHelper::CODES ?>"
           class="btn btn-default others-button <?php if ($isCodes === false): ?>btn-success btn-disabled<?php else: ?>js-no-button<?php endif; ?>"/>No</a>

        <!-- Render YES button to add manuscript -->
        <!-- If there are manuscripts (true) then YES button is green and disabled -->
        <!-- No button is grey if $isManuscripts is null and js-yes-button functionality added -->
        <a href="#"
           id="codes-yes"
           data-target="codes"
           class="btn btn-default others-button <?php if ($isCodes === true): ?>btn-success btn-disabled<?php else: ?>js-yes-button<?php endif; ?>"/>Yes</a>
    </div>
</div>

<!-- Render form if $isManuscripts is false -->
<div class="row" id="codes"<?php if ($isCodes !== true): ?> style="display: none"<?php endif; ?>>
    <div class="span9">
        <label class='control-label others-label' style="margin-left: 0;width: 100%;">Please provide CodeOceans “Embed code widget”:</label>
        <div style="margin-left: 10px;">
            <?= CHtml::textField('link', '', array('class'=>'js-ex-link others-input', 'size' => 60, 'style' => 'width: 100%;', 'placeholder' => "<script src=\"https://codeocean.com/widget.js?id=0a812d9b-0ff3-4eb7-825f-76d3cd049a43\" async></script>")); ?>
        </div>
    </div>
    <div class="span2">
        <!-- Render Add Link button -->
        <!-- js-add-exLink class added to button when it turns active -->
        <a href="#" dataset-id="<?=$model->id?>" data-type="<?= AIHelper::CODES ?>" class="btn js-not-allowed" style="margin-top: 29px;"/>Add Link</a>
    </div>
</div>
