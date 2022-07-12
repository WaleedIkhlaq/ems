<div class="section-body">
    <div class="row">
        <div class="col-12">
            <?php form_validations (); ?>
            <div class="card">
                <div class="card-header">
                    <h4>Basic DataTables</h4>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped" id="table-1">
                            <thead>
                            <tr>
                                <th class="text-center">#</th>
                                <th>Tile</th>
                                <th>Shifts</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php
                                $counter = 1;
                                if ( count ( $companies ) > 0 ) {
                                    foreach ( $companies as $company ) {
                                        ?>
                                        <tr>
                                            <td><?php echo $counter++; ?></td>
                                            <td><?php echo $company -> title ?></td>
                                            <td>
                                                <?php
                                                    if ( isset( $shifts[ $company -> id ] ) and count ( $shifts[ $company -> id ] ) > 0 ) {
                                                        foreach ( $shifts[ $company -> id ] as $shift ) {
                                                            echo '<strong>' . $shift -> title . '</strong><br/>';
                                                            echo time_format ( $shift -> start_time ) . ' - ' . time_format ( $shift -> end_time ) . '<br/>';
                                                        }
                                                    }
                                                    else
                                                        echo '<strong>No shifts added.</strong>';
                                                ?>
                                            </td>
                                            <td>
                                                <a href="<?php echo base_url ( '/companies/edit/?id=' . encrypt_string ( $company -> id ) ) ?>"
                                                   class="btn btn-sm btn-primary">Edit</a>
                                                <a href="<?php echo base_url ( '/companies/delete/?id=' . encrypt_string ( $company -> id ) ) ?>"
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