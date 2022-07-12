<section class="section">
    <div class="container mt-5">
        <div class="row">
            <div class="col-12 col-sm-10 offset-sm-1 col-md-8 offset-md-2 col-lg-6 offset-lg-3 col-xl-6 offset-xl-3">
                <?php form_validations (); ?>
                <div class="card card-primary">
                    <div class="card-header">
                        <h4>Register</h4>
                    </div>
                    <div class="card-body">
                        <form method="post">
                            <?php csrf_field (); ?>
                            <?php hidden_action_field ( 'process-account-creation' ); ?>
                            <div class="row">
                                <div class="form-group col-6">
                                    <label for="first_name">First Name</label>
                                    <input id="first_name" type="text" class="form-control" name="first_name"
                                           autofocus="autofocus" required="required"
                                           value="<?php echo set_value ( 'first_name' ) ?>">
                                </div>
                                <div class="form-group col-6">
                                    <label for="last_name">Last Name</label>
                                    <input id="last_name" type="text" class="form-control" name="last_name"
                                           required="required"
                                           value="<?php echo set_value ( 'last_name' ) ?>">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="email">Email</label>
                                <input id="email" type="email" class="form-control" name="email" required="required"
                                       value="<?php echo set_value ( 'email' ) ?>">
                            </div>
                            <div class="row">
                                <div class="form-group col-12">
                                    <label for="password" class="d-block">Password</label>
                                    <input id="password" type="password" class="form-control" name="password"
                                           required="required">
                                </div>
                            </div>
                            <div class="form-group">
                                <button type="submit" class="btn btn-primary btn-lg btn-block">
                                    Register
                                </button>
                            </div>
                        </form>
                    </div>
                    <div class="mb-4 text-muted text-center">
                        Already Registered? <a href="<?php echo base_url ( '/' ); ?>">Login</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>