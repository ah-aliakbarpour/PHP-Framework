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

<!--<form action="/register" method="post">-->
<!--    <div class="row">-->
<!--        <div class="col mb-3 form-group">-->
<!--            <label>Firstname</label>-->
<!--            <input type="text" name="firstname" class="form-control">-->
<!--        </div>-->
<!--        <div class="col mb-3 form-group">-->
<!--            <label>Lastname</label>-->
<!--            <input type="text" name="lastname" class="form-control">-->
<!--        </div>-->
<!--    </div>-->
<!--    <div class="mb-3 form-group">-->
<!--        <label>Email</label>-->
<!--        <input type="text" name="email" class="form-control">-->
<!--    </div>-->
<!--    <div class="mb-3 form-group">-->
<!--        <label>Password</label>-->
<!--        <input type="password" name="password" class="form-control">-->
<!--    </div>-->
<!--    <div class="mb-3 form-group">-->
<!--        <label>Confirm Password</label>-->
<!--        <input type="password" name="confirmPassword" class="form-control">-->
<!--    </div>-->
<!--    <div class="mb-3 form-group">-->
<!--        <button type="submit" class="btn btn-primary">Submit</button>-->
<!--    </div>-->
<!--</form>-->
