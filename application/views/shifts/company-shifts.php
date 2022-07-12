<option></option>
<?php
    if ( count ( $shifts ) > 0 ) {
        foreach ( $shifts as $shift ) {
            ?>
            <option value="<?php echo $shift -> id ?>">
                <?php echo $shift -> title ?>
                (<?php echo time_format ( $shift -> start_time ) . ' - ' . time_format ( $shift -> end_time ) ?>)
            </option>
            <?php
        }
    }
?>