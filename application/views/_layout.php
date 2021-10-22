<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>UFS Campus Navigation Assistant - CMS</title>

    <!-- Custom fonts for this template-->
    <link href="<?= base_url(); ?>vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">
       
    <!-- Page level plugin CSS-->
    <link href="<?=base_url();?>vendor/fullcalendar/css/fullcalendar.min.css" rel="stylesheet" type="text/css" />
    <link href="<?=base_url();?>vendor/sweetalert/sweetalert.css" rel="stylesheet" type="text/css" />

    <!--Data Table export files-->
    <link href="<?=base_url();?>vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">

    <!-----------------Datepicker---------------------------------------->
    <link href="<?= base_url(); ?>vendor/gijgo-combined-1.9.13/css/gijgo.min.css" rel="stylesheet" type="text/css" />

    <!---------Dropzone--------------------------->
    <link href="<?=base_url();?>vendor/dropzone-5.7.0/dist/min/dropzone.min.css" rel="stylesheet">

    <!-- Custom styles for this UI theme-->
    <link href="<?= base_url(); ?>assets/css/sb-admin-2.css" rel="stylesheet">

    <!--Overide UI theme elements----->
    <style>
        .breadcrumb {
        border-radius: 0px;
        border-left: 2px solid #4C71DE;
    }

    .card {
        border-radius: 0px;
        border-top: 3px solid #4C71DE;
    }
    
    </style>

