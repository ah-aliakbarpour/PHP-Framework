<?php
/**
 * @var $this app\core\View
 * @var $model app\models\ContactForm
 */

$this->title = 'Contact';
?>


<h2>Contact</h2>

<?php $form = \app\core\form\From::begin('/contact', 'post') ?>

    <?php echo $form->input($model, 'subject', 'text'); ?>
    <?php echo $form->input($model, 'email', 'text'); ?>
    <?php echo $form->textArea($model, 'body'); ?>

    <div class="mb-3 form-group">
        <button type="submit" class="btn btn-primary">Submit</button>
    </div>

<?php \app\core\form\From::end() ?>
