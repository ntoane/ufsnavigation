<!-- Breadcrumbs-->
<ol class="breadcrumb">
    <li class="breadcrumb-item">
        <a href="<?=base_url() . 'admin';?>">Admins</a>
    </li>
    <li class="breadcrumb-item active">Create Admin Account</li>
</ol>

<div class="card shadow-sm mb-2">
<div class="card-body">
    <div class="row">
    <div class="col-md-12 mx-auto">

<form action="<?= base_url() . 'admin/create' ?>" method="POST">
    <div class="row">
        <div class="form-group col-md-6">
            <label for="fname"><strong>Firstname</strong></label>
            <input type="text" name="fname" class="form-control" required />
        </div>
    </div>
    <div class="row">
        <div class="form-group col-md-6">
            <label for="lname"><strong>Lastname</strong></label>
            <input type="text" name="lname" class="form-control" required />
        </div>
    </div>
    <div class="row">
        <div class="form-group col-md-6">
            <label for="email"><strong>Email(<small>username</small>)</strong></label>
            <input type="email" name="email" class="form-control" required />
        </div>
    </div>
    <div class="row mt-4">
        <div class="form-group col-md-4">
            <input class="btn btn-primary btn-block" name="submit_admin" type="submit" value="Add Admin" />
        </div>
        <div class="form-group col-md-2">
            <a href="<?= base_url().'admin'; ?>" class="btn btn-dark btn-block">Cancel</a>
        </div>
    </div>
</form>

</div>
    </div>
</div>
</div>