<!-- Breadcrumbs-->
<ol class="breadcrumb">
    <li class="breadcrumb-item">
        <a href="<?=base_url() . 'dashboard';?>">Dashboard</a>
    </li>
    <li class="breadcrumb-item active">Modules List</li>
</ol>

<div class="card shadow-sm mb-2">
<div class="card-body">
    <div class="row">
    <div class="text-right mb-2">
        <a class="btn btn-primary btn-sm" href="<?php echo base_url().'module/create';?> "><i class="fa fa-plus"></i> New Module</a>
    </div>
        <table id="data-table" class="table table-striped table-hover dt-responsive" style="width:100%">
            <thead>
                <tr>
                    <th>Module Code</th>
                    <th>Module Name</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                foreach ($modules as $module) {
                    ?>
                    <tr>
                        <td><?= $module['module_code']; ?></td>
                        <td><?= $module['module_name']; ?></td>
                        <td>
                            <div class="btn-group">
                                <a href="<?= base_url() . 'module/edit/' . $module['module_code']; ?>" class="btn btn-primary btn-sm mr-1" data-toggle="tooltip" data-placement="top" title="Edit this module"><i class="fa fa-edit"></i></a>
                                <a href="#" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#deleteModule" data-recordid="<?=$module['module_code']?>" data-placement="top" title="Delete this module"><i class="fa fa-trash"></i></a>
                            </div>
                        </td>
                    </tr>
                    <?php
                }
                ?>
            </tbody>
        </table>
    </div>
</div>
</div>

<!------------------Modals------------------------------->
<div class="modal fade" id="deleteModule" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-confirm">
        <div class="modal-content">
            <div class="modal-header">
                <div class="icon-box">
                    <i class="fa fa-trash text-danger"></i> Delete Module
                </div>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            </div>
            <div class="modal-body">
                <p>Are you sure you want to delete this Module?</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                <a href="#" id="moduleRecord" class="btn btn-danger"><span class="text-white">Delete</span></a>
            </div>
        </div>
    </div>
</div>