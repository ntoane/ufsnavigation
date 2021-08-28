<!-- Breadcrumbs-->
<ol class="breadcrumb">
    <li class="breadcrumb-item">
        <a href="<?=base_url() . 'parking/load_car_parkings';?>">Car Parkings</a>
    </li>
    <li class="breadcrumb-item active">Add Parking</li>
</ol>

<div class="card shadow-sm mb-2">
<div class="card-body">
    <div class="row">
    <div class="col-md-12 mx-auto">
        <form action="<?= base_url() . 'parking/create_parking' ?>" method="POST" enctype="multipart/form-data">
        <div class="row">
            <div class="col">
            <div class="row">
                <div class="form-group col-md-12">
                        <label for="cat_id"><strong>Parking Category<span class="text-danger">*</span></strong></label>
                        <select name="cat_id" class="form-control" required="">
                            <option value="" selected="" disabled="">Select category</option>
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
            <div class="row">
            <div class="form-group col-md-12">
                <div><strong>Please choose the parking type below<span class="text-danger">*</span></strong></div>
                <input type="radio" name="parking_type" value="both" checked />
                <label for="both_parking">Both car & wheelchair parking</label>
                <br>
                <input type="radio" name="parking_type" value="car" />
                <label for="car_parking">Car parking</label>
                <br>
                <input type="radio" name="parking_type" value="wheelchair" />
                <label for="wheelchair_parking">Wheelchair</label>
            </div>
            </div>
            <div class="row">
                <div class="form-group col-md-12">
                    <label for="parking_name"><strong>Parking Name<span class="text-danger">*</span></strong></label>
                    <input type="text" name="parking_name"  class="form-control" required />
                </div>
            </div>
            You can click <a href="https://www.google.com/maps/@?api=1&map_action=map&center=-29.107279, 26.187364&zoom=18&basemap=satellite" target="_blank">here</a> to load Google maps
            <div class="row">
                <div class="form-group col-md-12">
                    <label for="lat"><strong>Latitude<span class="text-danger">*</span></strong></label>
                    <input type="text" name="lat" class="form-control" required />
                </div>
            </div>
            <div class="row">
                <div class="form-group col-md-12">
                    <label for="lon"><strong>Longitude<span class="text-danger">*</span></strong></label>
                    <input type="text" name="lon" class="form-control" required />
                </div>
            </div>
            <div class="row">
            <div class="form-group col-md-12">
                <label for="description">Parking description</label>
                <textarea class="form-control" rows="5" name="description"></textarea>
            </div>
            </div>
            </div>
            <div class="col" >
                <h6>Upload images(<small>you can select multiple images at once</small>)</h6>
                <input class="mt-2" type='file' name='files[]' multiple="">
            </div>
        </div>

        <div class="row mt-4">
            <div class="form-group col-md-12">
                <input class="btn btn-primary btn-block" name="submit_parking" id="submit-all" type="submit" value="Add Parking" />
            </div>
        </div>
        </form>
    </div>
    </div>
</div>
</div>