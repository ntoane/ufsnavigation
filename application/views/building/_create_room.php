<!-- Breadcrumbs-->
<ol class="breadcrumb">
    <li class="breadcrumb-item">
        <a href="<?=base_url() . 'building';?>">Buildings</a>
    </li>
    <li class="breadcrumb-item active">New Room</li>
</ol>

<div class="card shadow-sm mb-2">
<div class="card-body">
    <div class="row">
    <div class="col-md-12 mx-auto">

<form action="<?= base_url() . 'building/create_room' ?>" method="POST">
<div class="row">
    <div class="col-md-6">
        <div class="form-group">
            <label for="room_type"><strong>Room or Toilet<span class="text-danger">*</span></strong></label>
            <select name="room_type" class="form-control" required="">
                <option value="1">Room</option>
                <option value="2">Male Toilet</option>
                <option value="3">Female Toilet</option>
            </select>
        </div>
        <div class="form-group">
            <label for="building_id"><strong>Building Name<span class="text-danger">*</span></strong></label>
            <select name="building_id" class="form-control" required="">
                <option value="" selected="" disabled="">Select Building</option>
                <?php
                foreach ($buildings as $building) {
                    ?>
                    <option value="<?=$building['building_id'];?>"><?=$building['building_name'];?></option>
                    <?php
                }
                ?>
            </select>
        </div>
        <div class="form-group">
            <label for="level"><strong>Level<span class="text-danger">*</span></strong></label>
            <input type="number" name="level" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="name_name"><strong>Room Name<span class="text-danger">*</span></strong></label>
            <input type="text" name="room_name" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="description"><strong>Room Description</strong></label>
            <textarea class="form-control" rows="5" name="description"></textarea required>
        </div>
        <div class="form-group">
            <input class="btn btn-primary" name="submit_room" type="submit" value="Add Room" />
            <a href="<?= base_url().'building'; ?>" class="btn btn-dark">Cancel</a>
        </div>
    </div>
    </div>
</form>

</div>
    </div>
</div>
</div>