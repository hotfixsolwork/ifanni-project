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
                  <form id="job" method="post"  enctype="multipart/form-data">
                    <div class="row">
                      <div class="col-sm-6">
                        <div class="mb-3">
                          <label class="form-label">Job Title</label>
                          <input
                          id="job_title"
                          name="job_title"
                            type="text"
                            class="form-control"
                            placeholder="Enter Job Title"
                          />
                          <div class="validation-message" id="job_title_message"></div>
                        </div>
                        
                      </div>
                      <!-- Col -->
                      <div class="col-sm-6">
                        <div class="mb-3">
                          <label class="form-label">Category </label>
                          <select
                          id="category_id"
                          name="category_id"

                          class="js-example-basic-single form-select"
                          data-width="100%"
                          required
                          >
                          <?php
                          // Fetch categories from the database and populate the options
                          $categories = DB::query("SELECT * FROM categories");
                          foreach ($categories as $category) {
                              echo '<option value="' . $category['id'] . '">' . $category['name'] . '</option>';
                          }
                          ?>
                          </select>
                        </div>
                      </div>
                      
                      <!-- Col -->

                    </div>
                    <!-- Row -->
                    <div class="row">
                    <div class="col-sm-6">
                        <div class="mb-3">
                          <label class="form-label">City </label>
                          <select
                               id="city_id"
                                name="city_id"
                                class="js-example-basic-single form-select"
                                data-width="100%"
                                required
                                >
                                <?php
                                // Fetch countries from the database and populate the options
                                $cities = DB::query("SELECT * FROM service_cities");
                                foreach ($cities as $city) {
                                    echo '<option value="' . $city['id'] . '">' . $city['service_city'] . '</option>';
                                }
                                ?>
                            </select>
                        </div>
                      </div>
                      <div class="col-sm-6">
                        <div class="mb-3">
                          <label class="form-label">Country </label>
                          <select
                               id="country_id"
                                name="country_id"
                                class="js-example-basic-single form-select"
                                data-width="100%"
                                required
                                >
                                <?php
                                // Fetch countries from the database and populate the options
                                $countries = DB::query("SELECT * FROM countries");
                                foreach ($countries as $country) {
                                    echo '<option value="' . $country['id'] . '">' . $country['name'] . '</option>';
                                }
                                ?>
                            </select>
                        </div>
                      </div>
                    </div>
                    <!-- Row -->
                    <div class="row">
                      <!-- Col -->
                      <div class="col-sm-6">
                        <div class="mb-3">
                          <label class="form-label"
                            >Deadline to Apply for this job *</label
                          >
                          <div
                            class="input-group flatpickr"
                            id="flatpickr-date"
                          >
                            <input
                              type="text"
                              class="form-control"
                              placeholder="Select date"
                              data-input
                              id="deadline_date"
                              name="deadline_date"
                            />
                            <span
                              class="input-group-text input-group-addon"
                              data-toggle
                              ><i data-feather="calendar"></i
                            ></span>
                            
                          </div>
                          <div class="validation-message" id="deadline_date_message"></div>
                        </div>
                      </div>
                         <div class="mb-3">
                            <label class="form-label">Upload Files:</label>
                            <div id="myDropzone"class="dropzone"></div>
                        </div>
                        <!--<div class="col-md-6">
                          <div class="mb-3">
                            <div class="row">
                              <div class="col-md-6">
                                  <label class="form-label">Upload Files</label>
                                  <input type="file" class="form-control" id="imageInput" name="job_files[]" multiple accept=".jpg, .jpeg, .png, .pdf">
                                  <small>Multiply Images Uploads*</small>

                              </div>
                              <div class="col-md-6">
                               
                                <div id="imagePreviewContainer">
                                  <div id="imagePreview"></div>
                                </div>

                              </div>
                            </div>
                            <div class="validation-message" id="job_files_message"></div>
                            
                            

                          </div>
                          
                        </div>-->
                        <div class="col-sm-6">
                        <div class="mb-3">
                          <label class="form-label">Location</label>
                          <input
                          id="location"
                          name="location"
                            type="text"
                            class="form-control"
                            placeholder="Enter Job Location"
                          />
                          <div class="validation-message" id="location_message"></div>
                        </div>
                      </div>
                       

                      <div class="col-sm-12">
                        <div class="mb-3">
                          <label class="form-label">Description</label>
                          <textarea
                            class="form-control"
                            name="description"
                            id="description"
                            rows="10"
                          ></textarea>
                          <div class="validation-message" id="description_message"></div>
                        </div>
                      </div>
                      <!-- Col -->
                    </div>
                    <!-- Row -->
                    <div id="submit-now">
                      <button type="submit" class="btn btn-primary submit">
                        Submit Job
                      </button>
                      <div style="display: none" id="loading">
                        <img style="width: 50px" src="images/loader.gif" alt="Loading..." />
                      </div>
                    </div>

                      
                  </form>
                  
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
    <style>
        /* Define the maximum width and height for the previewed images */
        .preview-image {
            max-width: 100px; /* Adjust the desired width */
            max-height: 100px; /* Adjust the desired height */
        }
        #imagePreviewContainer {
        white-space: nowrap; /* Ensure images are displayed in one row */
        overflow-x: auto; 
        /* cursor: pointer;  Add horizontal scrollbar if necessary */
       }
       .close-icon {
    cursor: pointer;
     }

