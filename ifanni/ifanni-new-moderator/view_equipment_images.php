<?php
include 'header.php';
require_once("ajax/db_connection.php");

if (isset($_GET['image_url'])) {
    $image_url = $_GET['image_url'];
} else {
    // Handle the case where image_url is not provided
    echo "Image URL is missing.";
    exit();
}
?>

<!-- partial -->
<div class="page-content">
    
    <div class="row">
        <div class="col-md-4 mx-auto">
            <div class="row d-flex justify-content-between">
                <div class="col-md-6">
                <h4 class="mt-3 mb-3 mx-3">View Equipment Images</h4>
                </div>
                <div class="col-md-6">
                <a href="javascript:history.back()" class="btn btn-primary">Back</a>
                </div>
            </div>
          
            <div class="card">
                <div class="card-body text-center">
                    <!-- Display the equipment image -->
                    <img src="<?php echo $image_url; ?>" alt="Equipment Image" width="100"><br>
                    
                    <!-- You can also add a link to go back to the previous page if necessary -->
                   
                </div>
            </div>
            
        </div>
    </div>
</div>

<!-- partial:partials/_footer.html -->
<footer class="footer d-flex flex-column flex-md-row align-items-center justify-content-between px-4 py-3 border-top small">
    <p class="text-muted mb-1 mb-md-0">
        Copyright © 2022
        <a href="https://www.ifanni" target="_blank">Ifanni.sa</a>.
    </p>
</footer>
<!-- partial -->
<script src="assets/vendors/core/core.js"></script>
<script src="assets/vendors/feather-icons/feather.min.js"></script>
<script src="assets/js/template.js"></script>
<script src="assets/vendors/prismjs/prism.js"></script>
<script src="assets/vendors/clipboard/clipboard.min.js"></script>
</div>
</div>
</html>
