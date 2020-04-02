<h2 class='text-center'>Create a Set</h2>
<h4> <?= $error ?></h4>
<p><?= $msg ?></p>
<div class="container-fluid">

    <?= form_open("CreateSet/createSets") ?>
        <?= form_fieldset("Collection Details"); ?>
            <div class ="formgroup">
                <?= form_label('Enter The Name of your Set:', 'name'); ?>
                <?= form_input(array('name' => 'name',
                'id' => 'name',
                'class' => 'form-control',
                'placeholder' => 'Enter Set Name' )); ?>
            </div>
            <div class="formgroup">
                <?= form_label('Description:', 'description'); ?> <br>
                <?= form_input(array('name' => 'description',
                'id' => 'description',
                'type' => 'textarea',
                'rows' =>'3',
                'class' => 'form-control',
                'placeholder' => 'Enter a description of your Set' )); ?>
            </div>
            <div class="formgroup">
                <label for="selectSet">Private</label>
                <select class="form-control" id="selectSet" name='private'>
                    <option value = '0' selected>Private</option>
                    <option value = '1'>Public</option>
                </select>
                <small id="selectSetHelp" class="form-text text-muted">A private Set is only accessible you and members you share it with.</small>
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