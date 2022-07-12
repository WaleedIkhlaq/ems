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
                                <th>Name</th>
                                <th>Email</th>
                                <th>Contact No.</th>
                                <th>Companies</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php
                                $counter = 1;
                                if ( count ( $employees ) > 0 ) {
                                    foreach ( $employees as $employee ) {
                                        ?>
                                        <tr>
                                            <td><?php echo $counter++; ?></td>
                                            <td><?php echo $employee -> first_name . ' ' . $employee -> last_name ?></td>
                                            <td><?php echo $employee -> email ?></td>
                                            <td><?php echo $employee -> contact_no ?></td>
                                            <td></td>
                                            <td>
                                                <a href="<?php echo base_url ( '/employees/edit/?id=' . encrypt_string ( $employee -> id ) ) ?>"
                                                   class="btn btn-sm btn-primary">Edit</a>
                                                <a href="<?php echo base_url ( '/employees/delete/?id=' . encrypt_string ( $employee -> id ) ) ?>"
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