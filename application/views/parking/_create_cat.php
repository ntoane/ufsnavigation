<!-- Breadcrumbs-->
<ol class="breadcrumb">
    <li class="breadcrumb-item">
        <a href="<?=base_url() . 'parking';?>">Parking Categories</a>
    </li>
    <li class="breadcrumb-item active">Create Parking Category</li>
</ol>

<div class="card shadow-sm mb-2">
<div class="card-body">
    <div class="row">
    <div class="col-md-12 mx-auto">

<form action="<?= base_url() . 'parking/create_cat' ?>" method="POST">
    <div class="row">
        <div class="form-group col-md-6">
            <label for="cat_name"><strong>Category Name</strong></label>
            <input type="text" name="cat_name" class="form-control" required />
        </div>
    </div>
    <div class="row mt-4">
        <div class="form-group col-md-4">
            <input class="btn btn-primary btn-block" name="submit_category" type="submit" value="Add Category" />
        </div>
        <div class="form-group col-md-2">
            <a href="<?= base_url().'parking'; ?>" class="btn btn-dark btn-block">Cancel</a>
        </div>
    </div>
</form>

</div>
    </div>
</div>
</div>