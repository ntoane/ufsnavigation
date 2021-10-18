<!-- Breadcrumbs-->
<ol class="breadcrumb">
    <li class="breadcrumb-item">
        <a href="<?=base_url() . 'building';?>">Buildings</a>
    </li>
    <li class="breadcrumb-item active">Room Directions</li>
</ol>

<div class="card shadow-sm mb-2">
<div class="card-body">
<div class="row">
    <div class="col-md-6 mx-auto">
        <h6><strong>Enter new directions for <?='Room ' . $room_id;?>, <?=$level_num;?>, <?=$building_name;?></strong></h6>
        <hr>
        <form action="<?= base_url() . 'building/create_room_directions' ?>" method="POST">
            <input type="hidden" name="room_id" value="<?= $room_id ?>">
                <div class="form-group">
                    <label for="entrance"><strong>Entrance:</strong></label>
                    <input type="text" name="entrance" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="directions"><strong>Room Directions:</strong></label>
                    <textarea class="form-control" rows="8" name="directions" required>
                    </textarea>
                </div>
                <div class="form-group">
                    <input class="btn btn-primary" name="submit_room_directions" type="submit" value="Add Directions" />
                    <a href="<?= base_url().'building'; ?>" class="btn btn-dark">Cancel</a>
                </div>
        </form>

    </div>
    <div class="col-md-6 mx-auto">
        <h6><strong>Directions to <?='Room ' . $room_id;?>, <?=$level_num;?>, <?=$building_name;?></strong></h6>
        <hr>
        <table class="table table-bordered table-hover dt-responsive" style="width:100%">
                <thead class="thead-light">
                    <tr>
                        <th>Entrance</th>
                        <th>Directions</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    foreach ($directions as $direct) {
                        ?>
                        <tr>
                            <td><?= $direct['entrance']; ?></td>
                            <td><?= $direct['directions']; ?></td>
                            <td>
                                <div class="btn-group">
                                    <a href="<?= base_url() . 'building/delete_room_direction/' . $direct['room_direction_id'] . '/' . $room_id; ?>" 
                                        class="btn btn-danger btn-sm mr-1" data-toggle="tooltip" data-placement="top" title="Delete this romm directions"><i class="fa fa-trash"></i></a>
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