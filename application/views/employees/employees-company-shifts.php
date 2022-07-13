<option></option>
<?php
    if ( count ( $employees ) > 0 ) {
        foreach ( $employees as $employee ) {
            ?>
            <option value="<?php echo $employee -> id ?>">
                <?php echo $employee -> first_name . ' ' . $employee -> last_name ?>
            </option>
            <?php
        }
    }
?>