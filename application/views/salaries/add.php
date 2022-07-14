<div class="section-body">
    <div class="row">
        <div class="col-12 col-md-12 col-lg-12">
            <?php form_validations (); ?>
            <?php require_once 'search-card.php' ?>
            
            <div class="card">
                <div class="card-header">
                    <h4><?php echo $title ?></h4>
                </div>
                <form method="post">
                    <?php csrf_field (); ?>
                    <?php hidden_action_field ( 'process-add-salary-sheet' ); ?>
                    <input type="hidden" name="company-id"
                           value="<?php echo $this -> input -> get ( 'company-id' ) ?>">
                    <input type="hidden" name="shift-id"
                           value="<?php echo $this -> input -> get ( 'shift-id' ) ?>">
                    <input type="hidden" name="salary-date"
                           value="<?php echo $this -> input -> get ( 'salary-date' ) ?>">
                    <div class="card-body pb-0">
                        <table class="table table-bordered table-striped attendance-list">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>Name</th>
                                <th>Net Salary</th>
                                <th>Month</th>
                                <th>No. of Days</th>
                                <th>No. of Hours</th>
                                <th>No. of Days Present</th>
                                <th>No. of Days Absent</th>
                                <th>No. of Leaves</th>
                                <th>Late Arrivals (Hours)</th>
                                <th>No. of Hours Worked</th>
                                <th>Gross Salary Salary</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php
                                $counter = 1;
                                $netPayable = 0;
                                $date = date ( 'Y-m-d', strtotime ( $this -> input -> get ( 'salary-date' ) ) );
                                if ( count ( $employees ) > 0 ) {
                                    foreach ( $employees as $employee ) {
                                        $netSalary = $employee -> salary;
                                        $monthDays = countWorkingDays ( date ( 'Y', strtotime ( $date ) ), date ( 'm', strtotime ( $date ) ) );
                                        $shiftStartTime = strtotime ( $shiftInfo -> start_time );
                                        $shiftEndTime = strtotime ( $shiftInfo -> end_time );
                                        $shiftHours = ( round ( abs ( $shiftEndTime - $shiftStartTime ) / 3600, 2 ) );
                                        $noOfHours = $shiftHours * $monthDays;
                                        
                                        $totalNoOfPresents = get_attendance_count_by_month_year ( $employee -> id, date ( 'Y-m', strtotime ( $date ) ), PRESENT_STATUS );
                                        $totalNoOfAbsents = get_attendance_count_by_month_year ( $employee -> id, date ( 'Y-m', strtotime ( $date ) ), ABSENT_STATUS );
                                        $totalNoOfLeaves = get_attendance_count_by_month_year ( $employee -> id, date ( 'Y-m', strtotime ( $date ) ), LEAVE_STATUS );
                                        $totalNoOfLateArrivals = get_attendance_count_by_month_year ( $employee -> id, date ( 'Y-m', strtotime ( $date ) ), LATE_ARRIVAL_STATUS );
                                        $totalHoursOfLateArrivals = get_attendance_late_arrivals_count_by_month_year ( $employee -> id, date ( 'Y-m', strtotime ( $date ) ), LATE_ARRIVAL_STATUS );
                                        
                                        $noOfHoursWorked = ( $shiftHours * ( $totalNoOfPresents + $totalNoOfLateArrivals ) ) - $totalHoursOfLateArrivals;
                                        $perHourSalary = ( $netSalary / $noOfHours );
                                        $grossSalary = $noOfHoursWorked * $perHourSalary;
                                        $netPayable = $netPayable + $grossSalary;
                                        
                                        ?>
                                        <input type="hidden" name="employee-id[]"
                                               value="<?php echo $employee -> id ?>">
                                        
                                        <input type="hidden" name="net-salary[]"
                                               value="<?php echo $netSalary ?>">
                                        
                                        <input type="hidden" name="total-hours[]"
                                               value="<?php echo $noOfHours ?>">
                                        
                                        <input type="hidden" name="days-present[]"
                                               value="<?php echo $totalNoOfPresents ?>">
                                        
                                        <input type="hidden" name="days-absent[]"
                                               value="<?php echo $totalNoOfAbsents ?>">
                                        
                                        <input type="hidden" name="days-leave[]"
                                               value="<?php echo $totalNoOfLeaves ?>">
                                        
                                        <input type="hidden" name="late-arrivals[]"
                                               value="<?php echo $totalNoOfLateArrivals ?>">
                                        
                                        <input type="hidden" name="late-arrival-hours[]"
                                               value="<?php echo $totalHoursOfLateArrivals ?>">
                                        
                                        <input type="hidden" name="hours-worked[]"
                                               value="<?php echo $noOfHoursWorked ?>">
                                        
                                        <input type="hidden" name="gross-salary[]"
                                               value="<?php echo $grossSalary ?>">
                                        <tr>
                                            <td>
                                                <?php echo $counter++ ?>
                                            </td>
                                            <td>
                                                <?php echo $employee -> first_name . ' ' . $employee -> last_name ?>
                                            </td>
                                            <td>
                                                <?php echo number_format ( $netSalary, 2 ) ?>
                                            </td>
                                            <td>
                                                <?php echo date ( "F", strtotime ( $date ) ); ?>
                                            </td>
                                            <td>
                                                <?php echo $monthDays ?>
                                            </td>
                                            <td>
                                                <?php echo $noOfHours; ?>
                                            </td>
                                            <td>
                                                <?php echo ( $totalNoOfPresents + $totalNoOfLateArrivals ) ?>
                                            </td>
                                            <td>
                                                <?php echo $totalNoOfAbsents ?>
                                            </td>
                                            <td>
                                                <?php echo $totalNoOfLeaves ?>
                                            </td>
                                            <td>
                                                <?php echo $totalHoursOfLateArrivals > 0 ? $totalHoursOfLateArrivals : 0 ?>
                                            </td>
                                            <td>
                                                <?php echo $noOfHoursWorked; ?>
                                            </td>
                                            <td>
                                                <?php echo number_format ( $grossSalary, 2 ) ?>
                                            </td>
                                        </tr>
                                        <?php
                                    }
                                    ?>
                                    <tr>
                                        <td colspan="11" align="right">
                                            <strong>Net Payable</strong>
                                        </td>
                                        <td>
                                            <?php echo number_format ( $netPayable, 2 ) ?>
                                        </td>
                                    </tr>
                                    <?php
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