</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <ul class="navbar-nav sidebar sidebar-dark accordion" style="background-color: #405c88" id="accordionSidebar">

            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center" href="<?= base_url() . 'dashboard'; ?>">
                    <img class="rounded mx-auto d-block" src="<?= base_url() . 'assets/img/logo_icon.png';?>" width="40px" height="40px">
                <div class="sidebar-brand-text ">Admin Panel</div>
            </a>

            <!-- Divider -->
            <hr class="sidebar-divider my-0">

            <!-- Nav Item - Dashboard -->
            <li class="nav-item <?= ($this->uri->segment(1) == 'dashboard') ? ' active' : ''; ?>">
                <a class="nav-link" href="<?= base_url() . 'dashboard'; ?>">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>Dashboard</span></a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Heading -->
            <div class="sidebar-heading">
                Places
            </div>

            <!-- Buildings Nav Item- Pages Collapse Menu -->
            <li class="nav-item <?= ($this->uri->segment(1) == 'building') ? ' active' : ''; ?>">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseBuilding"
                    aria-expanded="true" aria-controls="collapseBuilding">
                    <i class="fas fa-fw fa-cog"></i>
                    <span>Buildings</span>
                </a>
                <div id="collapseBuilding" class="collapse" aria-labelledby="headingBuilding" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">Manage Buildings:</h6>
                        <a class="collapse-item" href="<?= base_url() . 'building'; ?>">Buildings List</a>
                        <a class="collapse-item" href="<?= base_url() . 'building/create'; ?>">New Building</a>
                    </div>
                </div>
            </li>

                <!-- Parkings Nav Item- Pages Collapse Menu -->
                <li class="nav-item <?= ($this->uri->segment(1) == 'parking') ? ' active' : ''; ?>">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseParking"
                    aria-expanded="true" aria-controls="collapseParking">
                    <i class="fas fa-fw fa-cog"></i>
                    <span>Parkings</span>
                </a>
                <div id="collapseParking" class="collapse" aria-labelledby="headingParking" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">Car Parkings:</h6>
                        <a class="collapse-item" href="<?= base_url() . 'parking/load_car_parkings'; ?>">Parkings List</a>
                        <a class="collapse-item" href="<?= base_url() . 'parking/create_parking'; ?>">New Parking</a>
                        <h6 class="collapse-header">Wheelchair Parkings:</h6>
                        <a class="collapse-item" href="<?= base_url() . 'parking/load_wheelchair_parkings'; ?>">Parkings List</a>
                        <a class="collapse-item" href="<?= base_url() . 'parking/create_parking'; ?>">New Parking</a>
                        <h6 class="collapse-header">Parking Categories:</h6>
                        <a class="collapse-item" href="<?= base_url() . 'parking'; ?>">Categories List</a>
                        <a class="collapse-item" href="<?= base_url() . 'parking/create_cat'; ?>">New Category</a>
                    </div>
                </div>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Heading -->
            <div class="sidebar-heading">
                Events & Timetable
            </div>

            <!-- Events calendar Nav Item - Page -->
            <li class="nav-item <?= ($this->uri->segment(1) == 'event') ? ' active' : ''; ?>">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseEvent"
                    aria-expanded="true" aria-controls="collapseBuilding">
                    <i class="fas fa-fw fa-cog"></i>
                    <span>Events Management</span>
                </a>
                <div id="collapseEvent" class="collapse" aria-labelledby="headingBuilding" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">Manage Events:</h6>
                        <a class="collapse-item" href="<?= base_url() . 'event'; ?>">Events List</a>
                        <a class="collapse-item" href="<?= base_url() . 'event/upcoming'; ?>">Upcoming Events</a>
                        <a class="collapse-item" href="<?= base_url() . 'event/past'; ?>">Past Events</a>
                        <a class="collapse-item" href="<?= base_url() . 'event/create'; ?>">New Event</a>
                    </div>
                </div>
            </li>

             <!-- Timetable Nav Item- Pages Collapse Menu -->
            <li class="nav-item <?= ($this->uri->segment(1) == 'module') ? ' active' : ''; ?>">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTime"
                    aria-expanded="true" aria-controls="collapseTime">
                    <i class="fas fa-fw fa-cog"></i>
                    <span>Modules</span>
                </a>
                <div id="collapseTime" class="collapse" aria-labelledby="headingTime" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">Manage Modules:</h6>
                        <a class="collapse-item" href="<?=base_url() . 'module'?>">Modules List</a>
                        <a class="collapse-item" href="<?=base_url() . 'module/create'?>">New Modules</a>
                    </div>
                </div>
            </li>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Heading -->
            <div class="sidebar-heading">
                System
            </div>

            <!-- Nav Item - Pages Collapse Menu -->
            <li class="nav-item <?= ($this->uri->segment(1) == 'admin' || $this->uri->segment(1) == 'student') ? ' active' : ''; ?>">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePages"
                    aria-expanded="true" aria-controls="collapsePages">
                    <i class="fas fa-fw fa-users"></i>
                    <span>User Accounts</span>
                </a>
                <div id="collapsePages" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">System Users:</h6>
                        <a class="collapse-item" href="<?=base_url() . 'admin'?>">Users List</a>
                        <a class="collapse-item" href="<?=base_url() . 'admin/create'?>">Register User</a>
                        <h6 class="collapse-header">Students Accounts:</h6>
                        <a class="collapse-item" href="<?= base_url() . 'student'?>">Students List</a>
                        <a class="collapse-item" href="<?= base_url() . 'student/create'?>">Register Student</a>
                    </div>
                </div>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider d-none d-md-block">

            <!-- Sidebar Toggler (Sidebar) -->
            <div class="text-center d-none d-md-inline">
                <button class="rounded-circle border-0" id="sidebarToggle"></button>
            </div>

        </ul>
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">
                <!-- Topbar -->
            <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

            <!-- Sidebar Toggle (Topbar) -->
            <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                <i class="fa fa-bars"></i>
            </button>

            <!-- Topbar Title page -->
            <div class="d-none d-sm-inline-block mr-auto">
                <h4>UFS Campus Navigation Assistant Content Management System</h4>
            </div>
            <div class="d-sm-none d-block pt-2 text-center">
                <h6><small>UFS Campus Navigation Assistant CMS</small></h6>
            </div>

            <!-- Topbar Navbar -->
            <ul class="navbar-nav ml-auto">

                <div class="topbar-divider d-none d-sm-block"></div>

                <!-- Nav Item - User Information -->
                <li class="nav-item dropdown no-arrow">
                    <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <span class="mr-2 d-none d-lg-inline text-gray-600 small"><?= _get_current_fullname($this); ?></span>
                        <img class="img-profile rounded-circle"
                            src="<?= base_url(); ?>assets/img/undraw_profile.svg">
                    </a>
                    <!-- Dropdown - User Information -->
                    <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
                        aria-labelledby="userDropdown">
                        <a class="dropdown-item" href="<?=base_url() . 'admin/edit/' . _get_current_user_id($this)?>">
                            <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                            Profile
                        </a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                            <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                            Logout
                        </a>
                    </div>
                </li>

            </ul>

            </nav>
            <!-- End of Topbar -->

            <!-- Begin Page Content -->
            <div class="container-fluid">
                <?php
                    $this->load->view($view);
                ?>
            </div>
            <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->

            <!-- Footer -->
            <footer class="sticky-footer bg-white">
                <div class="container my-auto">
                    <div class="copyright text-center my-auto">
                    <span>Copyright &copy; <script>document.write(new Date().getFullYear());</script>. 
                        UFS Campus Navigation Assistant</span>
                    </div>
                </div>
            </footer>
            <!-- End of Footer -->

        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <!-- Logout Modal-->
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <a class="btn btn-primary" href="<?=base_url() . 'login/logout';?>">Logout</a>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="<?= base_url(); ?>vendor/jquery/jquery.min.js"></script>
    <script src="<?= base_url(); ?>vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="<?= base_url(); ?>vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="<?= base_url(); ?>assets/js/sb-admin-2.min.js"></script>

    <!----------------------------Dropzone----------------------------------------------->
    <script src="<?= base_url(); ?>vendor/dropzone-5.7.0/dist/min/dropzone.min.js"></script>
    <!-- <script> $("div#dropbuildingimages").dropzone({ url: "<?= base_url() . 'building/create' ?>" }); </script> -->

    <!-- Page level plugins -->
    <script src="<?=base_url();?>vendor/fullcalendar/js/moment.min.js" type="text/javascript"></script>
    <script src="<?=base_url();?>vendor/fullcalendar/js/fullcalendar.min.js" type="text/javascript"></script>
    <script src="<?=base_url();?>assets/js/calendar.js" type="text/javascript"></script>
    <script src="<?=base_url();?>vendor/sweetalert/sweetalert.min.js" type="text/javascript"></script>
    <?php
    if (!empty($this->session->flashdata())) {
        ?>
        <script>
        swal("<?=$this->session->flashdata('title');?>", "<?=$this->session->flashdata('text');?>",
            "<?=$this->session->flashdata('type');?>");
        </script>
    <?php
    }
    ?>

    <!------------Datatables--------------------->
    <script src="<?=base_url();?>vendor/datatables/jquery.dataTables.min.js"></script>
    <script src="<?=base_url();?>vendor/datatables/dataTables.bootstrap4.min.js"></script>
    <script src="<?=base_url();?>assets/js/demo/datatables-demo.js"></script>

    <!--Date-picker-->
    <script src="<?= base_url(); ?>vendor/gijgo-combined-1.9.13/js/gijgo.min.js" type="text/javascript"></script>
    <script>
    $('#timepicker1').timepicker();
    $('#timepicker2').timepicker();
    $('#datepicker').datepicker({footer: true, modal: true, header: true, format: 'yyyy-mm-dd'});
    </script>

