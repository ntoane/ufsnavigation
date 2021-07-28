<!-- Breadcrumbs-->
<ol class="breadcrumb">
    <li class="breadcrumb-item">
        <a href="<?=base_url() . 'dashboard';?>">Dashboard</a>
    </li>
    <li class="breadcrumb-item active">Buildings</li>
</ol>

<div class="card shadow-sm mb-2">
<div class="card-body">
    <div class="row">
    <div class="text-right mb-2">
        <a class="btn btn-primary btn-sm" href="<?php echo base_url().'building/create';?> "><i class="fa fa-plus"></i> New Building</a>
    </div>
    <hr>
    <br><br>
    <div class="table-responsive">
        <table id="dataTable" class="table table-striped table-hover dt-responsive" style="width:100%">
            <thead>
                <tr>
                    <th>Building Name</th>
                    <th>GPS Coordinates</th>
                    <th>Description</th>
                    <th>Images</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                foreach ($buildings as $building) {
                    ?>
                    <tr>
                        <td><?= $building['building_name']; ?></td>
                        <td>
                            <a target="_blank" href="<?= 'https://maps.google.com/?q='.$building['lat_coordinate'] . ',' . $building['lon_coordinate']; ?>"><?= $building['lat_coordinate'] . ',' . $building['lon_coordinate']; ?></a>
                        </td>
                        <td><?= $building['description']; ?></td>
                        <td>
                            <?php 
                                $images = $this->image->get_building_images($building['building_id']);
                                foreach($images as $image) {
                                    echo $image['url'] . ',';
                                }
                            ?>
                        </td>
                        <td>
                            <div class="btn-group">
                                <a href="<?= base_url() . 'building/edit/' . $building['building_id']; ?>" class="btn btn-primary btn-sm mr-1" data-toggle="tooltip" data-placement="top" title="Edit this building"><i class="fa fa-edit"></i></a>
                                <a href="#" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#deleteBuilding" data-recordid="<?=$building['building_id']?>" data-placement="top" title="Delete this building"><i class="fa fa-trash"></i></a>
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