<div class="row">
    <div class="form-group col-lg-6">
        <label>Company</label>
        <select name="company-id[]" class="form-control select2-<?php echo $row ?>" data-placeholder="Select"
                onchange="getCompanyShifts(this.value, <?php echo $row ?>)">
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
        <select name="shift-id[]" class="form-control select2-<?php echo $row ?>" data-placeholder="Select"
                id="shifts-<?php echo $row ?>">
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