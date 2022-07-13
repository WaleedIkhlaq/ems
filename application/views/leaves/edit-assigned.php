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
                    <?php hidden_action_field ( 'process-edit-assigned-leave' ); ?>
                    <input type="hidden" name="leave-id" value="<?php echo encrypt_string ( $leave -> id ) ?>">
                    <div class="card-body pb-0">
                        <div class="row">
                            <div class="form-group col-lg-4">
                                <label>Company</label>
                                <select class="form-control select2" data-placeholder="Select"
                                        required="required">
                                    <option value="<?php echo $company -> id; ?>">
                                        <?php echo $company -> title; ?>
                                    </option>
                                </select>
                            </div>
                            
                            <div class="form-group col-lg-4">
                                <label>Shift</label>
                                <select class="form-control select2" data-placeholder="Select"
                                        required="required">
                                    <option value="<?php echo $shift -> id; ?>">
                                        <?php echo $shift -> title; ?>
                                    </option>
                                </select>
                            </div>
                            
                            <div class="form-group col-lg-4">
                                <label>Employee</label>
                                <select class="form-control select2" required="required"
                                        data-placeholder="Select">
                                    <option value="<?php echo $employee -> id; ?>">
                                        <?php echo $employee -> first_name . ' ' . $employee -> last_name; ?>
                                    </option>
                                </select>
                            </div>
                        </div>
                        
                        <div class="row">
                            <div class="form-group col-lg-2">
                                <label>Start Date</label>
                                <input type="text" data-date-format="yyyy-mm-dd" name="start-date"
                                       class="form-control datepicker" required="required"
                                       value="<?php echo $leave -> start_date ?>">
                            </div>
                            
                            <div class="form-group col-lg-2">
                                <label>End Date</label>
                                <input type="text" data-date-format="yyyy-mm-dd" name="end-date"
                                       class="form-control datepicker" required="required"
                                       value="<?php echo $leave -> end_date ?>">
                            </div>
                            
                            <div class="form-group col-lg-2">
                                <label>Approved</label>
                                <select name="approved" class="form-control">
                                    <option value="1" <?php echo $leave -> approved == '1' ? 'selected="selected"' : '' ?>>Yes</option>
                                    <option value="0" <?php echo $leave -> approved == '0' ? 'selected="selected"' : '' ?>>No</option>
                                </select>
                            </div>
                            
                            <div class="form-group col-lg-6">
                                <label>Description</label>
                                <textarea type="text" name="description" class="form-control no-resize"
                                          rows="5"><?php echo $leave -> description ?></textarea>
                            </div>
                        </div>
                    
                    </div>
                    <div class="card-footer pt-0">
                        <button class="btn btn-primary mr-1" id="assignLeaves" type="submit">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>