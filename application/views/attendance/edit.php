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
                    <?php hidden_action_field ( 'process-update-attendance' ); ?>
                    <input type="hidden" name="attendances-id"
                           value="<?php echo encrypt_string ( $attendances -> id ) ?>">
                    
                    <div class="card-body pb-0">
                        
                        <div class="attendance-info">
                            <ul>
                                <li>
                                    Attendance Marked On:
                                    <strong><?php echo date_setter ( $attendances -> attendance_date ) ?></strong>
                                </li>
                                <li>
                                    Company:
                                    <strong>
                                        <?php
                                            $company = get_company_by_id ( $attendances -> company_id );
                                            echo $company -> title;
                                        ?>
                                    </strong>
                                </li>
                                <li>
                                    Shift:
                                    <strong>
                                        <?php
                                            $shift = get_shift_by_id ( $attendances -> shift_id );
                                            echo $shift -> title . ' - ';
                                            echo time_format ( $shift -> start_time ) . ' - ' . time_format ( $shift -> end_time );
                                        ?>
                                    </strong>
                                </li>
                            </ul>
                        </div>
                        
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
                                if ( count ( $attendance ) > 0 ) {
                                    foreach ( $attendance as $attend ) {
                                        $employee = get_employee_by_id ( $attend -> employee_id );
                                        ?>
                                        <input type="hidden" name="attendance-id[]" value="<?php echo $attend -> id ?>">
                                        <tr>
                                            <td><?php echo $counter++ ?></td>
                                            <td><?php echo $employee -> first_name . ' ' . $employee -> last_name ?></td>
                                            <td><?php echo $employee -> contact_no ?></td>
                                            <td>
                                                <ul>
                                                    <li>
                                                        <input type="radio" name="status[<?php echo $attend -> id ?>]"
                                                               value="<?php echo PRESENT_STATUS ?>" <?php echo $attend -> status == PRESENT_STATUS ? 'checked="checked"' : '' ?>
                                                               onclick="if_late_arrival(<?php echo $attend -> id ?>)">
                                                        <span>Present</span>
                                                    </li>
                                                    <li>
                                                        <input type="radio" name="status[<?php echo $attend -> id ?>]"
                                                               value="<?php echo ABSENT_STATUS ?>" <?php echo $attend -> status == ABSENT_STATUS ? 'checked="checked"' : '' ?>
                                                               onclick="if_late_arrival(<?php echo $attend -> id ?>)">
                                                        <span>Absent</span>
                                                    </li>
                                                    <li>
                                                        <input type="radio" name="status[<?php echo $attend -> id ?>]"
                                                               value="<?php echo LEAVE_STATUS ?>" <?php echo $attend -> status == LEAVE_STATUS ? 'checked="checked"' : '' ?>
                                                               onclick="if_late_arrival(<?php echo $attend -> id ?>)">
                                                        <span>Leave</span>
                                                    </li>
                                                    <li>
                                                        <input type="radio" name="status[<?php echo $attend -> id ?>]"
                                                               value="<?php echo LATE_ARRIVAL_STATUS ?>" <?php echo $attend -> status == LATE_ARRIVAL_STATUS ? 'checked="checked"' : '' ?>
                                                               id="late-arrival-<?php echo $attend -> id ?>"
                                                               onclick="if_late_arrival(<?php echo $attend -> id ?>)">
                                                        <span>Late Arrival</span>
                                                        
                                                        <div class="late-arrival late-hours-<?php echo $attend -> id ?>"
                                                             style="<?php echo $attend -> status == LATE_ARRIVAL_STATUS ? 'display: flex"' : '' ?>">
                                                            <input type="number" step="0.01"
                                                                   name="late-hours[<?php echo $attend -> id ?>]"
                                                                   class="form-control" placeholder="Hours"
                                                                   value="<?php echo $attend -> late_hours ?>">
                                                        </div>
                                                    
                                                    </li>
                                                </ul>
                                            </td>
                                            <td>
                                                <textarea name="remarks[<?php echo $attend -> id ?>]"
                                                          class="form-control no-resize"
                                                          rows="3"><?php echo $attend -> remarks ?></textarea>
                                            </td>
                                        </tr>
                                        <?php
                                    }
                                }
                            ?>
                            </tbody>
                            <tfoot>
                            <tr>
                                <td></td>
                                <td colspan="2">
                                    <button type="submit" class="btn btn-primary">Update</button>
                                </td>
                            </tr>
                            </tfoot>
                        </table>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>