<?php if ( validation_errors () != false ) { ?>
    <div class="alert alert-danger validation-errors">
        <?php echo validation_errors (); ?>
    </div>
<?php } ?>

<?php if ( $this -> session -> flashdata ( 'error' ) ) : ?>
    <div class="alert alert-danger">
        <?php echo $this -> session -> flashdata ( 'error' ) ?>
    </div>
<?php endif; ?>

<?php if ( $this -> session -> flashdata ( 'response' ) ) : ?>
    <div class="alert alert-success">
        <?php echo $this -> session -> flashdata ( 'response' ) ?>
    </div>
<?php endif; ?>