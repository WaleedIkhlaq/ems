<div class="card">
    <div class="card-header">
        <h4><?php echo $title ?></h4>
    </div>
    <form method="get">
        <div class="card-body pb-0">
            <div class="row">
                <div class="form-group offset-2 col-lg-3">
                    <label>Company</label>
                    <select name="company-id" class="form-control select2" data-placeholder="Select"
                            onchange="getCompanyShifts(this.value, 0)" required="required">
                        <option></option>
                        <?php
                            if ( count ( $companies ) > 0 ) {
                                foreach ( $companies as $company ) {
                                    ?>
                                    <option value="<?php echo $company -> id; ?>" <?php echo $company -> id == @$_GET[ 'company-id' ] ? 'selected="selected"' : '' ?>>
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
                    <select name="shift-id" class="form-control select2" data-placeholder="Select"
                            id="shifts-0" required="required">
                        <option></option>
                        <?php
                            if ( count ( $shifts ) > 0 ) {
                                foreach ( $shifts as $shift ) {
                                    ?>
                                    <option value="<?php echo $shift -> id; ?>" <?php echo $shift -> id == @$_GET[ 'shift-id' ] ? 'selected="selected"' : '' ?>>
                                        <?php echo $shift -> title; ?>
                                        (<?php echo time_format ( $shift -> start_time ) . ' - ' . time_format ( $shift -> end_time ) ?>)
                                    </option>
                                    <?php
                                }
                            }
                        ?>
                    </select>
                </div>
                
                <div class="form-group col-lg-1">
                    <button class="btn btn-primary mr-1" style="margin-top: 28px" type="submit">Submit</button>
                </div>
            </div>
        </div>
    </form>
</div>