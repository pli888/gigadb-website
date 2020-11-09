<?php
/** @var Dataset $model */

$additionalInfo = $model->getAdditionalInformation();

$isPublicLinks = $additionalInfo ? !!count($links) : null;
$isRelatedDoi = $additionalInfo ? !!count($relations) : null;
$isProjects = $additionalInfo ? !!count($dps) : null;
$isManuscripts = $additionalInfo ? !!count($manuscripts) : null;
$isProtocols = $additionalInfo ? !!count($protocols) : null;
$is3dImages = $additionalInfo ? !!count($_3dImages) : null;
$isCodes = $additionalInfo ? !!count($codes) : null;
$isRepositories = $additionalInfo ? !!count($repositories) : null;
$isSources = $additionalInfo ? !!count($sources) : null;

$disabled = $isSources === null || $isCodes === null || $isRepositories === null || $is3dImages === null || $isProtocols === null || $isManuscripts === null || $isProjects === null || $isRelatedDoi === null || $isPublicLinks === null;
?>

<div class="content">
    <div class="container">
        <section>
            <div class="dataset-submission-page-title">
                <h4>Add Additional Information</h4>
                <div class="clear"></div>
            </div>

            <?php $this->renderPartial('_tabs_navigation', array('model' => $model)); ?>

            <div class="col-xs-12 form well">
                <?php $this->renderPartial('_public_links', array('model' => $model, 'links' => $links, 'link_database' => $link_database, 'isPublicLinks' => $isPublicLinks)); ?>
            
                <div id="related-doi-block"<?php if ($isPublicLinks === null): ?> style="display: none;"<?php endif ?>>
                    <div class="clear"></div>
                    <?php $this->renderPartial('_related_doi', array('model' => $model, 'relations' => $relations, 'isRelatedDoi' => $isRelatedDoi)); ?>
                </div>
            
                <div id="projects-block"<?php if ($isRelatedDoi === null): ?> style="display: none;"<?php endif ?>>
                    <div class="clear"></div>
                    <?php $this->renderPartial('_projects', array('model' => $model, 'dps' => $dps, 'isProjects' => $isProjects)); ?>
                </div>

                <div id="others-block" <?php if ($isProjects === null): ?> style="display: none;"<?php endif ?>>
                    <div class="clear"></div>
                    <?php $this->renderPartial('_others', array(
                        'model' => $model,
                        'manuscripts' => $manuscripts,
                        'protocols' => $protocols,
                        '_3dImages' => $_3dImages,
                        'codes' => $codes,
                        'sources' => $sources,
                        'repositories' => $repositories,
                        'isManuscripts' => $isManuscripts,
                        'isProtocols' => $isProtocols,
                        'is3dImages' => $is3dImages,
                        'isCodes' => $isCodes,
                        'isSources' => $isSources,
                        'isRepositories' => $isRepositories,
                    )); ?>
                </div>

                <div class="clear"></div>
                <div style="text-align:center" id="additional-save">
                    <a href="/datasetSubmission/authorManagement/id/<?= $model->id ?>" class="btn background-btn">Previous</a>
                    <?php if ($disabled): ?>
                        <a href="/datasetSubmission/additionalManagement/id/<?= $model->id ?>" class="btn background-btn js-not-allowed">Save</a>
                        <a href="/datasetSubmission/fundingManagement/id/<?= $model->id ?>" class="btn background-btn js-not-allowed">Next</a>
                    <?php else: ?>
                        <a href="/datasetSubmission/additionalManagement/id/<?= $model->id ?>" class="btn background-btn js-save-additional">Save</a>
                        <a href="/datasetSubmission/fundingManagement/id/<?= $model->id ?>" class="btn background-btn js-save-additional">Next</a>
                    <?php endif; ?>
                </div>
            </div>
        </section>
    </div>
</div>

