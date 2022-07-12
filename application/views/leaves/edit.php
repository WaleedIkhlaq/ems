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
                    <?php hidden_action_field ( 'process-update-leaves' ); ?>
                    <input type="hidden" name="id" value="<?php echo encrypt_string ( $leave -> id ) ?>">
                    <div class="card-body pb-0">
                        <div class="row">
                            <div class="form-group col-lg-12">
                                <label>Title</label>
                                <input type="text" placeholder="Title" required="required" autofocus="autofocus"
                                       class="form-control" name="title" value="<?php echo $leave -> title ?>">
                            </div>
                        </div>
                    </div>
                    <div class="card-footer pt-0">
                        <button class="btn btn-primary mr-1" type="submit">Update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>