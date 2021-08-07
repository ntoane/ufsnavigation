<!-- Breadcrumbs-->
<ol class="breadcrumb">
    <li class="breadcrumb-item">
        <a href="<?=base_url() . 'student';?>">Students</a>
    </li>
    <li class="breadcrumb-item active">Create Student Account</li>
</ol>

<div class="card shadow-sm mb-2">
<div class="card-body">
    <div class="row">
    <div class="col-md-12 mx-auto">

<form action="<?= base_url() . 'student/create' ?>" method="POST">
    <div class="row">
        <div class="form-group col-md-6">
            <label for="std_number"><strong>Student Number</strong></label>
            <input type="number" name="std_number" class="form-control" required />
        </div>
    </div>
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
            <label for="email"><strong>Email</strong></label>
            <input type="email" name="email" class="form-control" required />
        </div>
    </div>
    <div class="row mt-4">
        <div class="form-group col-md-4">
            <input class="btn btn-primary btn-block" name="submit_student" type="submit" value="Add Student" />
        </div>
        <div class="form-group col-md-2">
            <a href="<?= base_url().'student'; ?>" class="btn btn-dark btn-block">Cancel</a>
        </div>
    </div>
</form>

</div>
    </div>
</div>
</div>