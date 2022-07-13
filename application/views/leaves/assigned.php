<div class="section-body">
    <div class="row">
        <div class="col-12">
            <?php form_validations (); ?>
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
                                <th>Company</th>
                                <th>Shift</th>
                                <th>Employee</th>
                                <th>Start Date</th>
                                <th>End Date</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php
                                $counter = 1;
                                if ( count ( $leaves ) > 0 ) {
                                    foreach ( $leaves as $leave ) {
                                        $company = get_company_by_id ( $leave -> company_id );
                                        $shift = get_shift_by_id ( $leave -> shift_id );
                                        $employee = get_employee_by_id ( $leave -> employee_id );
                                        ?>
                                        <tr>
                                            <td><?php echo $counter++; ?></td>
                                            <td><?php echo $company -> title; ?></td>
                                            <td>
                                                <?php
                                                    echo '<strong>' . $shift -> title . '</strong><br/>';
                                                    echo time_format ( $shift -> start_time ) . ' - ' . time_format ( $shift -> end_time );
                                                ?>
                                            </td>
                                            <td><?php echo $employee -> first_name . ' ' . $employee -> last_name ?></td>
                                            <td><?php echo $leave -> start_date ?></td>
                                            <td><?php echo $leave -> end_date ?></td>
                                            <td><?php echo $leave -> approved == '1' ? 'Approved' : 'Not Approved' ?></td>
                                            <td>
                                                <a href="<?php echo base_url ( '/leaves/assigned/edit/?id=' . encrypt_string ( $leave -> id ) ) ?>"
                                                   class="btn btn-sm btn-primary">Edit</a>
                                                <a href="<?php echo base_url ( '/leaves/assigned/delete/?id=' . encrypt_string ( $leave -> id ) ) ?>"
                                                   class="btn btn-sm btn-danger"
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