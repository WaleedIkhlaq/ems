<div class="section-body">
    <div class="row">
        <div class="col-12 col-md-12 col-lg-12">
            <?php form_validations (); ?>
            <div class="card">
                <div class="card-header">
                    <h4><?php echo $title ?></h4>
                </div>
                <form method="post">
                    <?php csrf_field (); ?>
                    <?php hidden_action_field ( 'process-create-companies' ); ?>
                    <div class="card-body pb-0">
                        <div class="row">
                            <div class="form-group col-lg-12">
                                <label>Title</label>
                                <input type="text" placeholder="Title" required="required" autofocus="autofocus"
                                       class="form-control" name="title" value="<?php echo set_value ( 'title' ) ?>">
                            </div>
                        </div>
                        
                        <div class="row">
                            <div class="col-lg-12 mb-2">
                                <h4 class="text-dark border-bottom">Select Shifts</h4>
                            </div>
                            <div class="col-lg-12 form-group">
                                <ul class="shifts-list">
                                    <?php
                                        if ( count ( $shifts ) > 0 ) {
                                            foreach ( $shifts as $key => $shift ) {
                                                ?>
                                                <li>
                                                    <div class="custom-control custom-checkbox">
                                                        <input type="checkbox" class="custom-control-input"
                                                               id="checkbox-<?php echo $shift -> id ?>"
                                                               value="<?php echo $shift -> id ?>"
                                                               name="shift-id[]" <?php echo $shift -> id == set_value ( "shift-id[$key]" ) ? 'checked="checked"' : '' ?>>
                                                        <label class="custom-control-label"
                                                               for="checkbox-<?php echo $shift -> id ?>">
                                                            <?php echo $shift -> title ?>
                                                        </label>
                                                        <small>
                                                            (<?php echo time_format ( $shift -> start_time ) . ' - ' . time_format ( $shift -> end_time ) ?>)
                                                        </small>
                                                    </div>
                                                </li>
                                                <?php
                                            }
                                        }
                                    ?>
                                </ul>
                            </div>
                        </div>
                    
                    </div>
                    <div class="card-footer pt-0">
                        <button class="btn btn-primary mr-1" type="submit">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>