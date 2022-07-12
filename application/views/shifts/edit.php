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
                    <?php hidden_action_field ( 'process-update-shifts' ); ?>
                    <input type="hidden" name="id" value="<?php echo encrypt_string ( $shift -> id ) ?>">
                    <div class="card-body pb-0">
                        <div class="row">
                            <div class="form-group col-lg-6">
                                <label>Title</label>
                                <input type="text" placeholder="Title" required="required" autofocus="autofocus"
                                       class="form-control" name="title" value="<?php echo $shift -> title ?>">
                            </div>
                            
                            <div class="form-group col-lg-3">
                                <label>Start Time</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text">
                                            <i class="fas fa-clock"></i>
                                        </div>
                                    </div>
                                    <input type="text" class="form-control timepicker" name="start-time"
                                           required="required" value="<?php echo $shift -> start_time ?>">
                                </div>
                            </div>
                            
                            <div class="form-group col-lg-3">
                                <label>End Time</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text">
                                            <i class="fas fa-clock"></i>
                                        </div>
                                    </div>
                                    <input type="text" class="form-control timepicker" name="end-time"
                                           required="required" value="<?php echo $shift -> end_time ?>">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer pt-0">
                        <button class="btn btn-primary mr-1" type="submit">Update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>