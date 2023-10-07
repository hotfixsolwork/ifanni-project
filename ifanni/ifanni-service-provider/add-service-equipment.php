<?php
include 'header.php';
?>
        <!-- partial -->
        <div class="page-content">
          <h4 class="mt-3 mb-3">Create New Equipment</h4>
          <div class="row">
            <div class="col-md-12 stretch-card">
              <div class="card">
                <div class="card-body">
                  <!-- <h6 class="card-title">Form Grid</h6> -->
                  <form id="equipment" method="post" enctype="multipart/form-data">
                    <div class="row">
                      <div class="col-sm-6">
                        <div class="mb-3">
                          <label class="form-label" for="name">Name Of Equipment</label>
                          <input
                          id="name"
                          name="name"
                            type="text"
                            class="form-control"
                            placeholder="Enter Equipment Title"
                          />
                        </div>
                      </div>
                      <div class="col-sm-6">
                        <div class="mb-3">
                            <label class="form-label" for="availability_status"> Equipment Status</label>
                            <select class="js-example-basic-single form-select" data-width="100%" id="availability_status" name="availability_status">
                                <option>Available </option>
                                <option>In Use</option>
                                <option>Under Maintenance</option>
                                
                            </select>  
                        </div>
                      </div>
                    </div>

                    <!-- Row -->
                    <!-- Row -->
                    <div class="row">
                      <div class="col-sm-12">
                        <div class="mb-3">
                          <label class="form-label">Description</label>
                          <textarea
                            class="form-control"
                            name="description"
                            id="description"
                            rows="10"
                          ></textarea>
                        </div>
                      </div>
                      <!-- Col -->
                    </div>
                    <div class="row">
                    <div class="col-md-6">
                        <label class="form-label">Upload Files</label>
                        <input type="file" class="form-control" name="job_files[]" multiple accept=".jpg, .jpeg, .png, .pdf">
                        <small>Multiply Images upload*</small>
                        <div id="imagePreview" class="row mt-2 mb-5"></div>
                    </div>
                       
					
                    </div>
                    <!-- Row -->
                      <button type="submit" class="btn btn-primary submit">
                         Submit Equipment
                    </button>
                  </form>
                  
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
    <script src="assets/vendors/dropzone/dropzone.min.js"></script>

  <script src="assets/js/dropzone.js"></script>
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
    
    <!-- End custom js for this page -->
    <!-- <script type="text/javascript" src="js/jquery.js"></script> -->
    <!-- <script type="text/javascript" src="js/dropzone.js"></script> -->
    <!-- <script src="js/service_validation.js"></script> -->
   
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
   <!-- Latest version of Dropzone.js from unpkg -->


   <script src="assets/vendors/dropzone/dropzone.min.js"></script>
   <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.9.3/min/dropzone.min.js"></script> -->
  <script src="assets/js/dropzone.js"></script>
  
  <script>
  document.addEventListener("DOMContentLoaded", function () {
    // Get references to the file input and image preview div
    const fileInput = document.querySelector('input[type="file"]');
    const imagePreviewDiv = document.getElementById("imagePreview");

    // Listen for changes in the file input
    fileInput.addEventListener("change", function () {
      // Clear previous previews
      imagePreviewDiv.innerHTML = "";

      // Loop through selected files
      for (const file of fileInput.files) {
        if (file.type.match("image.*")) {
          // Create a new image element for each image file
          const img = document.createElement("img");
          img.classList.add("img-thumbnail");
          img.style.maxWidth = "100px"; // Set the maximum width
          img.style.maxHeight = "100px"; // Set the maximum height

          // Create a FileReader to read the file
          const reader = new FileReader();

          // Set up the FileReader onload event
          reader.onload = (function (theImg) {
            return function (e) {
              theImg.src = e.target.result; // Set the image source to the result
            };
          })(img);

          // Read the file and create the preview
          reader.readAsDataURL(file);

          // Append the image to the preview div
          imagePreviewDiv.appendChild(img);
        }
      }
    });

    // Get references to the form and form fields
    const form = document.getElementById("equipment");
    const nameInput = document.getElementById("name");
    const statusInput = document.getElementById("availability_status");
    const descriptionInput = document.getElementById("description");

    form.addEventListener("submit", function (event) {
      event.preventDefault();

      // Check if any input field is empty
      if (
        nameInput.value.trim() === "" ||
        statusInput.value.trim() === "" ||
        descriptionInput.value.trim() === "" ||
        fileInput.files.length === 0
      ) {
        // Display a SweetAlert indicating that a field is empty
        Swal.fire({
          icon: "error",
          title: "Error",
          text: "Please fill in all fields and select at least one file.",
        });
        return;
      }

      // Create a FormData object to collect form data
      const formData = new FormData(form);

      // Send the form data to the server using fetch
      fetch("insert_service_epuipment.php", {
        method: "POST",
        body: formData,
      })
        .then((response) => response.json()) // Assuming the server responds with JSON
        .then((data) => {
          if (data.success) {
            // Display success message
            Swal.fire({
              icon: "success",
              title: "Success",
              text: "Equipment submitted successfully!",
            });

            form.reset(); // Optionally, clear the form after successful submission
            imagePreviewDiv.innerHTML = ""; // Clear image previews
          } else {
            // Display error message
            Swal.fire({
              icon: "error",
              title: "Error",
              text: "Equipment submission failed.",
            });
          }
        })
        .catch((error) => {
          console.error("Error:", error);
          Swal.fire({
            icon: "error",
            title: "Error",
            text: "An error occurred while processing the request.",
          });
        });
    });
  });
</script>





  </body>
</html>
