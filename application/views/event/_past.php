<!-- Breadcrumbs-->
<ol class="breadcrumb">
    <li class="breadcrumb-item">
        <a href="<?=base_url() . 'event';?>">Calendar of Events</a>
    </li>
    <li class="breadcrumb-item active">Past Events</li>
</ol>

<div class="card shadow-sm mb-2">
<div class="card-body">
    <div class="row">
    <div class="text-right mb-2">
        <a class="btn btn-primary btn-sm" href="<?php echo base_url().'event/create';?> "><i class="fa fa-plus"></i> New Event</a>
    </div>
        <table id="data-table" class="table table-striped table-hover dt-responsive" style="width:100%">
            <thead>
                <tr>
                    <th>Event Name</th>
                    <th>Venue</th>
                    <th>Date</th>
                    <th>Start Time</th>
                    <th>End Time</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                foreach ($events as $event) {
                    ?>
                    <tr>
                        <td><?= $event['event_name']; ?></td>
                        <td><?= $this->building->get_building($event['building_id'])->building_name; ?></td>
                        <td><?= $event['event_date']; ?></td>
                        <td><?= $event['start_time']; ?></td>
                        <td><?= $event['end_time']; ?></td>
                        <td>
                            <div class="btn-group">
                                <a href="<?= base_url() . 'event/edit/' . $event['calendar_id']; ?>" class="btn btn-primary btn-sm mr-1" data-toggle="tooltip" data-placement="top" title="Edit this event"><i class="fa fa-edit"></i></a>
                                <a href="#" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#deleteEvent" data-recordid="<?=$event['calendar_id']?>" data-placement="top" title="Delete this event"><i class="fa fa-trash"></i></a>
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

<!------------------Modals------------------------------->
<div class="modal fade" id="deleteEvent" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-confirm">
        <div class="modal-content">
            <div class="modal-header">
                <div class="icon-box">
                    <i class="fa fa-trash text-danger"></i> Delete Event
                </div>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            </div>
            <div class="modal-body">
                <p>Are you sure you want to delete this Eventr?</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                <a href="#" id="eventRecord" class="btn btn-danger"><span class="text-white">Delete</span></a>
            </div>
        </div>
    </div>
</div>