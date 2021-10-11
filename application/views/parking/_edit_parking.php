<!-- Breadcrumbs-->
<ol class="breadcrumb">
    <li class="breadcrumb-item">
        <a href="<?=base_url() . 'parking/load_car_parkings';?>">Car Parkings</a>
    </li>
    <li class="breadcrumb-item active">Edit parking</li>
</ol>

<div class="card shadow-sm mb-2">
<div class="card-body">
    <div class="row">
    <div class="col-md-12 mx-auto">
        <form action="<?= base_url() . 'parking/edit_parking' ?>" method="POST" enctype="multipart/form-data">
        <input type="hidden" name="parking_id" value="<?= (!empty($parking)) ? $parking->parking_id : ''; ?>" />
        <div class="row">
            <div class="col">
            <div class="row">
                <div class="form-group col-md-12">
                        <label for="cat_id"><strong>Parking Category<span class="text-danger">*</span></strong></label>
                        <select name="cat_id" class="form-control" required="">
                            <?php
                            $parking_cat = $this->parking->get_parking_cat($parking->cat_id);
                            ?>
                            <option value="<?= (!empty($parking)) ? $parking->cat_id : ''; ?>" selected="" ><?= $parking_cat->cat_name?></option>
                            <?php
                            foreach ($parking_categories as $category) {
                                ?>
                                <option value="<?=$category['cat_id'];?>"><?=$category['cat_name'];?></option>
                                <?php
                            }
                            ?>
                    </select>
                </div>
            </div>
            <div class="form-group col-md-12">
                <div><strong>Please choose the parking type below<span class="text-danger">*</span></strong></div>
                <input type="radio" name="parking_type" value="car" <?=($parking->parking_type == 'car') ? 'checked' : '';?> />
                <label for="car_parking">Car parking</label>
                <br>
                <input type="radio" name="parking_type" value="wheelchair" <?=($parking->parking_type == 'wheelchair') ? 'checked' : '';?>/>
                <label for="wheelchair_parking">Wheelchair</label>
            </div>
            <div class="row">
                <div class="form-group col-md-12">
                    <label for="parking_name"><strong>Parking Name<span class="text-danger">*</span></strong></label>
                    <input type="text" name="parking_name" value="<?= (!empty($parking)) ? $parking->parking_name : ''; ?>" class="form-control" required />
                </div>
            </div>
            <div class="row">
                <div class="form-group col-md-12">
                    <label for="lat"><strong>Latitude</strong></label>
                    <input type="text" name="lat" value="<?= (!empty($parking)) ? $parking->lat_coordinate : ''; ?>" class="form-control" required />
                </div>
            </div>
            <div class="row">
                <div class="form-group col-md-12">
                    <label for="lon"><strong>Longitude</strong></label>
                    <input type="text" name="lon" value="<?= (!empty($parking)) ? $parking->lon_coordinate : ''; ?>" class="form-control" required />
                </div>
            </div>
            <div class="row">
            <div class="form-group col-md-12">
                <label for="description">Parking description</label>
                <textarea class="form-control" rows="5" name="description"><?= (!empty($parking)) ? $parking->description : ''; ?></textarea>
            </div>
            </div>
            </div>
            <?php if(!empty($parking_images)) { ?>
            <div class="col" >
                <h6>You can delete some images</h6>
                <div class="row">
                    <?php 
                        foreach($parking_images as $image) {
                        ?>
                        <div class="col-4">
                            <div>
                                <a target="_blank" href="<?= $image['url'];?>"> 
                                    <img class="rounded mx-auto d-block mt-2" src="<?= $image['url'];?>" width="130" height="120">
                                </a>
                            </div>
                            <div class="mt-1 text-center">
                            <a href="#" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#removeParkingImage" 
                                data-recordid="<?= $image['image_id'] ?>" 
                                data-recordid1="<?= $parking->parking_id ?>"  
                                data-placement="top" title="Delete this image"><i class="fa fa-trash"></i> Image</a>
                            </div>
                        </div>
                        <?php
                        }
                    ?>
                </div>
            </div>
            <?php } ?>
            <div class="col" >
                <h6>Add more images(<small>you can select multiple images at once</small>)</h6>
                <input class="mt-2" type='file' name='files[]' multiple="">
            </div>
        </div>

        <div class="row mt-4">
            <div class="form-group col-md-12">
                <input class="btn btn-primary btn-block" name="update_building" type="submit" value="Save Changes" />
            </div>
        </div>
        </form>
    </div>
    </div>
</div>
</div>

<!------------------Modals------------------------------->
<div class="modal fade" id="removeParkingImage" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-confirm">
        <div class="modal-content">
            <div class="modal-header">
                <div class="icon-box">
                    <i class="fa fa-trash text-danger"></i> Delete Parking Image
                </div>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            </div>
            <div class="modal-body">
                <p>Are you sure you want to delete this Image?</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                <a href="#" id="imageRecord" class="btn btn-danger"><span class="text-white">Delete</span></a>
            </div>
        </div>
    </div>
</div>