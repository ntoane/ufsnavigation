<!-- Breadcrumbs-->
<ol class="breadcrumb">
    <li class="breadcrumb-item">
        <a href="<?=base_url() . 'building';?>">Dashboard</a>
    </li>
    <li class="breadcrumb-item active">Parkings Categories</li>
</ol>

<div class="card shadow-sm mb-2">
<div class="card-body">
    <div class="row">
    <div class="text-right mb-2">
        <a class="btn btn-primary btn-sm" href="<?php echo base_url().'parking/create_cat';?> "><i class="fa fa-plus"></i> New Category</a>
    </div>
    <hr>
    <br><br>
    <div class="table-responsive">
        <table class="table table-striped table-hover dt-responsive" style="width:100%">
            <thead>
                <tr>
                    <th>Parking Category Name</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                foreach ($parking_categories as $cat) {
                    ?>
                    <tr>
                        <td><?= $cat['cat_name']; ?></td>
                        <td>
                            <div class="btn-group">
                                <a href="<?= base_url() . 'parking/edit_cat/' . $cat['cat_id']; ?>" class="btn btn-primary btn-sm mr-1" data-toggle="tooltip" data-placement="top" title="Edit this parking category"><i class="fa fa-edit"></i></a>
                                <a href="#" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#deleteParkingCategory" data-recordid="<?=$cat['cat_id']?>" data-placement="top" title="Delete this parking category"><i class="fa fa-trash"></i></a>
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
</div>


<!------------------Modals------------------------------->
<div class="modal fade" id="deleteParkingCategory" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-confirm">
        <div class="modal-content">
            <div class="modal-header">
                <div class="icon-box">
                    <i class="fa fa-trash text-danger"></i> Delete Parking Category
                </div>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            </div>
            <div class="modal-body">
                <p>Are you sure you want to delete this Parking category?</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                <a href="#" id="parkingCategoryRecord" class="btn btn-danger"><span class="text-white">Delete</span></a>
            </div>
        </div>
    </div>
</div>