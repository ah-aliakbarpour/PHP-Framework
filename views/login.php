<?php
/** @var $this app\core\View */
$this->title = 'Login';
?>


<h2>Login</h2>


<?php $form = \app\core\form\From::begin('/login', 'post') ?>

    <?php echo $form->input($model, 'email', 'text'); ?>
    <?php echo $form->input($model, 'password', 'password'); ?>

    <div class="mb-3 form-group">
        <button type="submit" class="btn btn-primary">Submit</button>
    </div>

<?php \app\core\form\From::end() ?>

