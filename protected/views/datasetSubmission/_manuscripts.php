<div class="row" style="margin-bottom: 5px;">
    <?php echo "isManuscripts: ", $isManuscripts ?>
    <div class="span9">
        <span>A published manuscript that uses this data………………………………………………………</span>

        <!-- Render NO button to add manuscript -->
        <!-- If there are no manuscripts (false) then No button is green and disabled, and js-no-button functionality added -->
        <!-- No button is grey if $isManuscripts is null and js-no-button functionality added -->
        <a href="#"
           id="manuscripts-no"
           data-target="others-grid"
           data-target2="manuscripts"
           data-url="/adminExternalLink/deleteExLinks"
           data-id="<?= $model->id ?>"
           data-type="<?= AIHelper::MANUSCRIPTS ?>"
           class="btn others-button <?php if ($isManuscripts === false): ?>btn-green btn-disabled<?php else: ?>js-no-button<?php endif; ?>"/>No</a>

        <!-- Render YES button to add manuscript -->
        <!-- If there are manuscripts (true) then YES button is green and disabled -->
        <!-- No button is grey if $isManuscripts is null and js-yes-button functionality added -->
        <a href="#"
           id="manuscripts-yes"
           data-target="manuscripts"
           class="btn others-button <?php if ($isManuscripts === true): ?>btn-green btn-disabled<?php else: ?>js-yes-button<?php endif; ?>"/>Yes</a>
    </div>
</div>

<!-- Render form if $isManuscripts is false -->
<div class="row" id="manuscripts"<?php if ($isManuscripts !== true): ?> style="display: none"<?php endif; ?>>
    <div class="span9">
        <div class="controls">
            <!-- id = "link" -->
            <?= CHtml::textField('link', '', array('class'=>'js-ex-link others-input', 'size' => 60, 'maxlength' => 100, 'placeholder' => "e.g. doi:10.1093/gigascience/giy095")); ?>
        </div>
    </div>
    <div class="span2">
        <!-- Render Add Link button -->
        <!-- js-add-exLink class added to button when it turns active -->
        <a href="#" dataset-id="<?=$model->id?>" data-type="<?= AIHelper::MANUSCRIPTS ?>" class="btn js-not-allowed"/>Add Link</a>
    </div>
</div>
