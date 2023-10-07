<?php
@session_start();
include('session.php');
require 'assets/inc/initDb.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <meta
      name="description"
      content="Responsive HTML Admin Dashboard Template based on Bootstrap 5"
    />
    <meta name="author" content="NobleUI" />
    <meta
      name="keywords"
      content="nobleui, bootstrap, bootstrap 5, bootstrap5, admin, dashboard, template, responsive, css, sass, html, theme, front-end, ui kit, web"
    />

    <title>Ifanni</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
      href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700;900&display=swap"
      rel="stylesheet"
    />
    <!-- End fonts -->

    <!-- core:css -->
    <link rel="stylesheet" href="assets/vendors/core/core.css" />
    <!-- endinject -->

    <!-- Plugin css for this page -->
 
    <!-- End plugin css for this page -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@10.16.3/dist/sweetalert2.min.css">
    <!-- inject:css -->
    <link rel="stylesheet" href="assets/fonts/feather-font/css/iconfont.css" />
    <link rel="stylesheet" href="assets/vendors/flatpickr/flatpickr.min.css" />
    <link rel="stylesheet" href="assets/vendors/select2/select2.min.css" />
    <link rel="stylesheet" href="assets/vendors/easymde/easymde.min.css" />
    <link rel="stylesheet" href="assets/vendors/dropzone/dropzone.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.9.3/min/dropzone.min.css">
    <link
      rel="stylesheet"
      href="assets/vendors/datatables.net-bs5/dataTables.bootstrap5.css"
    />
    <link
      rel="stylesheet"
      href="assets/vendors/flag-icon-css/css/flag-icon.min.css"
    />
    <!-- endinject -->

    <!-- Layout styles -->
    <link rel="stylesheet" href="assets/css/demo1/style.css" />
    <!-- End layout styles -->

    <link rel="shortcut icon" href="assets/images/favicon.png" />
  </head>
  <body>
  <style>
      .badge-danger {
  background-color: #02592e; /* Red background color */
  color: #fff; /* White text color */
  font-size: 12px; /* Font size */
  padding: 3px 8px; /* Padding around the counter */
  border-radius: 50%; /* Rounded shape */
  position: relative; /* Allows positioning within the parent element */
  top: -5px; /* Adjust the vertical position to align with the text */
  left: 5px; /* Adjust the horizontal position to align with the icon */
}
      .nav-item2 {
  position: relative;
}

.bubble {
  width: 12px;
  height: 12px;
  background-color: #02592e; /* Bubble color */
  border-radius: 50%;
  position: absolute;
  top: 0px; /* Adjust the top position to align the bubble */
  right: 10px; /* Adjust the right position to align the bubble */
  animation: bubbleAnimation 1s ease-in-out infinite;
}

