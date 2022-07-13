<div class="section-body">
    <div class="row">
        <div class="col-12">
            <?php form_validations (); ?>
            <?php require_once 'search-attendance.php'; ?>
            <div class="card">
                <div class="card-header">
                    <h4><?php echo $title ?></h4>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped" id="table-1">
                            <thead>
                            <tr>
                                <th class="text-center">#</th>
                                <th>Attendance Date</th>
                                <th>Company</th>
                                <th>Shift</th>
                                <th>Present</th>
                                <th>Absent</th>
                                <th>Leave</th>
                                <th>Late Arrival</th>
                                <th>Strength</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php
                                $counter = 1;
                                if ( count ( $attendances ) > 0 ) {
                                    foreach ( $attendances as $attendance ) {
                                        $company = get_company_by_id ( $attendance -> company_id );
                                        $shift = get_shift_by_id ( $attendance -> shift_id );
                                        $totalNoOfPresents = get_attendance_statues ( $attendance -> id, PRESENT_STATUS );
                                        $totalNoOfAbsents = get_attendance_statues ( $attendance -> id, ABSENT_STATUS );
                                        $totalNoOfLeaves = get_attendance_statues ( $attendance -> id, LEAVE_STATUS );
                                        $totalNoOfLateArrivals = get_attendance_statues ( $attendance -> id, LATE_ARRIVAL_STATUS );
                                        $totalAttendances = ( $totalNoOfPresents + $totalNoOfAbsents + $totalNoOfLeaves + $totalNoOfLateArrivals );
                                        
                                        if ( $totalNoOfAbsents > 0 or $totalNoOfLeaves > 0 )
                                            $strength = ( $totalNoOfPresents / $totalAttendances ) * 100;
                                        else
                                            $strength = 100;
                                        
                                        ?>
                                        <tr>
                                            <td>
                                                <?php echo $counter++ ?>
                                            </td>
                                            <td><?php echo date_setter ( $attendance -> attendance_date ) ?></td>
                                            <td><?php echo $company -> title ?></td>
                                            <td>
                                                <?php
                                                    echo '<strong>' . $shift -> title . '</strong><br/>';
                                                    echo time_format ( $shift -> start_time ) . ' - ' . time_format ( $shift -> end_time ) . '<br/>';
                                                ?>
                                            </td>
                                            <td>
                                                <?php echo $totalNoOfPresents ?>
                                            </td>
                                            <td>
                                                <?php echo $totalNoOfAbsents ?>
                                            </td>
                                            <td>
                                                <?php echo $totalNoOfLeaves ?>
                                            </td>
                                            <td>
                                                <?php echo $totalNoOfLateArrivals ?>
                                            </td>
                                            <td>
                                                <?php echo number_format ( $strength, 2 ) . '%'; ?>
                                            </td>
                                            <td>
                                                <a href="<?php echo base_url ( '/attendance/edit/?id=' . encrypt_string ( $attendance -> id ) ) ?>"
                                                   class="btn btn-sm btn-block btn-primary">Edit</a>
                                                <a href="<?php echo base_url ( '/attendance/delete/?id=' . encrypt_string ( $attendance -> id ) ) ?>"
                                                   class="btn btn-sm btn-block btn-danger"
                                                   onclick="return confirm('Are you sure?')">Delete</a>
                                            </td>
                                        </tr>
                                        <?php
                                    }
                                }
                            ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>