<?php
/** @var Dataset $model */
/** @var Funder[] $funders */
/** @var DatasetFunder[] $fundings */

$disabled = $model->getFunding() === null || ($model->getFunding() === true && !$fundings);
$fundersList = array('Please select…');
foreach ($funders as $funder) {
    $fundersList[$funder->id] = $funder->primary_name_display;
}
?>
<div class="container">
    <div class="content">
        <section>
            <div class="dataset-submission-page-title">
                <h4>Add Fundings</h4>
            </div>
            <?php $this->renderPartial('_tabs_navigation', array('model' => $model)); ?>
            <div class="form well">
                <div class="form-horizontal">
                    <div id="funding-grid" class="grid-view">
                        <div class="row subwiz-row">
                            <div class="col-xs-12">
                                <p class="note">
                                    Would you like to acknowledge any funding bodies that have provided resources to generate these data?
                                    <a class="myHint" style="float: none;" data-content="We encourage the addition of funding information to acknowledge the support from your funders, we require that funding information is highly structured to ensure that it can be machine readable. If your funding body is not already included in our database please contact us (database@gigasciencejournal.com) with the name, country and a URL of the funder and we can add it to the list."></a>
                                </p>

                                <div style="text-align: center; margin-bottom: 15px;">
                                    <a href="#"
                                       id="funding-yes-button"
                                       class="btn btn-default <?php if ($model->getFunding() === true): ?>btn btn-success<?php else: ?>js-yes-button<?php endif; ?>"/>Yes</a>
                                    <a href="#"
                                       id="funding-no-button"
                                       data-id="<?= $model->id ?>"
                                       class="btn btn-default <?php if ($model->getFunding() === false): ?>btn btn-success<?php else: ?>js-no-button<?php endif; ?>"/>No</a>
                                </div>

                                <form>
                                    <div id="funding"<?php if ($model->getFunding() !== true): ?> style="display: none;"<?php endif; ?>>
                                        <p class="note">Please select the appropriate funding body from the dropdown list. This list is from FundRef  and should be used if possible. If your funding body is not present you may either contact FundRef directly to ask for its addition (please allow some time for the updates to propagate to this page) or use the Funding body “Other” from the list.</p>
                                        <div class="control-group">
                                            <div style="text-align: center">
                                                <?= CHtml::dropDownList('funder_id',
                                                    null,
                                                    $fundersList,
                                                    array('class'=>'js-database form-control', 'style'=>'width:250px'));
                                                ?> * required
                                            </div>
                                        </div>
                                        <p class="note">Often Funding bodies provide funds to different “programs”, if appropriate you may type the funding bodies Program name here:</p>
                                        <div class="control-group form-group">
                                            <div style="text-align: center">
                                                <?= CHtml::textField('program_name', '', array('size' => 60, 'maxlength' => 100, 'style'=>'width:240px;margin-right:60px;', 'placeholder'=>"Program name, e.g. FP7 framework", 'class' => 'form-control')); ?>
                                            </div>
                                        </div>
                                        <p class="note">Please now provide the unique reference to the grant/funding received</p>
                        
                                        <div class="control-group form-group">
                                            <div style="text-align: center">
                                                <?= CHtml::textField('grant', '', array('size' => 60, 'maxlength' => 100, 'style'=>'width:240px', 'placeholder'=>"Grant reference", 'class' => 'form-control js-funding-required')); ?> * required
                                            </div>
                                        </div>
                                        <p class="note">Now add the last name and first initial of the Principal investigator names on the grant application</p>
                                        <div class="control-group form-group">
                                            <div style="text-align: center">
                                                <?= CHtml::textField('pi_name', '', array('size' => 60, 'maxlength' => 100, 'style'=>'width:240px', 'placeholder'=>"PI name, e.g. Bloggs J", 'class' => 'form-control js-funding-required')); ?> * required
                                            </div>
                                        </div>
                                        <div class="control-group">
                                            <div style="text-align: center">
                                                <a href="#" id="add-funding" class="btn btn-success disabled js-not-allowed"/>Add funding</a>
                                            </div>
                                        </div>
    
                                        <div class="grid-view" style="padding-top: 20px">
                                            <table class="table table-bordered subwiztable">
                                                <thead>
                                                <tr>
                                                    <th id="author-grid_c0" width="22%">Funding body</th>
                                                    <th id="author-grid_c1" width="23%">Program Name</th>
                                                    <th id="author-grid_c2" width="22%">Grant Number</th>
                                                    <th id="author-grid_c3" width="23%">PI name</th>
                                                    <th id="author-grid_c4" class="button-column" width="10%"></th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                <?php foreach($fundings as $funding): ?>
                                                    <tr class="odd">
                                                        <td><?= $funding->funder->primary_name_display ?></td>
                                                        <td><?= $funding->comments ?></td>
                                                        <td><?= $funding->grant_award ?></td>
                                                        <td><?= $funding->awardee ?></td>
                                                        <td class="button-column">
                                                            <a href="#" id="delete-funding" class="js-delete-funding delete-title" title="delete this row">
                                                                <img alt="delete this row" src="/images/delete.png">
                                                            </a>
                                                            <input type="hidden" class="js-funding-id" value="<?= $funding->id ?>">
                                                            <input type="hidden" class="js-funder-id" value="<?= $funding->funder_id ?>">
                                                        </td>
                                                    </tr>
                                                <?php endforeach; ?>
                                                <tr class="js-no-results"<?php if ($fundings): ?> style="display: none"<?php endif ?>>
                                                    <td colspan="5">
                                                        <span class="empty">No results found.</span>
                                                    </td>
                                                </tr>
                                                <tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <div class="row subwiz-row">
                            <div class="col-xs-12">
                                <div class="clear"></div>
                                <div style="text-align:center" id="funding-save">
                                    <a href="/datasetSubmission/additionalManagement/id/<?= $model->id ?>" class="btn background-btn">Previous</a>
                                    <a href="/datasetSubmission/fundingManagement/id/<?= $model->id ?>"
                                       class="btn background-btn <?php if ($disabled): ?>disabled js-not-allowed<?php else: ?>js-save-funding<?php endif; ?>">Save</a>
                                    <a href="/datasetSubmission/sampleManagement/id/<?= $model->id ?>"
                                       class="btn background-btn <?php if ($disabled): ?>disabled js-not-allowed<?php else: ?>js-save-funding<?php endif; ?>">Next</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    var datasetId = <?= $model->id ?>;
    var fundingDiv = $('#funding');

    $(".delete-title").tooltip({'placement':'left'});

    $(document).on('click', '.js-not-allowed', function() {
        return false;
    });

    function makeSaveActiveIfCan() {
        if ($('#funding-no-button').hasClass('btn-success') || $('#funding').find('.odd').length) {
            $('#funding-save').find('.js-not-allowed').removeClass('disabled js-not-allowed').addClass('js-save-funding');
        } else {
            $('#funding-save').find('.js-save-funding').removeClass('js-save-funding').addClass('js-not-allowed');
        }
    }

    function makeAddActiveIfCan() {
        if (
            $('#funder_id').val() !== '0'
            && $('#grant').val()
            && $('#pi_name').val()
        ) {
            $(fundingDiv).find('.js-not-allowed').removeClass('disabled js-not-allowed').addClass('js-add-funding');
        } else {
            $(fundingDiv).find('.js-add-funding').removeClass('js-add-funding').addClass('disabled js-not-allowed');
        }
    }

    function cleanFundingForm()
    {
        $('#funder_id').val('0');
        $('#grant').val('');
        $('#pi_name').val('');
        $('#program_name').val('');
    }

    $(document).on('click', '.js-no-button', function(e) {
        var $this = $(this);

        var items = fundingDiv.find('.odd');
        if (items.length > 0) {
            if (!confirm('Are you sure you want to delete all items?')) {
                return false;
            }
        }

        $this.addClass('btn btn-success');
        $this.removeClass('btn-default js-no-button');
        $this.siblings().removeClass('btn btn-success').addClass('btn btn-default js-yes-button');

        items.remove();
        $('.js-no-results', fundingDiv).show();

        fundingDiv.hide();

        makeSaveActiveIfCan();

        return false;
    });

    $(".js-yes-button").click(function() {
        var $this = $(this);

        $this.removeClass('btn btn-default js-yes-button');
        $this.addClass('btn btn-success');
        $this.siblings().removeClass('btn btn-success').addClass('btn btn-default js-no-button');

        fundingDiv.show();

        makeSaveActiveIfCan();

        return false;
    });

    function saveFunding(url) {
        var fundings = [];

        let trs = fundingDiv.find('.odd');
        trs.each(function() {
            let tr = $(this);

            let id = tr.find('.js-funding-id').val();
            if (!id) {id = 0;}
            let funder_id = tr.find('.js-funder-id').val();
            let program_name = tr.children('td').eq(1).text();
            let grant = tr.children('td').eq(2).text();
            let pi_name = tr.children('td').eq(3).text();

            fundings.push({
                id: id,
                dataset_id: datasetId,
                funder_id: funder_id,
                program_name: program_name,
                grant: grant,
                pi_name: pi_name,
            });
        });

        $.ajax({
            type: 'POST',
            url: '/datasetSubmission/saveFundings',
            data:{
                fundings: fundings,
                dataset_id: datasetId,
            },
            success: function(response){
                if(!response.success) {
                    alert(response.message);
                } else {
                    window.location.href = url;
                }
            },
            error: function(xhr) {
                alert(xhr.responseText);
            }
        });
    }

    $(document).on('click', ".js-save-funding", function() {
        saveFunding($(this).attr('href'));

        return false;
    });

    $(fundingDiv).on('change', '#funder_id', function () {
        makeAddActiveIfCan();
    });

    $(fundingDiv).on('keydown', '.js-funding-required', function () {
        setTimeout((function(){
            makeAddActiveIfCan();
        }), 50);
    });

    $(fundingDiv).on('click', ".js-add-funding", function() {
        var funderId = $('#funder_id').val();
        if ($('.js-funder-id[value="' + funderId + '"]').length) {
            alert('Funder "'+ $('option[value="'+ funderId +'"]').text() +'" has already been taken.');
        } else {
        $.ajax({
            type: 'POST',
            url: '/datasetSubmission/validateFunding',
            data:{
                'dataset_id': datasetId,
                'funder_id': funderId,
                'grant': $('#grant').val().trim(),
                'pi_name': $('#pi_name').val().trim(),
                'program_name': $('#program_name').val().trim()
            },
            success: function(response){
                if(response.success) {
                        let programName = response.funding['program_name'] === null ? '' : response.funding['program_name'];
                        let tr =
                        '<tr class="odd">' +
                            '<td>' + response.funding['funder_name'] + '</td>' +
                            '<td>' + programName + '</td>' +
                            '<td>' + response.funding['grant'] + '</td>' +
                            '<td>' + response.funding['pi_name'] + '</td>' +
                            '<td class="button-column">' +
                                '<a class="js-delete-funding delete-title" title="delete this row">' +
                                '<img alt="delete this row" src="/images/delete.png">' +
                                '</a>' +
                                '<input type="hidden" class="js-funder-id" value="' + response.funding['funder_id'] + '">' +
                            '</td>' +
                        '</tr>';

                    $('.js-no-results', fundingDiv).before(tr);
                    $('.js-no-results', fundingDiv).hide();

                    cleanFundingForm();
                    makeAddActiveIfCan();
                    makeSaveActiveIfCan();
                    $(".delete-title").tooltip({'placement':'left'});
                } else {
                    alert(response.message);
                }
            },
            error: function(xhr) {
                alert(xhr.responseText);
            }
        });
        }

        return false;
    });

    $(fundingDiv).on('click', ".js-delete-funding", function() {
        if (!confirm('Are you sure you want to delete this item?'))
            return false;

        $(this).closest('tr').remove();

        if (fundingDiv.find('.odd').length === 0) {
            $('.js-no-results', fundingDiv).show();
        }

        makeSaveActiveIfCan();
    });
</script>
