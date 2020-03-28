<h2>Login</h2>

<p><?= $msg ?></p>

<div class="container-fluid">

    <?= form_open("Login/loginuser") ?>
        <?= form_fieldset("Login credentials"); ?>
            <div class ="formgroup">
                <?= form_label('Enter your Email Address:', 'email'); ?>
                <?= form_input(array('name' => 'email',
                'id' => 'email',
                'type' => 'email',
                'class' => 'form-control',
                'placeholder' => 'Enter Email',
                'aria-describedby' => 'emailHelp',
                'value' => set_value('email',"") )); ?>
                <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
            </div>
            <div class="formgroup">
                <?= form_label('Password:', 'password'); ?> <br>
                <?= form_input(array('name' => 'password',
                'id' => 'password',
                'type' => 'password',
                'class' => 'form-control',
                'placeholder' => 'Password',
                'value' => set_value('password',"") )); ?>
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