<script>
    var dataset_id = <?= $model->id ?>;

    $(".delete-title").tooltip({'placement':'left'});

    $(document).on('click', '.js-no-button', function(e) {
        var $this = $(this);
        //var datasetId = $this.data('id');
        //var url = $this.data('url');
        var targetId = $this.data('target');
        var target = $('#' + targetId);

        var type = $this.data('type');
        var itemsClass = '.js-my-item';
        if (type) {
            itemsClass += '-' + type;
        }

        var items = target.find(itemsClass);
        if (items.length > 0) {
            if (!confirm('Are you sure you want to delete all items?')) {
                return false;
            }
        }

        var nextBlock = $this.data('next-block');
        if (nextBlock) {
            $('#' + nextBlock).show();
        }

        $this.addClass('btn-green btn-disabled');
        $this.removeClass('js-no-button');
        $this.siblings().removeClass('btn-green btn-disabled').addClass('js-yes-button');

        if (type) {
            if (
                $('#manuscripts-no').hasClass('btn-green')
                && $('#protocols-no').hasClass('btn-green')
                && $('#3d_images-no').hasClass('btn-green')
                && $('#codes-no').hasClass('btn-green')
                && $('#repositories-no').hasClass('btn-green')
                && $('#sources-no').hasClass('btn-green')
            ) {
                target.hide();
            }

            var targetId2 = $this.data('target2');
            var target2 = $('#' + targetId2);
            target2.hide();
        } else {
            target.hide();
        }

        items.remove();

        if (target.find('.odd').length === 0) {
            $('.js-no-results', target).show();
        }

        checkIfCanSave();

        return false;
    });

    $(".js-yes-button").click(function(e) {
        var $this = $(this);
        var target = $this.data('target');

        $this.addClass('btn-green btn-disabled');
        $this.removeClass('js-yes-button');
        $this.siblings('a').removeClass('btn-green btn-disabled').addClass('js-no-button');

        $('#' + target).show();

        if ($this.parent().hasClass('span9')) {
            $('#others-grid').show();
        }

        checkIfCanSave();

        return false;
    });

    $(document).on('click', '.btn-disabled', function () {
        return false;
    });

    function saveAdditional(url) {
        var publicLinks = [];
        var relatedDoi = [];
        var projects = [];
        var exLinks = [];

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

    $(document).on('click', ".js-save-additional", function() {
        saveAdditional($(this).attr('href'));

        return false;
    });

    function checkIfCanSave()
    {
        let othersDiv = $('#others-grid');
        if (
            ($('#public-links-no').hasClass('btn-green') || $('#public-links').find('.odd').length)
            && ($('#related-doi-no').hasClass('btn-green') || $('#related-doi').find('.odd').length)
            && ($('#projects-no').hasClass('btn-green') || $('#projects').find('.odd').length)
            && ($('#manuscripts-no').hasClass('btn-green') || ($('#manuscripts-yes').hasClass('btn-green') && othersDiv.find('.js-my-item-<?= AIHelper::MANUSCRIPTS ?>').length))
            && ($('#protocols-no').hasClass('btn-green') || ($('#protocols-yes').hasClass('btn-green') && othersDiv.find('.js-my-item-<?= AIHelper::PROTOCOLS ?>').length))
            && ($('#3d_images-no').hasClass('btn-green') || ($('#3d_images-yes').hasClass('btn-green') && othersDiv.find('.js-my-item-<?= AIHelper::_3D_IMAGES ?>').length))
            && ($('#codes-no').hasClass('btn-green') || ($('#codes-yes').hasClass('btn-green') && othersDiv.find('.js-my-item-<?= AIHelper::CODES ?>').length))
            && ($('#repositories-no').hasClass('btn-green') || ($('#repositories-yes').hasClass('btn-green') && othersDiv.find('.js-my-item-<?= AIHelper::REPOSITORIES ?>').length))
            && ($('#sources-no').hasClass('btn-green') || ($('#sources-yes').hasClass('btn-green') && othersDiv.find('.js-my-item-<?= AIHelper::SOURCES ?>').length))
        ) {
            $('#additional-save').find('.js-not-allowed').removeClass('js-not-allowed').addClass('btn-green js-save-additional');
        } else {
            $('#additional-save').find('.js-save-additional').removeClass('btn-green js-save-additional').addClass('js-not-allowed');
        }
    }
</script>
