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
                                <th>Tile</th>
                                <th>Start Time</th>
                                <th>End Time</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php
                                $counter = 1;
                                if ( count ( $shifts ) > 0 ) {
                                    foreach ( $shifts as $shift ) {
                                        ?>
                                        <tr>
                                            <td><?php echo $counter++; ?></td>
                                            <td><?php echo $shift -> title ?></td>
                                            <td><?php echo time_format ( $shift -> start_time ) ?></td>
                                            <td><?php echo time_format ( $shift -> end_time ) ?></td>
                                            <td>
                                                <a href="<?php echo base_url ( '/shifts/edit/?id=' . encrypt_string ( $shift -> id ) ) ?>"
                                                   class="btn btn-sm btn-primary">Edit</a>
                                                <a href="<?php echo base_url ( '/shifts/delete/?id=' . encrypt_string ( $shift -> id ) ) ?>"
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