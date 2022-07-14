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
                                <th>Salary Month</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php
                                $counter = 1;
                                if ( count ( $salaries ) > 0 ) {
                                    foreach ( $salaries as $salary ) {
                                        $company = get_company_by_id ( $salary -> company_id );
                                        $shift = get_shift_by_id ( $salary -> shift_id );
                                        ?>
                                        <tr>
                                            <td><?php echo $counter++; ?></td>
                                            <td><?php echo $company -> title ?></td>
                                            <td>
                                                <?php
                                                    echo '<strong>' . $shift -> title . '</strong><br/>';
                                                    echo time_format ( $shift -> start_time ) . ' - ' . time_format ( $shift -> end_time ) . '<br/>';
                                                ?>
                                            </td>
                                            <td><?php echo date ( 'Y-m', strtotime ( $salary -> salary_date ) ) ?></td>
                                            <td>
                                                <a href="<?php echo base_url ( '/salaries/edit/?id=' . encrypt_string ( $salary -> id ) ) ?>"
                                                   class="btn btn-sm btn-primary">Edit</a>
                                                <a href="<?php echo base_url ( '/salaries/delete/?id=' . encrypt_string ( $salary -> id ) ) ?>"
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