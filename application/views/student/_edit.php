<!-- Breadcrumbs-->
<ol class="breadcrumb">
    <li class="breadcrumb-item">
        <a href="<?=base_url() . 'student';?>">Students</a>
    </li>
    <li class="breadcrumb-item active">Update Student</li>
</ol>

<div class="card shadow-sm mb-2">
<div class="card-body">
    <div class="row">
    <div class="col-md-12 mx-auto">
        <!-- Page Content --> 
        <form action="<?= base_url() . 'student/edit' ?>" method="POST">
            <input type="hidden" name="std_number" value="<?= (!empty($student)) ? $student->std_number : ''; ?>" />
            <div class="row">
                <h6>Update particulars of student number: <strong><?= (!empty($student)) ? $student->std_number : ''; ?></strong></h6>
            </div>
            <div class="row">
                <div class="form-group col-md-6">
                    <label for="fname"><strong>Firstname</strong></label>
                    <input type="text" name="fname" class="form-control" value="<?= (!empty($student)) ? $student->std_fname : ''; ?>" required />
                </div>
            </div>
            <div class="row">
                <div class="form-group col-md-6">
                    <label for="lname"><strong>Lastname</strong></label>
                    <input type="text" name="lname" class="form-control" value="<?= (!empty($student)) ? $student->std_lname : ''; ?>" required />
                </div>
            </div>
            <div class="row mt-4">
                <div class="form-group col-md-4">
                    <input class="btn btn-primary btn-block" name="update_student" type="submit" value="Save Changes" />
                </div>
                <div class="form-group col-md-2">
                    <a href="<?= base_url() . 'student'; ?>" class="btn btn-dark btn-block">Cancel</a>
                </div>
            </div>
        </form>
    </div>
    </div>
</div>
</div>