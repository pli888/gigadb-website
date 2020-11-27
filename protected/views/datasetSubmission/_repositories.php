<div class="row" style="margin-bottom: 5px; margin-top: 10px;">
    <div class="span9">
        <span>A GitHub repository</span>
        
        <a href="#"
           id="repositories-no"
           data-target="others-grid"
           data-target2="repositories"
           data-url="/adminExternalLink/deleteExLinks"
           data-id="<?= $model->id ?>"
           data-type="<?= AIHelper::REPOSITORIES ?>"
           class="btn btn-default others-button <?php if ($isRepositories === false): ?>btn-success btn-disabled<?php else: ?>js-no-button<?php endif; ?>"/>No</a>

        <a href="#"
           id="repositories-yes"
           data-target="repositories"
           class="btn btn-default others-button <?php if ($isRepositories === true): ?>btn-success btn-disabled<?php else: ?>js-yes-button<?php endif; ?>"/>Yes</a>
    </div>
</div>

<div class="row" id="repositories"<?php if ($isRepositories !== true): ?> style="display: none"<?php endif; ?>>
    <div class="span9">
        <label class='control-label others-label'>Please provide GitHub Link</label>
        <div class="controls">
            <?= CHtml::textField('link', '', array('class'=>'js-ex-link others-input', 'size' => 60, 'maxlength' => 100, 'placeholder' => "e.g. https://github.com/gigascience/gigadb-website")); ?>
        </div>
    </div>
    <div class="span2">
        <a href="#" dataset-id="<?=$model->id?>" data-type="<?= AIHelper::REPOSITORIES ?>" class="btn btn-default js-not-allowed"/>Add Link</a>
    </div>
</div>
