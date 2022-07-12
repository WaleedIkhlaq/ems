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
                    <?php hidden_action_field ( 'process-create-employee' ); ?>
                    <input type="hidden" id="row" value="1">
                    
                    <div class="card-body pb-0">
                        <div class="row">
                            <div class="form-group col-lg-3">
                                <label>First Name</label>
                                <input type="text" placeholder="First Name" required="required" autofocus="autofocus"
                                       class="form-control" name="first-name"
                                       value="<?php echo set_value ( 'first-name' ) ?>">
                            </div>
                            
                            <div class="form-group col-lg-3">
                                <label>Last Name</label>
                                <input type="text" placeholder="Last Name" required="required"
                                       class="form-control" name="last-name"
                                       value="<?php echo set_value ( 'last-name' ) ?>">
                            </div>
                            
                            <div class="form-group col-lg-3">
                                <label>Email</label>
                                <input type="email" placeholder="Email" class="form-control" name="email"
                                       value="<?php echo set_value ( 'email' ) ?>">
                            </div>
                            
                            <div class="form-group col-lg-3">
                                <label>Contact No.</label>
                                <input type="text" maxlength="15" placeholder="Contact No." class="form-control"
                                       name="contact-no"
                                       value="<?php echo set_value ( 'contact-no' ) ?>">
                            </div>
                        </div>
                        
                        <div class="row">
                            <div class="form-group col-lg-12">
                                <label>Address</label>
                                <textarea name="address" class="form-control no-resize"
                                          rows="5"><?php echo set_value ( 'address' ) ?></textarea>
                            </div>
                        </div>
                        
                        <div class="row">
                            <div class="form-group col-lg-6">
                                <label>Company</label>
                                <select name="company-id[]" class="form-control select2" data-placeholder="Select"
                                        onchange="getCompanyShifts(this.value, 0)">
                                    <option></option>
                                    <?php
                                        if ( count ( $companies ) > 0 ) {
                                            foreach ( $companies as $company ) {
                                                ?>
                                                <option value="<?php echo $company -> id; ?>">
                                                    <?php echo $company -> title; ?>
                                                </option>
                                                <?php
                                            }
                                        }
                                    ?>
                                </select>
                            </div>
                            
                            <div class="form-group col-lg-3">
                                <label>Shift</label>
                                <select name="shift-id[]" class="form-control select2" data-placeholder="Select"
                                        id="shifts-0">
                                    <option></option>
                                </select>
                            </div>
                            
                            <div class="form-group col-lg-3">
                                <label>Salary</label>
                                <input type="number" step="0.01" placeholder="Salary" class="form-control"
                                       name="salary[]"
                                       value="<?php echo set_value ( 'salary' ) ?>">
                            </div>
                        </div>
                        
                        <div id="addMoreCompaniesRow"></div>
                    
                    </div>
                    <div class="card-footer pt-0">
                        <a href="javascript:void(0)" id="addMoreCompanies" onclick="addMoreCompanies()"
                           class="btn btn-dark mr-1"
                           type="submit">Add More</a>
                        <button class="btn btn-primary mr-1" type="submit">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>