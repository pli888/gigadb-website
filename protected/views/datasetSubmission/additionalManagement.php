<?php
/** @var Dataset $model */
/** @var  $link_database array of database name acronyms from prefix table */

// $model is a dataset object
// getAdditionalInformation() returns integer
$additionalInfo = $model->getAdditionalInformation();

// Using PHP ternary operator to test $additionalInfo
// !!count($object) will return a boolean TRUE for any true value number and
// FALSE for any false value, e.g 0
$isPublicLinks = $additionalInfo ? !!count($links) : null;
//echo "<p>isPublicLinks = $isPublicLinks</p>";
$isRelatedDoi = $additionalInfo ? !!count($relations) : null;
//echo "<p>isRelatedDoi = $isRelatedDoi</p>";
$isProjects = $additionalInfo ? !!count($dps) : null;
$isManuscripts = $additionalInfo ? !!count($manuscripts) : null;
$isProtocols = $additionalInfo ? !!count($protocols) : null;
$is3dImages = $additionalInfo ? !!count($_3dImages) : null;
$isCodes = $additionalInfo ? !!count($codes) : null;
$isSources = $additionalInfo ? !!count($sources) : null;

// $disabled is a boolean depending if $isSources, etc is null or not
$disabled = $isSources === null || $isCodes === null || $is3dImages === null || $isProtocols === null || $isManuscripts === null || $isProjects === null || $isRelatedDoi === null || $isPublicLinks === null;
?>
<div class="container">
    <div class="content">
        <section>
            <div class="dataset-submission-page-title">
                <h4>Add Additional Information</h4>
            </div>

            <!-- Render tabs -->
            <?php $this->renderPartial('_tabs_navigation', array('model' => $model)); ?>

            <div class="form well">
                <div class="form-horizontal">
                    <div class="row subwiz-row">
                        <div class="col-xs-12">
                        <!-- Render Public data archive links section -->
                        <?php $this->renderPartial('_public_links', array(
                            'model' => $model,
                            'links' => $links,
                            'link_database' => $link_database,
                            'isPublicLinks' => $isPublicLinks)); ?>
        
                        <!-- Render Related GigaDB Datasets section -->
                        <div id="related-doi-block"<?php if ($isPublicLinks === null): ?> style="display: none;"<?php endif ?>>
                            <div class="clear"></div>
                            <?php $this->renderPartial('_related_doi', array(
                                'model' => $model,
                                'relations' => $relations,
                                'isRelatedDoi' => $isRelatedDoi)); ?>
                        </div>

                        <!-- Render Collaboration links section -->
                        <div id="projects-block"<?php if ($isRelatedDoi === null): ?> style="display: none;"<?php endif ?>>
                            <div class="clear"></div>
                            <?php $this->renderPartial('_projects', array(
                                'model' => $model,
                                'dps' => $dps, // dataset projects
                                'isProjects' => $isProjects)); ?>
                        </div>
        
                        <!-- Render Other links section -->
                        <div id="others-block" <?php if ($isProjects === null): ?> style="display: none;"<?php endif ?>>
                            <div class="clear"></div>
                            <?php $this->renderPartial('_others', array(
                                'model' => $model,
                                'manuscripts' => $manuscripts,
                                'protocols' => $protocols,
                                '_3dImages' => $_3dImages,
                                'codes' => $codes,
                                'sources' => $sources,
                                'isManuscripts' => $isManuscripts,
                                'isProtocols' => $isProtocols,
                                'is3dImages' => $is3dImages,
                                'isCodes' => $isCodes,
                                'isSources' => $isSources,
                            )); ?>
                        </div>

                        <div class="clear"></div>
                        <div style="text-align:center" id="additional-save">
                            <a href="/datasetSubmission/authorManagement/id/<?= $model->id ?>" class="btn background-btn">Previous</a>
                            <?php if ($disabled): ?>
                                <a href="/datasetSubmission/additionalManagement/id/<?= $model->id ?>" class="btn background-btn disabled js-not-allowed">Save</a>
                                <a href="/datasetSubmission/fundingManagement/id/<?= $model->id ?>" class="btn background-btn disabled js-not-allowed">Next</a>
                            <?php else: ?>
                                <a href="/datasetSubmission/additionalManagement/id/<?= $model->id ?>" class="btn background-btn js-save-additional">Save</a>
                                <a href="/datasetSubmission/fundingManagement/id/<?= $model->id ?>" class="btn background-btn js-save-additional">Next</a>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>    
            </div>
        </section>
    </div>
