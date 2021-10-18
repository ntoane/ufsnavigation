<!-- Breadcrumbs-->
<ol class="breadcrumb">
    <li class="breadcrumb-item">
        <a href="<?=base_url() . 'building';?>">Dashboard</a>
    </li>
    <li class="breadcrumb-item active">Buildings</li>
</ol>

<div class="card shadow-sm mb-2">
<div class="card-body">
    <div class="row">
    <div class="text-left mb-2">
        <a class="btn btn-primary btn-sm" href="<?php echo base_url().'building/create';?> "><i class="fa fa-plus"></i> New Building</a>
    </div>
    <div class="float-right mb-2 pl-2">
        <a class="btn btn-primary btn-sm" href="<?php echo base_url().'building/create_room';?> "><i class="fa fa-plus"></i> New Room</a>
    </div>
    <hr>
    <br><br>
    <div class="table-responsive">
        <table id="dataTable" class="table table-bordered table-hover dt-responsive" style="width:100%">
            <thead class="thead-light">
                <tr>
                    <th>Building Name</th>
                    <th>GPS Location</th>
                    <th>Description</th>
                    <th>Images</th>
                    <th>Levels</th>
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
                            <a target="_blank" href="<?= 'https://www.google.com/maps/@?api=1&map_action=map&center='.$building['lat_coordinate'] . ',' . $building['lon_coordinate'] .'&zoom=18&basemap=satellite'; ?>">
                            View on Map</a>
                        </td>
                        <td><?= $building['description']; ?></td>
                        <td>
                            <?php 
                                $images = $this->image->get_building_images($building['building_id']);
                                foreach($images as $image) {
                                ?>
                                    <a target="_blank" href="<?=base_url().'uploads/buildings/'.$image['url'];?>" ><?=$image['url']?></a> <br>
                                <?php
                                }
                            ?>
                        </td>
                        <td>
                            <!--Load this building's resourcebundle_get_error_message-->
                            <?php 
                                $levels = $this->building->get_building_levels($building['building_id']);
                                foreach($levels as $level) {
                                    echo '<strong>Level '. $level['floor_num'].'</strong>';
                                    $rooms = $this->building->get_building_level_rooms_toilets($level['building_id'], $level['floor_num']);
                                    foreach($rooms as $room) {
                                        ?><p><?php
                                        echo $room['room_name'];
                                        ?>
                                        <a href="<?= base_url() . 'building/room_directions/' . $room['room_id'] . '/' . $level['floor_num'] . '/' . $building['building_name']; ?>" 
                                            class="btn-info btn-sm mt-1" data-toggle="tooltip" data-placement="top" title="Directions to this room"><i class="fa fa-directions"></i></a>
                                        <a href="<?= base_url() . 'building/delete_room/' . $room['room_id']; ?>" class="btn-danger btn-sm mt-1" data-toggle="tooltip" data-placement="top" title="Delete this room"><i class="fa fa-times"></i></a>
                                        </p>
                                        <?
                                    }
                                    echo '<hr>';
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
<div class="modal fade" id="deleteBuilding" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-confirm">
        <div class="modal-content">
            <div class="modal-header">
                <div class="icon-box">
                    <i class="fa fa-trash text-danger"></i> Delete Building Data
                </div>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            </div>
            <div class="modal-body">
                <p>Are you sure you want to delete this Building data?</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                <a href="#" id="buildingRecord" class="btn btn-danger"><span class="text-white">Delete</span></a>
            </div>
        </div>
    </div>
</div>