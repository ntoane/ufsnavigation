<!-- Breadcrumbs-->
<ol class="breadcrumb">
    <li class="breadcrumb-item">
        <a href="<?=base_url() . 'admin';?>">Admins</a>
    </li>
    <li class="breadcrumb-item active">Admins List</li>
</ol>

<div class="card shadow-sm mb-2">
<div class="card-body">
    <div class="row">
    <div class="text-right mb-2">
        <a class="btn btn-primary btn-sm" href="<?php echo base_url().'admin/create';?> "><i class="fa fa-plus"></i> New User</a>
    </div>
        <table id="data-table" class="table table-striped table-hover dt-responsive" style="width:100%">
            <thead>
                <tr>
                    <th>First Name</th>
                    <th>Last Name</th>
                    <th>Email (<small>username</small>)</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                foreach ($admins as $admin) {
                    ?>
                    <tr>
                        <td><?= $admin['fname']; ?></td>
                        <td><?= $admin['lname']; ?></td>
                        <td><?= $admin['email']; ?></td>
                        <td>
                            <div class="btn-group">
                                <a href="<?= base_url() . 'admin/edit/' . $admin['admin_id']; ?>" class="btn btn-primary btn-sm mr-1" data-toggle="tooltip" data-placement="top" title="Edit Admin User"><i class="fa fa-edit"></i></a>
                                <a href="#" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#deleteAdmin" data-recordid="<?=$admin['admin_id']?>" data-placement="top" title="Delete Admin User"><i class="fa fa-trash"></i></a>
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
<div class="modal fade" id="deleteAdmin" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-confirm">
        <div class="modal-content">
            <div class="modal-header">
                <div class="icon-box">
                    <i class="fa fa-trash text-danger"></i> Delete Admin User
                </div>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            </div>
            <div class="modal-body">
                <p>Are you sure you want to delete this Admin User?</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                <a href="#" id="adminRecord" class="btn btn-danger"><span class="text-white">Delete</span></a>
            </div>
        </div>
    </div>
</div>