.image-container {
    margin-right: 10px; /* Add spacing between images */
}
        
    </style>
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
    <!-- <script src="assets/vendors/pickr/pickr.min.js"></script> -->
    <script src="assets/vendors/flatpickr/flatpickr.min.js"></script>
    <script src="assets/vendors/datatables.net/jquery.dataTables.js"></script>
    <script src="assets/vendors/datatables.net-bs5/dataTables.bootstrap5.js"></script>
    <script src="assets/js/data-table.js"></script>
    <script src="assets/vendors/select2/select2.min.js"></script>
    <script src="assets/js/select2.js"></script>
    <!-- <script src="assets/js/pickr.js"></script> -->
    <script src="assets/js/flatpickr.js"></script>
    <script src="assets/vendors/easymde/easymde.min.js"></script>
    <script src="assets/js/easymde.js"></script>
    <!-- endinject -->

    <!-- Custom js for this page -->
    <script src="assets/js/dashboard-light.js"></script>
    
    <!-- End custom js for this page -->
    <script type="text/javascript" src="js/jquery.js"></script>
    <script type="text/javascript" src="js/dropzone.js"></script>
    <script src="job_validation.js"></script>
   
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
   <!-- Latest version of Dropzone.js from unpkg -->

   <script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.9.3/min/dropzone.min.js"></script>

<script>
    // Get references to the file input and preview container
    const imageInput = document.getElementById('imageInput');
    const imagePreview = document.getElementById('imagePreview');

    // Array to store selected files
    const selectedFiles = [];

    // Add an event listener to the file input
    imageInput.addEventListener('change', function () {
        // Clear previous previews
        imagePreview.innerHTML = '';

        // Loop through selected files
        for (const file of imageInput.files) {
            // Check if the file is an image
            if (file.type.startsWith('image/')) {
                // Create a container div for each image
                const imgContainer = document.createElement('div');
                imgContainer.classList.add('image-container');

                // Add style to display images inline
                imgContainer.style.display = 'inline-block';
                // Create a new image element
                const img = document.createElement('img');
                img.classList.add('preview-image');
                img.file = file;

                // Create a close icon (cross) element
                const closeIcon = document.createElement('i');
                closeIcon.classList.add('close-icon');
                closeIcon.innerHTML = '&times;'; // You can use any icon you prefer

                // Add a click event to remove the image when the close icon is clicked
                closeIcon.addEventListener('click', function () {
                    imgContainer.remove(); // Remove the entire container
                    const index = selectedFiles.indexOf(file);
                    if (index !== -1) {
                        selectedFiles.splice(index, 1); // Remove the file from the selectedFiles array
                    }
                });

                // Create a FileReader to read the image file
                const reader = new FileReader();

                // Set up the FileReader callback to display the image
                reader.onload = (function (aImg) {
                    return function (e) {
                        aImg.src = e.target.result;
                    };
                })(img);

                // Read the image file as a data URL
                reader.readAsDataURL(file);

                // Append the image and close icon to the container
                imgContainer.appendChild(img);
                imgContainer.appendChild(closeIcon);

                // Append the container to the preview container
                imagePreview.appendChild(imgContainer);

                // Add the file to the selected files array
                selectedFiles.push(file);
            }
        }
    });
</script>
<script>
        // Initialize Dropzone
        Dropzone.autoDiscover = false;
        var myDropzone = new Dropzone("#myDropzone", {
            url: "upload_profile_image.php", // Replace with your server-side upload URL
            acceptedFiles: "image/*", // Specify accepted file types
            maxFiles: 1, // Limit the number of uploaded files
            maxFilesize: 2, // Limit the file size to 2MB
            paramName: "profile_image", // Name of the file parameter to be sent to the server
            addRemoveLinks: true, // Show remove links for uploaded files
            dictDefaultMessage: "Drop your profile image here or click to select",
            dictRemoveFile: "Remove",
            dictMaxFilesExceeded: "You can only upload one image."
        });

        // Handle the "success" event when an image is uploaded successfully
        myDropzone.on("success", function (file, response) {
            console.log("Image uploaded successfully.", response);
        });

        // Handle the "removedfile" event when a file is removed
        myDropzone.on("removedfile", function (file) {
            console.log("Image removed:", file);
        });
    </script>

  </body>
</html>
