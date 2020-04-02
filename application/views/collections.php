<h2 class="title">Your Collections</h2>
<br><br>
<div class="container">
    <div class="row">
        <?php for ($i = 0; $i < count($collections); $i++) { ?>
            <div class="col-sm" style="text-align: center;">
                <img src="<?= assetUrl(); ?>/img/question_mark.jpg" alt="Collection image" width="100">
                <p><?= $collections[$i]['Name'] ?></p>
                <a href="<?= base_url() ?>index.php?/ViewCollection/getCollection/<?= $collections[$i]['CollectionID'] ?>" class="stretched-link"></a>
            </div>
            <?php if ($i % 4 == 3) { ?>
                </div>
                <br>
                <div class="row">
            <? } ?>
        <? } ?>
    </div>
</div>