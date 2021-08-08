<!-- Breadcrumbs-->
<ol class="breadcrumb">
    <li class="breadcrumb-item">
        <a href="<?=base_url() . 'module';?>">Modules</a>
    </li>
    <li class="breadcrumb-item active">Update Module</li>
</ol>

<div class="card shadow-sm mb-2">
<div class="card-body">
    <div class="row">
    <div class="col-md-12 mx-auto">
        <!-- Page Content --> 
        <form action="<?= base_url() . 'module/edit' ?>" method="POST">
            <input type="hidden" name="module_code" value="<?= (!empty($module)) ? $module->module_code : ''; ?>" />
            <div class="row">
                <h6>Update module name for module code: <strong><?= (!empty($module)) ? $module->module_code : ''; ?></strong></h6>
            </div>
            <div class="row">
                <div class="form-group col-md-6">
                    <label for="module_name"><strong>Module Name</strong></label>
                    <input type="text" name="module_name" class="form-control" value="<?= (!empty($module)) ? $module->module_name : ''; ?>" required />
                </div>
            </div>
            <div class="row mt-4">
                <div class="form-group col-md-4">
                    <input class="btn btn-primary btn-block" name="update_module" type="submit" value="Save Changes" />
                </div>
                <div class="form-group col-md-2">
                    <a href="<?= base_url() . 'module'; ?>" class="btn btn-dark btn-block">Cancel</a>
                </div>
            </div>
        </form>
    </div>
    </div>
</div>
</div>