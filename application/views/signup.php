<h2 class='text-center'>Register</h2>
<? if ($success) {?> <h4>User has been successfully created! You can now sign in with the credentials you registered with</h4> <? } ?>
<? if ($error) {?> <h4>Cannot create user with that username. Please use a unique username</h4> <? } ?>
<p><?= $msg ?></p>

<div class="container-fluid">

    <?= form_open("Signup/CheckUser") ?>
        <?= form_fieldset("Credentials"); ?>
            <div class ="formgroup">
                <?= form_label('Enter your username:', 'username'); ?>
                <?= form_input(array('name' => 'username',
                'id' => 'username',
                'class' => 'form-control',
                'placeholder' => 'Enter username' )); ?>
            </div>
            <div class="formgroup">
                <?= form_label('Password:', 'password'); ?> <br>
                <?= form_input(array('name' => 'password',
                'id' => 'password',
                'type' => 'password',
                'class' => 'form-control',
                'placeholder' => 'Password' )); ?>
            </div><br>
            <div class="formgroup">
                <?= form_submit(array('name' => 'loginsubmit',
                'id' => 'loginsubmit',
                'class' => 'btn btn-primary',
                'value' => 'Submit')); ?>
            </div>
        <?= form_fieldset_close(); ?>
    <?= form_close() ?>
</div>