@keyframes bubbleAnimation {
  0% {
    transform: scale(1);
    opacity: 0.5;
  }
  50% {
    transform: scale(1.2);
    opacity: 0.3;
  }
  100% {
    transform: scale(1);
    opacity: 0.5;
  }
}
    </style>

    <div class="main-wrapper">
      <!-- partial:partials/_sidebar.html -->
      <nav class="sidebar">
        <div class="sidebar-header">
          <a href="#" class="sidebar-brand"> Ifanni<span>.sa</span> </a>
          <div class="sidebar-toggler not-active">
            <span></span>
            <span></span>
            <span></span>
          </div>
        </div>
        <div class="sidebar-body">
          <ul class="nav">
            <li class="nav-item nav-category">Main</li>
            <li class="nav-item mb-3">
              <a href="index.php" class="nav-link">
                <i class="link-icon" data-feather="home"></i>
                <span class="link-title">Dashboard</span>
              </a>
            </li>
            <li class="nav-item mb-3">
              <a href="profile.php" class="nav-link">
                <i class="link-icon" data-feather="user"></i>
                <span class="link-title">Profile</span>
              </a>
            </li>

            <li class="nav-item mb-3">
              <a href="all-service.php" class="nav-link">
                <i class="link-icon" data-feather="list"></i>
                <span class="link-title">Services</span>
              </a>
            </li>
            <li class="nav-item mb-3">
              <a href="all-service-equipment.php" class="nav-link">
                <i class="link-icon" data-feather="grid"></i>
                <span class="link-title">Equipment </span>
              </a>
            </li>

            <li class="nav-item mb-3">
              <a href="#" class="nav-link">
                <i class="link-icon" data-feather="list"></i>
                <span class="link-title">Order Pending</span>
              </a>
            </li>

            <li class="nav-item mb-3">
              <a href="#" class="nav-link">
                <i class="link-icon" data-feather="list"></i>
                <span class="link-title">All Job Orders</span>
              </a>
            </li>
            <li class="nav-item mb-3">
              <a href="#" class="nav-link">
                <i class="link-icon" data-feather="bell"></i>
                <span class="link-title">All Notifactions</span>
              </a>
            </li>
            <!--<li class="nav-item mb-3">
              <a href="#" class="nav-link">
                <i class="link-icon" data-feather="box"></i>
                <span class="link-title">Payout History</span>
              </a>
            </li>-->
            <!--<li class="nav-item mb-3">
              <a href="#" class="nav-link">
                <i class="link-icon" data-feather="list"></i>
                <span class="link-title">Report List</span>
              </a>
            </li>-->

            <?php
            $count = 0;
            $query = DB::query("select * from service_provider_new_job_request where service_provider_id = '".$_SESSION['service-provider_id']."' ");
            foreach($query as $q)
            {
              $query = DB::queryFirstRow("select * from  job_notifications where job_id = '".$q['job_id']."' and job_status = 'pending' ");
              if(DB::count() > 0)
              {
                $count = $count + 1;
              }

            }
            ?>

            <li class="nav-item mb-3">
              <a href="new_job_requests.php" class="nav-link">
                <i class="link-icon" data-feather="feather"></i>
                <span class="link-title">New Job Requests</span>
                <?php 
                if($count > 0)
                { ?>
                  <span class="badge badge-danger" id="newJobCount">0</span>&nbsp;&nbsp;
                <div class="bubble"></div>
               <?php } ?>
              </a>
            </li>
            <!--<li class="nav-item mb-3">
              <a href="#" class="nav-link">
                <i class="link-icon" data-feather="user-check"></i>
                <span class="link-title">Profile Verify</span>
              </a>
            </li>-->
            <li class="nav-item mb-3">
              <a href="#" class="nav-link">
                <i class="link-icon" data-feather="settings"></i>
                <span class="link-title">Settings</span>
              </a>
            </li>
            <li class="nav-item">
              <a href="logout.php" class="nav-link">
                <i class="link-icon" data-feather="log-out"></i>
                <span class="link-title">Log Out</span>
              </a>
            </li>
            
          </ul>
        </div>
      </nav>

      <!-- partial -->

      <div class="page-wrapper">
        <!-- partial:partials/_navbar.html -->
        <nav class="navbar">
          <a href="#" class="sidebar-toggler">
            <i data-feather="menu"></i>
          </a>
          <div class="navbar-content">
            <form class="search-form">
              <div class="input-group">
                <div class="input-group-text">
                  <i data-feather="search"></i>
                </div>
                <input
                  type="text"
                  class="form-control"
                  id="navbarForm"
                  placeholder="Search here..."
                />
              </div>
            </form>
            <ul class="navbar-nav">
              <!--<li class="nav-item dropdown">
                <a
                  class="nav-link dropdown-toggle"
                  href="#"
                  id="languageDropdown"
                  role="button"
                  data-bs-toggle="dropdown"
                  aria-haspopup="true"
                  aria-expanded="false"
                >
                  <i class="flag-icon flag-icon-us mt-1" title="us"></i>
                  <span class="ms-1 me-1 d-none d-md-inline-block"
                    >English</span
                  >
                </a>
                <div class="dropdown-menu" aria-labelledby="languageDropdown">
                  <a href="javascript:;" class="dropdown-item py-2"
                    ><i class="flag-icon flag-icon-us" title="us" id="us"></i>
                    <span class="ms-1"> English </span></a
                  >
                  <a href="javascript:;" class="dropdown-item py-2"
                    ><i class="flag-icon flag-icon-fr" title="fr" id="fr"></i>
                    <span class="ms-1"> French </span></a
                  >
                  <a href="javascript:;" class="dropdown-item py-2"
                    ><i class="flag-icon flag-icon-de" title="de" id="de"></i>
                    <span class="ms-1"> German </span></a
                  >
                  <a href="javascript:;" class="dropdown-item py-2"
                    ><i class="flag-icon flag-icon-pt" title="pt" id="pt"></i>
                    <span class="ms-1"> Portuguese </span></a
                  >
                  <a href="javascript:;" class="dropdown-item py-2"
                    ><i class="flag-icon flag-icon-es" title="es" id="es"></i>
                    <span class="ms-1"> Spanish </span></a
                  >
                </div>
              </li>-->
              <!--<li class="nav-item dropdown">
                <a
                  class="nav-link dropdown-toggle"
                  href="#"
                  id="appsDropdown"
                  role="button"
                  data-bs-toggle="dropdown"
                  aria-haspopup="true"
                  aria-expanded="false"
                >
                  <i data-feather="grid"></i>
                </a>
                <div class="dropdown-menu p-0" aria-labelledby="appsDropdown">
                  <div
                    class="px-3 py-2 d-flex align-items-center justify-content-between border-bottom"
                  >
                    <p class="mb-0 fw-bold">Web Apps</p>
                    <a href="javascript:;" class="text-muted">Edit</a>
                  </div>
                  <div class="row g-0 p-1">
                    <div class="col-3 text-center">
                      <a
                        href="pages/apps/chat.html"
                        class="dropdown-item d-flex flex-column align-items-center justify-content-center wd-70 ht-70"
                        ><i
                          data-feather="message-square"
                          class="icon-lg mb-1"
                        ></i>
                        <p class="tx-12">Chat</p></a
                      >
                    </div>
                    <div class="col-3 text-center">
                      <a
                        href="pages/apps/calendar.html"
                        class="dropdown-item d-flex flex-column align-items-center justify-content-center wd-70 ht-70"
                        ><i data-feather="calendar" class="icon-lg mb-1"></i>
                        <p class="tx-12">Calendar</p></a
                      >
                    </div>
                    <div class="col-3 text-center">
                      <a
                        href="pages/email/inbox.html"
                        class="dropdown-item d-flex flex-column align-items-center justify-content-center wd-70 ht-70"
                        ><i data-feather="mail" class="icon-lg mb-1"></i>
                        <p class="tx-12">Email</p></a
                      >
                    </div>
                    <div class="col-3 text-center">
                      <a
                        href="pages/general/profile.html"
                        class="dropdown-item d-flex flex-column align-items-center justify-content-center wd-70 ht-70"
                        ><i data-feather="instagram" class="icon-lg mb-1"></i>
                        <p class="tx-12">Profile</p></a
                      >
                    </div>
                  </div>
                  <div
                    class="px-3 py-2 d-flex align-items-center justify-content-center border-top"
                  >
                    <a href="javascript:;">View all</a>
                  </div>
                </div>
              </li>-->
              <!--<li class="nav-item dropdown">
                <a
                  class="nav-link dropdown-toggle"
                  href="#"
                  id="messageDropdown"
                  role="button"
                  data-bs-toggle="dropdown"
                  aria-haspopup="true"
                  aria-expanded="false"
                >
                  <i data-feather="mail"></i>
                </a>
                <div
                  class="dropdown-menu p-0"
                  aria-labelledby="messageDropdown"
                >
                  <div
                    class="px-3 py-2 d-flex align-items-center justify-content-between border-bottom"
                  >
                    <p>9 New Messages</p>
                    <a href="javascript:;" class="text-muted">Clear all</a>
                  </div>
                  <div class="p-1">
                    <a
                      href="javascript:;"
                      class="dropdown-item d-flex align-items-center py-2"
                    >
                      <div class="me-3">
                        <img
                          class="wd-30 ht-30 rounded-circle"
                          src="https://via.placeholder.com/30x30"
                          alt="userr"
                        />
                      </div>
                      <div class="d-flex justify-content-between flex-grow-1">
                        <div class="me-4">
                          <p>Leonardo Payne</p>
                          <p class="tx-12 text-muted">Project status</p>
                        </div>
                        <p class="tx-12 text-muted">2 min ago</p>
                      </div>
                    </a>
                    <a
                      href="javascript:;"
                      class="dropdown-item d-flex align-items-center py-2"
                    >
                      <div class="me-3">
                        <img
                          class="wd-30 ht-30 rounded-circle"
                          src="https://via.placeholder.com/30x30"
                          alt="userr"
                        />
                      </div>
                      <div class="d-flex justify-content-between flex-grow-1">
                        <div class="me-4">
                          <p>Carl Henson</p>
                          <p class="tx-12 text-muted">Client meeting</p>
                        </div>
                        <p class="tx-12 text-muted">30 min ago</p>
                      </div>
                    </a>
                    <a
                      href="javascript:;"
                      class="dropdown-item d-flex align-items-center py-2"
                    >
                      <div class="me-3">
                        <img
                          class="wd-30 ht-30 rounded-circle"
                          src="https://via.placeholder.com/30x30"
                          alt="userr"
                        />
                      </div>
                      <div class="d-flex justify-content-between flex-grow-1">
                        <div class="me-4">
                          <p>Jensen Combs</p>
                          <p class="tx-12 text-muted">Project updates</p>
                        </div>
                        <p class="tx-12 text-muted">1 hrs ago</p>
                      </div>
                    </a>
                    <a
                      href="javascript:;"
                      class="dropdown-item d-flex align-items-center py-2"
                    >
                      <div class="me-3">
                        <img
                          class="wd-30 ht-30 rounded-circle"
                          src="https://via.placeholder.com/30x30"
                          alt="userr"
                        />
                      </div>
                      <div class="d-flex justify-content-between flex-grow-1">
                        <div class="me-4">
                          <p>Amiah Burton</p>
                          <p class="tx-12 text-muted">Project deatline</p>
                        </div>
                        <p class="tx-12 text-muted">2 hrs ago</p>
                      </div>
                    </a>
                    <a
                      href="javascript:;"
                      class="dropdown-item d-flex align-items-center py-2"
                    >
                      <div class="me-3">
                        <img
                          class="wd-30 ht-30 rounded-circle"
                          src="https://via.placeholder.com/30x30"
                          alt="userr"
                        />
                      </div>
                      <div class="d-flex justify-content-between flex-grow-1">
                        <div class="me-4">
                          <p>Yaretzi Mayo</p>
                          <p class="tx-12 text-muted">New record</p>
                        </div>
                        <p class="tx-12 text-muted">5 hrs ago</p>
                      </div>
                    </a>
                  </div>
                  <div
                    class="px-3 py-2 d-flex align-items-center justify-content-center border-top"
                  >
                    <a href="javascript:;">View all</a>
                  </div>
                </div>
              </li>-->
              <li class="nav-item dropdown">
                <a
                  class="nav-link dropdown-toggle"
                  href="#"
                  id="notificationDropdown"
                  role="button"
                  data-bs-toggle="dropdown"
                  aria-haspopup="true"
                  aria-expanded="false"
                >
                  <i data-feather="bell"></i>
                  <div class="indicator">
                    <div class="circle"></div>
                  </div>
                </a>
                <div
                  class="dropdown-menu p-0"
                  aria-labelledby="notificationDropdown"
                >
                  <div
                    class="px-3 py-2 d-flex align-items-center justify-content-between border-bottom"
                  >
                    <p>6 New Notifications</p>
                    <a href="javascript:;" class="text-muted">Clear all</a>
                  </div>
                  <div class="p-1">
                    <a
                      href="javascript:;"
                      class="dropdown-item d-flex align-items-center py-2"
                    >
                      <div
                        class="wd-30 ht-30 d-flex align-items-center justify-content-center bg-primary rounded-circle me-3"
                      >
                        <i class="icon-sm text-white" data-feather="gift"></i>
                      </div>
                      <div class="flex-grow-1 me-2">
                        <p>New Order Recieved</p>
                        <p class="tx-12 text-muted">30 min ago</p>
                      </div>
                    </a>
                    <a
                      href="javascript:;"
                      class="dropdown-item d-flex align-items-center py-2"
                    >
                      <div
                        class="wd-30 ht-30 d-flex align-items-center justify-content-center bg-primary rounded-circle me-3"
                      >
                        <i
                          class="icon-sm text-white"
                          data-feather="alert-circle"
                        ></i>
                      </div>
                      <div class="flex-grow-1 me-2">
                        <p>Server Limit Reached!</p>
                        <p class="tx-12 text-muted">1 hrs ago</p>
                      </div>
                    </a>
                    <a
                      href="javascript:;"
                      class="dropdown-item d-flex align-items-center py-2"
                    >
                      <div
                        class="wd-30 ht-30 d-flex align-items-center justify-content-center bg-primary rounded-circle me-3"
                      >
                        <img
                          class="wd-30 ht-30 rounded-circle"
                          src="https://via.placeholder.com/30x30"
                          alt="userr"
                        />
                      </div>
                      <div class="flex-grow-1 me-2">
                        <p>New customer registered</p>
                        <p class="tx-12 text-muted">2 sec ago</p>
                      </div>
                    </a>
                    <a
                      href="javascript:;"
                      class="dropdown-item d-flex align-items-center py-2"
                    >
                      <div
                        class="wd-30 ht-30 d-flex align-items-center justify-content-center bg-primary rounded-circle me-3"
                      >
                        <i class="icon-sm text-white" data-feather="layers"></i>
                      </div>
                      <div class="flex-grow-1 me-2">
                        <p>Apps are ready for update</p>
                        <p class="tx-12 text-muted">5 hrs ago</p>
                      </div>
                    </a>
                    <a
                      href="javascript:;"
                      class="dropdown-item d-flex align-items-center py-2"
                    >
                      <div
                        class="wd-30 ht-30 d-flex align-items-center justify-content-center bg-primary rounded-circle me-3"
                      >
                        <i
                          class="icon-sm text-white"
                          data-feather="download"
                        ></i>
                      </div>
                      <div class="flex-grow-1 me-2">
                        <p>Download completed</p>
                        <p class="tx-12 text-muted">6 hrs ago</p>
                      </div>
                    </a>
                  </div>
                  <div
                    class="px-3 py-2 d-flex align-items-center justify-content-center border-top"
                  >
                    <a href="javascript:;">View all</a>
                  </div>
                </div>
              </li>
              <li class="nav-item dropdown">
                <a
                  class="nav-link dropdown-toggle"
                  href="#"
                  id="profileDropdown"
                  role="button"
                  data-bs-toggle="dropdown"
                  aria-haspopup="true"
                  aria-expanded="false"
                >
                  <img
                    class="wd-30 ht-30 rounded-circle"
                    src="https://via.placeholder.com/30x30"
                    alt="profile"
                  />
                </a>
                <div
                  class="dropdown-menu p-0"
                  aria-labelledby="profileDropdown"
                >
                  <div
                    class="d-flex flex-column align-items-center border-bottom px-5 py-3"
                  >
                    <div class="mb-3">
                      <img
                        class="wd-80 ht-80 rounded-circle"
                        src="https://via.placeholder.com/80x80"
                        alt=""
                      />
                    </div>
                    <div class="text-center">
                      <p class="tx-16 fw-bolder">Amiah Burton</p>
                      <p class="tx-12 text-muted">amiahburton@gmail.com</p>
                    </div>
                  </div>
                  <ul class="list-unstyled p-1">
                    <li class="dropdown-item py-2">
                      <a
                        href="pages/general/profile.html"
                        class="text-body ms-0"
                      >
                        <i class="me-2 icon-md" data-feather="user"></i>
                        <span>Profile</span>
                      </a>
                    </li>
                    <li class="dropdown-item py-2">
                      <a href="javascript:;" class="text-body ms-0">
                        <i class="me-2 icon-md" data-feather="edit"></i>
                        <span>Edit Profile</span>
                      </a>
                    </li>
                    <li class="dropdown-item py-2">
                      <a href="javascript:;" class="text-body ms-0">
                        <i class="me-2 icon-md" data-feather="repeat"></i>
                        <span>Switch User</span>
                      </a>
                    </li>
                    <li class="dropdown-item py-2">
                      <a href="javascript:;" class="text-body ms-0">
                        <i class="me-2 icon-md" data-feather="log-out"></i>
                        <span>Log Out</span>
                      </a>
                    </li>
                  </ul>
                </div>
              </li>
            </ul>
          </div>
        </nav>

        <?php
$newJobCount = $count; // Replace this with the actual count
?>

<script>
    document.addEventListener("DOMContentLoaded", function () {
        var newJobCountElement = document.getElementById("newJobCount");
        if (newJobCountElement) {
            newJobCountElement.textContent = "<?php echo $newJobCount; ?>";
        }
    });
</script>