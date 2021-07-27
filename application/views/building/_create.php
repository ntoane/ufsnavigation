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
    <div class="col-md-12 mx-auto">
        <form action="<?= base_url() . 'building/create' ?>" method="POST" enctype="multipart/form-data">
        <div class="row">
            <div class="col">
            <div class="row">
                <div class="form-group col-md-12">
                    <label for="name"><strong>Building Name</strong></label>
                    <input type="text" name="name" class="form-control" required />
                </div>
            </div>
            <div class="row">
                <div class="form-group col-md-12">
                    <label for="lat"><strong>Latitude</strong></label>
                    <input type="text" name="lat" class="form-control" required />
                </div>
            </div>
            <div class="row">
                <div class="form-group col-md-12">
                    <label for="lon"><strong>Longitude</strong></label>
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
            <div class="col">
                <h6>Upload images(<small>you can select multiple images at once</small>)</h6>
                <input type='file' name='files[]' multiple="">
            </div>
        </div>

        <div class="row mt-4">
            <div class="form-group col-md-12">
                <input class="btn btn-primary btn-block" name="submit_building" type="submit" value="Add Building" />
            </div>
        </div>
        </form>
    </div>
    </div>
</div>
</div>