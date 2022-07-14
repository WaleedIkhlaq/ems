<div class="section-body">
    <div class="row">
        <div class="col-12 col-md-12 col-lg-12">
            <?php form_validations (); ?>
            <?php require_once 'search-card.php'; ?>
            
            <div class="card">
                <form method="post">
                    <?php csrf_field (); ?>
                    <?php hidden_action_field ( 'process-mark-attendance' ); ?>
                    <input type="hidden" name="company-id"
                           value="<?php echo $this -> input -> get ( 'company-id' ) ?>">
                    <input type="hidden" name="shift-id"
                           value="<?php echo $this -> input -> get ( 'shift-id' ) ?>">
                    <div class="card-body pb-0">
                        <table class="table table-bordered table-striped attendance-list">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>Name</th>
                                <th>Contact</th>
                                <th>Status</th>
                                <th>Remarks</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php
                                $counter = 1;
                                if ( count ( $employees ) > 0 ) {
                                    foreach ( $employees as $employee ) {
                                        $isOnLeave = is_employee_on_leave ( $employee -> id, $this -> input -> get ( 'company-id' ), $this -> input -> get ( 'shift-id' ) );
                                        ?>
                                        <input type="hidden" name="employee-id[]" value="<?php echo $employee -> id ?>">
                                        <tr>
                                            <td><?php echo $counter++ ?></td>
                                            <td><?php echo $employee -> first_name . ' ' . $employee -> last_name ?></td>
                                            <td><?php echo $employee -> contact_no ?></td>
                                            <td>
                                                <ul>
                                                    <li>
                                                        <input type="radio" name="status[<?php echo $employee -> id ?>]"
                                                               value="<?php echo PRESENT_STATUS ?>"
                                                            <?php echo ( empty( $isOnLeave ) ) ? 'checked="checked"' : '' ?>
                                                               onclick="if_late_arrival(<?php echo $employee -> id ?>)">
                                                        <span>Present</span>
                                                    </li>
                                                    <li>
                                                        <input type="radio" name="status[<?php echo $employee -> id ?>]"
                                                               value="<?php echo ABSENT_STATUS ?>"
                                                               onclick="if_late_arrival(<?php echo $employee -> id ?>)">
                                                        <span>Absent</span>
                                                    </li>
                                                    <li>
                                                        <input type="radio" name="status[<?php echo $employee -> id ?>]"
                                                               value="<?php echo LEAVE_STATUS ?>"
                                                               onclick="if_late_arrival(<?php echo $employee -> id ?>)"
                                                            <?php echo ( !empty( $isOnLeave ) ) ? 'checked="checked"' : '' ?>>
                                                        <span>Leave</span>
                                                    </li>
                                                    <li>
                                                        <input type="radio" name="status[<?php echo $employee -> id ?>]"
                                                               value="<?php echo LATE_ARRIVAL_STATUS ?>"
                                                               id="late-arrival-<?php echo $employee -> id ?>"
                                                               onclick="if_late_arrival(<?php echo $employee -> id ?>)">
                                                        <span>Late Arrival</span>
                                                        
                                                        <div class="late-arrival late-hours-<?php echo $employee -> id ?>">
                                                            <input type="number" step="0.01"
                                                                   name="late-hours[<?php echo $employee -> id ?>]"
                                                                   class="form-control" placeholder="Hours" value="0">
                                                        </div>
                                                    </li>
                                                </ul>
                                            </td>
                                            <td>
                                                <textarea name="remarks[<?php echo $employee -> id ?>]"
                                                          class="form-control no-resize"
                                                          rows="3"><?php echo !empty( $isOnLeave ) ? $isOnLeave -> description : '' ?></textarea>
                                            </td>
                                        </tr>
                                        <?php
                                    }
                                }
                            ?>
                            </tbody>
                            <?php if ( count ( $employees ) > 0 ) : ?>
                                <tfoot>
                                <tr>
                                    <td></td>
                                    <td colspan="2">
                                        <button type="submit" class="btn btn-primary">Submit</button>
                                    </td>
                                </tr>
                                </tfoot>
                            <?php endif; ?>
                        </table>
                    </div>
                </form>
            </div>
        
        </div>
    </div>
</div>