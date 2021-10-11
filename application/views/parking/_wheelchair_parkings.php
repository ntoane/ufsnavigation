<!-- Breadcrumbs-->
<ol class="breadcrumb">
    <li class="breadcrumb-item">
        <a href="<?=base_url() . 'parking';?>">Parking Categories</a>
    </li>
    <li class="breadcrumb-item active">Wheelchair Parkings</li>
</ol>

<div class="card shadow-sm mb-2">
<div class="card-body">
    <div class="row">
    <div class="text-right mb-2">
        <a class="btn btn-primary btn-sm" href="<?php echo base_url().'parking/create_parking';?> "><i class="fa fa-plus"></i> New Parking</a>
    </div>
    <hr>
    <br><br>
    <div class="table-responsive">
        <table id="dataTable" class="table table-striped table-hover dt-responsive" style="width:100%">
            <thead>
                <tr>
                    <th>Parking Name</th>
                    <th>GPS Coordinates</th>
                    <th>Description</th>
                    <th>Images</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                foreach ($wheelchair_parkings as $parking) {
                    ?>
                    <tr>
                        <td><?= $parking['parking_name']; ?></td>
                        <td>
                            <a target="_blank" href="<?= 'https://www.google.com/maps/@?api=1&map_action=map&center='.$parking['lat_coordinate'] . ',' . $parking['lon_coordinate'] .'&zoom=18&basemap=satellite'; ?>">
                            <?= $parking['lat_coordinate'] . ',' . $parking['lon_coordinate']; ?></a>
                        </td>
                        <td><?= $parking['description']; ?></td>
                        <td>
                            <?php 
                                $images = $this->image->get_parking_images($parking['parking_id']);
                                foreach($images as $image) {
                                ?>
                                    <a target="_blank" href="<?=$image['url'];?>" ><?=$image['url']?></a> <br>
                                <?php
                                }
                            ?>
                        </td>
                        <td>
                            <div class="btn-group">
                                <a href="<?= base_url() . 'parking/edit_parking/' . $parking['parking_id']; ?>" class="btn btn-primary btn-sm mr-1" data-toggle="tooltip" data-placement="top" title="Edit this parking"><i class="fa fa-edit"></i></a>
                                <a href="#" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#deleteParking" data-recordid="<?=$parking['parking_id']?>" data-placement="top" title="Delete this parking"><i class="fa fa-trash"></i></a>
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
<div class="modal fade" id="deleteParking" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-confirm">
        <div class="modal-content">
            <div class="modal-header">
                <div class="icon-box">
                    <i class="fa fa-trash text-danger"></i> Delete Parking Data
                </div>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            </div>
            <div class="modal-body">
                <p>Are you sure you want to delete this Parking data?</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                <a href="#" id="parkingRecord" class="btn btn-danger"><span class="text-white">Delete</span></a>
            </div>
        </div>
    </div>
</div>