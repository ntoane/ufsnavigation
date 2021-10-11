<!-- Breadcrumbs-->
<ol class="breadcrumb">
    <li class="breadcrumb-item">
        <a href="<?=base_url() . 'building';?>">Buildings</a>
    </li>
    <li class="breadcrumb-item active">Edit building</li>
</ol>

<div class="card shadow-sm mb-2">
<div class="card-body">
    <div class="row">
    <div class="col-md-12 mx-auto">
        <form action="<?= base_url() . 'building/edit' ?>" method="POST" enctype="multipart/form-data">
        <input type="hidden" name="building_id" value="<?= (!empty($building)) ? $building->building_id : ''; ?>" />
        <div class="row">
            <div class="col">
            <div class="row">
                <div class="form-group col-md-12">
                    <label for="name"><strong>Building Name</strong></label>
                    <input type="text" name="name" value="<?= (!empty($building)) ? $building->building_name : ''; ?>" class="form-control" required />
                </div>
            </div>
            <div class="row">
                <div class="form-group col-md-12">
                    <label for="lat"><strong>Latitude</strong></label>
                    <input type="text" name="lat" value="<?= (!empty($building)) ? $building->lat_coordinate : ''; ?>" class="form-control" required />
                </div>
            </div>
            <div class="row">
                <div class="form-group col-md-12">
                    <label for="lon"><strong>Longitude</strong></label>
                    <input type="text" name="lon" value="<?= (!empty($building)) ? $building->lon_coordinate : ''; ?>" class="form-control" required />
                </div>
            </div>
            <div class="row">
            <div class="form-group col-md-12">
                <label for="description">Building description</label>
                <textarea class="form-control" rows="5" name="description"><?= (!empty($building)) ? $building->description : ''; ?></textarea>
            </div>
            </div>
            </div>
            <?php if(!empty($building_images)) { ?>
            <div class="col" >
                <h6>You can delete some images</h6>
                <div class="row">
                    <?php 
                        foreach($building_images as $image) {
                        ?>
                        <div class="col-4">
                            <div>
                                <a target="_blank" href="<?= base_url().'uploads/buildings/'.$image['url'];?>"> 
                                    <img class="rounded mx-auto d-block mt-2" src="<?= base_url().'uploads/buildings/'.$image['url'];?>" width="130" height="120">
                                </a>
                            </div>
                            <div class="mt-1 text-center">
                            <a href="#" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#removeImage" 
                                data-recordid="<?= $image['image_id'] ?>" 
                                data-recordid1="<?= $building->building_id ?>"  
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
                <input class="btn btn-primary btn-block" name="update_building" type="submit" value="Update Building" />
            </div>
        </div>
        </form>
    </div>
    </div>
</div>
</div>

<!------------------Modals------------------------------->
<div class="modal fade" id="removeImage" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-confirm">
        <div class="modal-content">
            <div class="modal-header">
                <div class="icon-box">
                    <i class="fa fa-trash text-danger"></i> Delete Building Image
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