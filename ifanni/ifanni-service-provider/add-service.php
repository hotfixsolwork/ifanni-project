<?php
include 'header.php';
?>
        <!-- partial -->
        <div class="page-content">
          <h4 class="mt-3 mb-3">Create New Service</h4>
          <div class="row">
            <div class="col-md-12 stretch-card">
              <div class="card">
                <div class="card-body">
                  <!-- <h6 class="card-title">Form Grid</h6> -->
                  <form id="service" method="post" enctype="multipart/form-data">
                    <div class="row">
                      <div class="col-sm-6">
                        <div class="mb-3">
                          <label class="form-label">Service Title</label>
                          <input
                          id="service_title"
                          name="service_title"
                            type="text"
                            class="form-control"
                            placeholder="Enter Service Title (5-50 characters)"
                          />
                          <span class="text-danger" id="serviceTitleError"></span>
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
                      
                     

                      <!-- Col -->
                    </div>
                    <!-- Row -->
                    <div class="row">
                      <div class="col-sm-12">
                        <div class="mb-3">
                          <label class="form-label">Description</label>
                          <textarea
                            class="form-control"
                            name="description"
                            id="description"
                            rows="3"
                            placeholder="Enter Description (25-500 characters)"
                          ></textarea>
                          <span class="text-danger" id="descriptionError"></span>
                        </div>
                      </div>
                      <!-- Col -->
                    </div>
                    <!-- Row -->
                    <div id="submit-now">
                          <button type="submit" class="btn btn-primary submit">
                            Submit 
                          </button>
                          <div style="display:none" id="loading">
                            <img style="width: 50px" src="loader.gif" alt="Loading..." />
                          </div>
                        </div>
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
    <script src="assets/vendors/feather-icons/feather.min.js"></script>
    <script src="assets/js/template.js"></script>
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
    <!-- <script type="text/javascript" src="js/jquery.js"></script> -->
    <!-- <script type="text/javascript" src="js/dropzone.js"></script> -->
    <script src="js/service_validation.js"></script>
   
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

   <!-- Latest version of Dropzone.js from unpkg -->

<script src="https://unpkg.com/dropzone@5.9.3/dist/min/dropzone.min.js"></script>


  </body>
</html>
