<? print_r($set) ?>
<h2 class="title">Viewing Set- <?= $sets['Name'] ?></h2>
<br><br>
<div>
    <!-- Add edit and share buttons -->
</div>
<br><br>
<div class="container">
    <div class="row">
        <?php for ($i = 0; $i < count($items); $i++) { ?>
            <div class="col-sm collectionItem" style="text-align: center;" onclick='showModal(<?php echo json_encode($items[$i]) ?>, <?= $collection["CollectionID"] ?>)'>
                <?php if($items[$i]['Photo'] != NULL){ ?>
                    <img src="<?= assetUrl(); ?>/uploads/<?= $items[$i]['Photo']; ?>" alt="Collection image" width="100">
                <? }else{ ?>
                    <img src="<?= assetUrl(); ?>/img/question_mark.jpg" alt="Collection image" width="100">
                <?}?>
                <p><?= $items[$i]['Name'] ?></p>
            </div>
            <?php if ($i % 4 == 3) { ?>
                </div>
                <br>
                <div class="row">
            <? } ?>
        <? } ?>
    </div>
</div>
<div class="modal fade" id="itemModal" tabindex="-1" role="dialog" aria-labelledby="itemName" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header title" style="position: relative; padding: 25px">
                <div style="width: 90%; margin: auto;">
                    <?php if($items[$i]['Photo'] != NULL){ ?>
                        <img src="<?= assetUrl(); ?>/uploads/<?= $items[$i]['Photo']; ?>" alt="Collection image" width="200">
                    <? }else{ ?>
                        <img src="<?= assetUrl(); ?>/img/question_mark.jpg" alt="Collection image" width="200">
                    <?}?>
                </div>
                <div style="position: absolute; top: 11px; right: 15px;">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            </div>
            <div class="modal-body title">
                <h5 class="modal-title" id="itemName"></h5>
                <h5 class="modal-body" id="itemDescription"></h5>
                <h5 class="modal-body" id="itemYear"></h5>
                <h5 class="modal-body" id="itemCondition"></h5>
                <h5 class="modal-body" id="itemDate"></h5>
            </div>
        </div>
    </div>
</div>