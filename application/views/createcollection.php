<h2 class='text-center'>Create a Collection</h2>
<h4> <?= $error ?></h4>
<p><?= $msg ?></p>
<div class="container-fluid">

    <?= form_open("CreateCollection/createCollection") ?>
        <?= form_fieldset("Collection Details"); ?>
            <div class ="formgroup">
                <?= form_label('Enter The Name of your Collection:', 'name'); ?>
                <?= form_input(array('name' => 'name',
                'id' => 'name',
                'class' => 'form-control',
                'placeholder' => 'Enter Collection Name' )); ?>
            </div>
            <div class="formgroup">
                <?= form_label('Description:', 'description'); ?> <br>
                <?= form_input(array('name' => 'description',
                'id' => 'description',
                'type' => 'textarea',
                'rows' =>'3',
                'class' => 'form-control',
                'placeholder' => 'Enter a description of your Collection' )); ?>
            </div>
            <div class="formgroup">
                <label for="selectSet">Use a set as a starter</label>
                <select class="form-control" id="selectSet" name='set'>
                    <option value = '0' selected> Do not use Set </option>
                    <? foreach ($sets as $set) { ?>
                        <option value= <?= $set['SetID'] ?>><?= $set['Name'] ?> </option>
                   <? } ?>
                </select>
            </div><br>
            <div class="formgroup">
                <?= form_submit(array('name' => 'submit',
                'id' => 'submit',
                'class' => 'btn btn-primary',
                'value' => 'Submit')); ?>
            </div>
        <?= form_fieldset_close(); ?>
    <?= form_close() ?>
</div>