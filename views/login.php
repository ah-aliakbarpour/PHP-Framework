<?php
/** @var $model \app\models\User */
?>


<h2>Login</h2>


<?php $form = \app\core\form\From::begin('/login', 'post') ?>

    <?php echo $form->field($model, 'email'); ?>
    <?php echo $form->field($model, 'password')->passwordField(); ?>

    <div class="mb-3 form-group">
        <button type="submit" class="btn btn-primary">Submit</button>
    </div>

<?php \app\core\form\From::end() ?>

