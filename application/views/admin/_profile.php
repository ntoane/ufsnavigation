<!-- Breadcrumbs-->
<ol class="breadcrumb">
    <li class="breadcrumb-item">
        <a href="<?=base_url() . 'admin';?>">Admins</a>
    </li>
    <li class="breadcrumb-item active">Update Profile</li>
</ol>

<div class="card shadow-sm mb-2">
<div class="card-body">
    <!-- Page Content --> 
    <div class="row">
    <!----Column 1----->
    <div class="col-md-6 mx-auto">
        <h5>Update your details</h5>
        <hr>
        <form action="<?= base_url() . 'admin/edit' ?>" method="POST">
            <input type="hidden" name="admin_id" value="<?= (!empty($admin)) ? $admin->admin_id : ''; ?>" />
            <div class="row">
                <div class="form-group col-md-12">
                    <label for="fname"><strong>Firstname</strong></label>
                    <input type="text" name="fname" class="form-control" value="<?= (!empty($admin)) ? $admin->fname : ''; ?>" required />
                </div>
            </div>
            <div class="row">
                <div class="form-group col-md-12">
                    <label for="lname"><strong>Lastname</strong></label>
                    <input type="text" name="lname" class="form-control" value="<?= (!empty($admin)) ? $admin->lname : ''; ?>" required />
                </div>
            </div>
            <div class="row">
                <div class="form-group col-md-12">
                    <label for="email"><strong>Email</strong></label>
                    <input type="email" name="email" class="form-control" value="<?= (!empty($admin)) ? $admin->email : ''; ?>" required />
                </div>
            </div>
            <div class="row mt-4">
                <div class="form-group col-md-12">
                    <input class="btn btn-primary btn-block" name="update_admin" type="submit" value="Save Changes" />
                </div>
            </div>
        </form>
    </div>
    <!------spacer column 2---->
    <div class="col-md-1"></div>
    <!----Column 3----->
    <div class="col-md-5 mx-auto">
    <h5>Change your password</h5>
    <hr>
    <form action="<?= base_url() . 'admin/change_password' ?>" method="POST">
            <div class="row">
                <div class="form-group col-md-12">
                    <label for="old_password"><strong>Old Password</strong></label>
                    <input type="password" name="old_password" class="form-control" required />
                </div>
            </div>
            <div class="row">
                <div class="form-group col-md-12">
                    <label for="new_password"><strong>New Password</strong></label>
                    <input type="password" name="new_password" class="form-control" required />
                </div>
            </div>
            <div class="row">
                <div class="form-group col-md-12">
                    <label for="confirm_password"><strong>Repeat Password</strong></label>
                    <input type="password" name="confirm_password" class="form-control" required />
                </div>
            </div>
            <div class="row mt-12">
                <div class="form-group col-md-12">
                    <input class="btn btn-primary btn-block" name="update_password" type="submit" value="Save Changes" />
                </div>
            </div>
        </form>
    </div>
    </div>
</div>
</div>