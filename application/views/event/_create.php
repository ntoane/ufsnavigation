<!-- Breadcrumbs-->
<ol class="breadcrumb">
    <li class="breadcrumb-item">
        <a href="<?=base_url() . 'event';?>">Events</a>
    </li>
    <li class="breadcrumb-item active">Create Event</li>
</ol>

<div class="card shadow-sm mb-2">
<div class="card-body">
    <div class="row">
    <div class="col-md-12 mx-auto">

<form action="<?= base_url() . 'event/create' ?>" method="POST">
    <div class="row">
        <div class="form-group col-md-6">
            <label for="event_name"><strong>Event Name</strong></label>
            <input type="text" name="event_name" class="form-control" required />
        </div>
    </div>
    <div class="row">
        <div class="form-group col-md-6">
            <label for="event_date"><strong>Event Date</strong></label>
            <input type="text" name="event_date" class="form-control" id="datepicker" value="Click to pick event date" required>
        </div>
    </div>
    <div class="row">
        <div class="form-group col-md-6">
            <label for="start_time"><strong>Start Time</strong></label>
            <input type="text" name="start_time" class="form-control" id="timepicker1" value="Click to pick start time" required />
        </div>
    </div>
    <div class="row">
        <div class="form-group col-md-6">
            <label for="end_time"><strong>End Time</strong></label>
            <input type="text" name="end_time" class="form-control" id="timepicker2" value="Click to pick start time" required />
        </div>
    </div>
    <div class="row mt-4">
        <div class="form-group col-md-4">
            <input class="btn btn-primary btn-block" name="submit_event" type="submit" value="Add Event" />
        </div>
        <div class="form-group col-md-2">
            <a href="<?= base_url().'event'; ?>" class="btn btn-dark btn-block">Cancel</a>
        </div>
    </div>
</form>

</div>
    </div>
</div>
</div>