</div>

<script>
    var dataset_id = <?= $model->id ?>;

    $(".delete-title").tooltip({'placement':'left'});

    // Binds click event JS function to the add info tab web page and all child
    // elements with js-no-button class:
    // Checks if any links have been created by user which are displayed in table
    // Displays delete alert box if links have been created
    // NO button turn green and becomes disabled
    // YES button turns grey and becomes active and is given js-yes-button functionality
    $(document).on('click', '.js-no-button', function(e) {
        var $this = $(this);
        //var datasetId = $this.data('id');
        //var url = $this.data('url');
        var targetId = $this.data('target');
        var target = $('#' + targetId);
        console.log("target: ", target);

        var type = $this.data('type');
        console.log("type: ", type);
        var itemsClass = '.js-my-item';
        if (type) {
            itemsClass += '-' + type;
        }
        console.log("itemsClass: ", itemsClass);

        var items = target.find(itemsClass);
        console.log("items: ", items);
        if (items.length > 0) {
            if (!confirm('Are you sure you want to delete all items?')) {
                return false;
            }
        }

        var nextBlock = $this.data('next-block');
        if (nextBlock) {
            $('#' + nextBlock).show();
        }
        console.log("nextBlock: ", nextBlock);

        $this.addClass('btn-success btn-disabled');
        $this.removeClass('js-no-button');
        $this.siblings().removeClass('btn-success btn-disabled').addClass('js-yes-button');

        // Not sure what is going on here
        if (type) {
            if (
                $('#manuscripts-no').hasClass('btn-success')
                && $('#protocols-no').hasClass('btn-success')
                && $('#3d_images-no').hasClass('btn-success')
                && $('#codes-no').hasClass('btn-success')
                && $('#sources-no').hasClass('btn-success')
            ) {
                target.hide();
            }

            var targetId2 = $this.data('target2');
            var target2 = $('#' + targetId2);
            target2.hide();
        } else {
            target.hide();
        }

        // Delete items in section that have been created by user
        items.remove();

        if (target.find('.odd').length === 0) {
            $('.js-no-results', target).show();
        }

        // Execute checks for conditions that will enable Save button
        checkIfCanSave();

        return false;
    });

    // If YES button is clicked then it will change from grey to green, disabled
    // This js-yes-button function is removed from it
    // Its sibling NO button turns grey, disabled and has js-no-button JS functionality
    $(".js-yes-button").click(function(e) {
        var $this = $(this);
        var target = $this.data('target');
        console.log("target: ", target);

        $this.addClass('btn-success btn-disabled');
        $this.removeClass('js-yes-button');
        $this.siblings('a').removeClass('btn-success btn-disabled').addClass('js-no-button');

        // Displays element provided by target variable, e.g. public-links
        $('#' + target).show();

        // Check whether to display Other links section or not
        if ($this.parent().hasClass('span9')) {
            $('#others-grid').show();
        }

        // Execute checks for conditions that will enable Save button
        checkIfCanSave();

        return false;
    });

    // Button with btn-disabled class is allowed to do nothing
    $(document).on('click', '.btn-disabled', function () {
        return false;
    });

    // Save data captured in Additional Information tab
    function saveAdditional(url) {
        // Arrays for holding link data
        var publicLinks = [];
        var relatedDoi = [];
        var projects = [];
        var exLinks = [];

        // Add public-links to publicLinks array
        var trs = $('#public-links').find('.odd');
        trs.each(function() {
            let tr = $(this);
            let id = tr.find('.js-my-id').val();
            if (!id) {
                id = 0;
            }
            let link_type = tr.children('td').eq(0).text();
            let link = tr.children('td').eq(1).text();

            publicLinks.push({
                id: id,
                link_type: link_type,
                link: link
            });
        });

        // Add related dois to relatedDoi array
        var trs = $('#related-doi').find('.odd');
        trs.each(function() {
            let tr = $(this);
            let id = tr.find('.js-my-id').val();
            if (!id) {
                id = 0;
            }
            let related_doi = tr.children('td').eq(1).text();
            let relationship_id = tr.find('.js-relationship-id').val();

            relatedDoi.push({
                id: id,
                related_doi: related_doi,
                relationship_id: relationship_id
            });
        });

        // Add project links to projects array
        var trs = $('#projects').find('.odd');
        trs.each(function() {
            let tr = $(this);
            let id = tr.find('.js-my-id').val();
            if (!id) {
                id = 0;
            }
            let project_id = tr.find('.js-project-id').val();

            projects.push({
                id: id,
                project_id: project_id
            });
        });

        // Add other links to exLinks array
        var trs = $('#others-grid').find('.odd');
        trs.each(function() {
            let tr = $(this);
            let id = tr.find('.js-my-id').val();
            if (!id) {
                id = 0;
            }
            let url = tr.children('td').eq(0).text();
            let description = tr.children('td').eq(1).text();
            let type = tr.find('.js-type').val();

            exLinks.push({
                id: id,
                dataset_id: dataset_id,
                url: url,
                externalLinkDescription: description,
                externalLinkType: type
            });
        });

        // Use actionSaveAdditional function in DatasetSubmissionController to save data to database
        $.ajax({
            type: 'POST',
            url: '/datasetSubmission/saveAdditional',
            data:{
                'dataset_id': dataset_id,
                'publicLinks':publicLinks,
                'relatedDoi':relatedDoi,
                'projects':projects,
                'exLinks':exLinks
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

    // When Save button button with the js-save-additional class is clicked then call above saveAdditional(url) function
    $(document).on('click', ".js-save-additional", function() {
        saveAdditional($(this).attr('href'));

        return false;
    });

    // Checks for conditions that will make Save button active state on Additional Information tab
    function checkIfCanSave()
    {
        let othersDiv = $('#others-grid');
        if (
            ($('#public-links-no').hasClass('btn-success') || $('#public-links').find('.odd').length)
            && ($('#related-doi-no').hasClass('btn-success') || $('#related-doi').find('.odd').length)
            && ($('#projects-no').hasClass('btn-success') || $('#projects').find('.odd').length)
            && ($('#manuscripts-no').hasClass('btn-success') || ($('#manuscripts-yes').hasClass('btn-success') && othersDiv.find('.js-my-item-<?= AIHelper::MANUSCRIPTS ?>').length))
            && ($('#protocols-no').hasClass('btn-success') || ($('#protocols-yes').hasClass('btn-success') && othersDiv.find('.js-my-item-<?= AIHelper::PROTOCOLS ?>').length))
            && ($('#3d_images-no').hasClass('btn-success') || ($('#3d_images-yes').hasClass('btn-success') && othersDiv.find('.js-my-item-<?= AIHelper::_3D_IMAGES ?>').length))
            && ($('#codes-no').hasClass('btn-success') || ($('#codes-yes').hasClass('btn-success') && othersDiv.find('.js-my-item-<?= AIHelper::CODES ?>').length))
            && ($('#sources-no').hasClass('btn-success') || ($('#sources-yes').hasClass('btn-success') && othersDiv.find('.js-my-item-<?= AIHelper::SOURCES ?>').length))
        ) {
            $('#additional-save').find('.js-not-allowed').removeClass('js-not-allowed disabled').addClass('js-save-additional');
        } else {
            $('#additional-save').find('.js-save-additional').removeClass('js-save-additional').addClass('js-not-allowed disabled');
        }
    }
</script>
