<h2>Home</h2>
<p> Need inspiration for your collection? Here are some public sets you can use to start your collection! </p><br>
<div class= "container-fluid">
    <div class="list-group">
    <!-- TO DO: -->
    <? foreach ($sets as $set){ ?> 
    <a class="list-group-item list-group-item-action" href="<?= base_url(); ?>index.php?/ViewSet/getset/<?= $set['SetID']?>"><?= $set['Name']?> </a>
    <? } ?>
    </div>
</div>