<!-- Breadcrumbs-->
<ol class="breadcrumb">
    <li class="breadcrumb-item">
        <a href="<?=base_url() . 'module';?>">Modules</a>
    </li>
    <li class="breadcrumb-item active">Insert Module</li>
</ol>

<div class="card shadow-sm mb-2">
<div class="card-body">
    <div class="row">
    <div class="col-md-12 mx-auto">

<form action="<?= base_url() . 'module/create' ?>" method="POST">
    <div class="row">
        <div class="form-group col-md-6">
            <label for="module_code"><strong>Module Code</strong></label>
            <input type="text" name="module_code" class="form-control" required />
        </div>
    </div>
    <div class="row">
        <div class="form-group col-md-6">
            <label for="module_name"><strong>Module Name</strong></label>
            <input type="text" name="module_name" class="form-control" required />
        </div>
    </div>
    <div class="row mt-4">
        <div class="form-group col-md-4">
            <input class="btn btn-primary btn-block" name="submit_module" type="submit" value="Add Module" />
        </div>
        <div class="form-group col-md-2">
            <a href="<?= base_url().'module'; ?>" class="btn btn-dark btn-block">Cancel</a>
        </div>
    </div>
</form>

</div>
    </div>
</div>
</div>