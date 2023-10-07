<?php
include 'header.php';
?>
        <!-- partial -->
        <div class="page-content">
          <h4 class="mt-3 mb-3">Create Job Post</h4>
          <div class="row">
            <div class="col-md-12 stretch-card">
              <div class="card">
                <div class="card-body">
                  <!-- <h6 class="card-title">Form Grid</h6> -->
                    <div id="content">
                        <form class="dropzone" id="file_upload"></form>
                        <button id="upload_btn">Upload</button>
                    </div>
                </div>
              </div>
            </div>
          </div>
        <!-- partial:partials/_footer.html -->
        <footer
          class="footer d-flex flex-column flex-md-row align-items-center justify-content-between px-4 py-3 border-top small"
        >
          <p class="text-muted mb-1 mb-md-0">
            Copyright © 2022
            <a href="https://www.ifanni" target="_blank">Ifanni.sa</a>.
          </p>
        </footer>
        <!-- partial -->
      </div>
    </div>
    <!-- core:js -->
    <script src="assets/vendors/core/core.js"></script>
    <!-- endinject -->

    <!-- Plugin js for this page -->
    <script src="assets/vendors/flatpickr/flatpickr.min.js"></script>
    <script src="assets/vendors/apexcharts/apexcharts.min.js"></script>
    <!-- End plugin js for this page -->

    <!-- inject:js -->
    <script src="assets/vendors/feather-icons/feather.min.js"></script>
    <script src="assets/js/template.js"></script>
    <script src="assets/vendors/datatables.net/jquery.dataTables.js"></script>
    <script src="assets/vendors/datatables.net-bs5/dataTables.bootstrap5.js"></script>
    <script src="assets/js/data-table.js"></script>
    <script src="assets/vendors/select2/select2.min.js"></script>
    <script src="assets/js/select2.js"></script>
    <script src="assets/js/pickr.js"></script>
    <script src="assets/js/flatpickr.js"></script>
    <script src="assets/vendors/easymde/easymde.min.js"></script>
    <script src="assets/js/easymde.js"></script>
    <!-- endinject -->

    <!-- Custom js for this page -->
    <script src="assets/js/dashboard-light.js"></script>
    <script type="text/javascript" src="js/jquery.js"></script>
    <script type="text/javascript" src="js/dropzone.js"></script>
    <!-- End custom js for this page -->
    <!-- <script src="img.js"></script> -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
<!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.9.3/dropzone.min.js"></script> -->
<script>
    Dropzone.autoDiscover = false;
    
    var myDropzone = new Dropzone("#file_upload", { 
      url: "upload.php",
      parallelUploads: 3,
      uploadMultiple: true,
      acceptedFiles: '.png,.jpg,.jpeg',
      autoProcessQueue: false,
      success: function(file,response){
        if(response == 'true'){
          $('#content .message').hide();
          $('#content').append('<div class="message success">Images Uploaded Successfully.</div>');
        }else{
          $('#content').append('<div class="message error">Images Can\'t Uploaded.</div>');
        }
      }
    });

    $('#upload_btn').click(function(){
      myDropzone.processQueue();
    });
</script>
</body>
</html>
