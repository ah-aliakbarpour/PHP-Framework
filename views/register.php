<?php
/** @var $this app\core\View */
$this->title = 'Register';
?>


<h2>Register</h2>


<?php $form = \app\core\form\From::begin('/register', 'post') ?>

    <div class="row">
        <div class="col">
            <?php echo $form->input($model, 'firstname', 'text'); ?>
        </div>
        <div class="col">
            <?php echo $form->input($model, 'lastname', 'text'); ?>
        </div>
    </div>
    <?php echo $form->input($model, 'email', 'text'); ?>
    <?php echo $form->input($model, 'password', 'password'); ?>
    <?php echo $form->input($model, 'confirmPassword', 'password'); ?>

    <div class="mb-3 form-group">
        <button type="submit" class="btn btn-primary">Submit</button>
    </div>

<?php \app\core\form\From::end() ?>

