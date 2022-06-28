<h2>Register</h2>


<?php $form = \app\core\form\From::begin('/register', 'post') ?>

    <div class="row">
        <div class="col">
            <?php echo $form->field($model, 'firstname'); ?>
        </div>
        <div class="col">
            <?php echo $form->field($model, 'lastname'); ?>
        </div>
    </div>
    <?php echo $form->field($model, 'email'); ?>
    <?php echo $form->field($model, 'password')->passwordField(); ?>
    <?php echo $form->field($model, 'confirmPassword')->passwordField(); ?>

    <div class="mb-3 form-group">
        <button type="submit" class="btn btn-primary">Submit</button>
    </div>

<?php \app\core\form\From::end() ?>