<!------------------------Calendar event source to grab events--------------------->
    <!-- <script>
    $('#calendar').fullCalendar({
        eventSources: [
            {
                events: function(start, end, timezone, callback) {
                    $.ajax({
                    url: '<?= base_url() ?>event/get_events',
                    dataType: 'json',
                    data: {
                    // our hypothetical feed requires UNIX timestamps
                    start: start.unix(),
                    end: end.unix()
                    },
                    success: function(msg) {
                        var events = msg.events;
                        callback(events);
                    }
                    });
                }
            },
        ]
    }); -->
    </script>


<!-----------------Handle confirmations from modals------------------------->
<script>
$('#deleteAdmin').on('show.bs.modal', function(event) {
    let adminRecord = $(event.relatedTarget).data('recordid');
    $("#adminRecord").attr("href", "<?=base_url() . 'admin/delete/'?>" + adminRecord);
});

$('#deleteBuilding').on('show.bs.modal', function(event) {
    let buildingRecord = $(event.relatedTarget).data('recordid');
    $("#buildingRecord").attr("href", "<?=base_url() . 'building/delete/'?>" + buildingRecord);
});

$('#removeImage').on('show.bs.modal', function(event) {
    let imageID = $(event.relatedTarget).data('recordid');
    let buildingID = $(event.relatedTarget).data('recordid1');
    $("#imageRecord").attr("href", "<?=base_url() . 'building/remove_image/'?>" + imageID  + '/' + buildingID);
});

$('#deleteParkingCategory').on('show.bs.modal', function(event) {
    let catRecord = $(event.relatedTarget).data('recordid');
    $("#parkingCategoryRecord").attr("href", "<?=base_url() . 'parking/delete_cat/'?>" + catRecord);
});

$('#deleteParking').on('show.bs.modal', function(event) {
    let parkingRecord = $(event.relatedTarget).data('recordid');
    $("#parkingRecord").attr("href", "<?=base_url() . 'parking/delete_parking/'?>" + parkingRecord);
});

$('#removeParkingImage').on('show.bs.modal', function(event) {
    let imageID = $(event.relatedTarget).data('recordid');
    let parkingID = $(event.relatedTarget).data('recordid1');
    $("#imageRecord").attr("href", "<?=base_url() . 'parking/remove_image/'?>" + imageID  + '/' + parkingID);
});

$('#deleteEvent').on('show.bs.modal', function(event) {
    let eventRecord = $(event.relatedTarget).data('recordid');
    $("#eventRecord").attr("href", "<?=base_url() . 'event/delete/'?>" + eventRecord);
});

$('#deleteStudent').on('show.bs.modal', function(event) {
    let studentRecord = $(event.relatedTarget).data('recordid');
    $("#studentRecord").attr("href", "<?=base_url() . 'student/delete/'?>" + studentRecord);
});

$('#deleteModule').on('show.bs.modal', function(event) {
    let moduleRecord = $(event.relatedTarget).data('recordid');
    $("#moduleRecord").attr("href", "<?=base_url() . 'module/delete/'?>" + moduleRecord);
});

</script>

</body>

</html>