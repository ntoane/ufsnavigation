<!-- Breadcrumbs-->
<ol class="breadcrumb">
    <li class="breadcrumb-item">
        <a href="<?=base_url() . 'building';?>">Buildings</a>
    </li>
    <li class="breadcrumb-item active">Add building</li>
</ol>

<div class="card shadow-sm mb-2">
<div class="card-body">
    <div class="row">
    <div class="col-md-12 mx-auto">
        <form action="<?= base_url() . 'building/create' ?>" method="POST" enctype="multipart/form-data">
        <div class="row">
            <div class="col">
            <div class="row">
                <div class="form-group col-md-12">
                        <label for="category_id"><strong>Category<span class="text-danger">*</span></strong></label>
                        <select name="category_id" class="form-control" required="">
                            <option value="" selected="" disabled="">Select category</option>
                            <?php
                            foreach ($categories as $category) {
                                ?>
                                <option value="<?=$category['category_id'];?>"><?=$category['category_name'];?></option>
                                <?php
                            }
                            ?>
                    </select>
                </div>
            </div>
            <div class="row">
                <div class="form-group col-md-12">
                    <label for="name"><strong>Building Name<span class="text-danger">*</span></strong></label>
                    <input type="text" name="name"  class="form-control" required />
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
                <label for="description">Building description</label>
                <textarea class="form-control" rows="5" name="description"></textarea>
            </div>
            </div>
            </div>
            <div class="col" >
                <h6>Upload images(<small>you can select multiple images at once</small>)</h6>
                <input class="mt-2" type='file' name='files[]' multiple="">
                <!-- <div class="dropzone" id="my-dropzone" name="mainFileUploader">
                    <div class="fallback">
                        <input name="files[]" type="file" multiple />
                    </div>
                </div> -->
            </div>
        </div>

        <div class="row mt-4">
            <div class="form-group col-md-12">
                <input class="btn btn-primary btn-block" name="submit_building" id="submit-all" type="submit" value="Add Building" />
            </div>
        </div>
        </form>
    </div>
    </div>
</div>
</div>