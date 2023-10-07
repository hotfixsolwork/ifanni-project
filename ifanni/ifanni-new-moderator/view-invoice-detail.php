<?php
include 'header.php';
$invoice_id = $_GET['invoice_id'];

$getInvoiceData = DB::queryFirstRow("select * from invoice where id = '$invoice_id'");


$getJobData = DB::queryFirstRow("select * from client_job where id = '".$getInvoiceData['job_id']."'");

$getClientDetail = DB::queryFirstRow("select * from clients where id = '".$getInvoiceData['client_id']."'");
?>
<!-- partial -->

			<div class="page-content">

				<!--<nav class="page-breadcrumb">
					<ol class="breadcrumb">
						<li class="breadcrumb-item"><a href="#">Special pages</a></li>
						<li class="breadcrumb-item active" aria-current="page">Invoice</li>
					</ol>
				</nav>-->

				<div class="row">
					<div class="col-md-12">
            <div class="card">
              <div class="card-body">
                <div class="container-fluid d-flex justify-content-between">
                  <div class="col-lg-3 ps-0">
                    <a href="#" class="noble-ui-logo d-block mt-3"><img src="images/ifanni.png" width="120px"></a>                 
<!--                    <p class="mt-1 mb-1"><b>NobleUI Themes</b></p>-->
<!--                    <p>108,<br> Great Russell St,<br>London, WC1B 3NA.</p>-->
                    <h5 class="mt-5 mb-2 text-muted">Invoice to :</h5>
                    <p><?=$getClientDetail['client_name']?><br><?=$getClientDetail['client_email']?><br> <?=$getClientDetail['client_address']?></p>
                  </div>
                  <div class="col-lg-3 pe-0">
                    <h4 class="fw-bolder text-uppercase text-end mt-4 mb-2">Invoice</h4>
                    <h6 class="text-end mb-5 pb-4"># INV-<?=$getInvoiceData['id']?></h6>
                    <p class="text-end mb-1">Balance Due</p>
                    <h4 class="text-end fw-normal">SAR <?=$getInvoiceData['payment']?></h4>
                    <h6 class="mb-0 mt-3 text-end fw-normal mb-2"><span class="text-muted">Invoice Date :</span> <?=$getInvoiceData['today_date']?></h6>
                    <h6 class="text-end fw-normal"><span class="text-muted">Due Date :</span> <?=$getInvoiceData['due_date']?></h6>
                  </div>
                </div>
                <div class="container-fluid mt-5 d-flex justify-content-center w-100">
                  <div class="table-responsive w-100">
                      <table class="table table-bordered">
                        <thead>
                          <tr>
                              <th>Invoice ID</th>


                              <th class="text-end">Unit cost</th>
                              <th class="text-end">Total</th>
                            </tr>
                        </thead>
                        <tbody>
                          <tr class="text-end">
                            <td class="text-start"># INV-<?=$getInvoiceData['id']?></td>


                            <td>SAR <?=$getInvoiceData['payment']?></td>
                            <td>SAR <?=$getInvoiceData['payment']?></td>
                          </tr>

                        </tbody>
                      </table>
                    </div>
                </div>
                <div class="container-fluid mt-5 w-100">
                  <div class="row">
                    <div class="col-md-6 ms-auto">
                        <div class="table-responsive">
                          <table class="table">
                              <tbody>
                                <tr>
                                  <td>Sub Total</td>
                                  <td class="text-end">SAR <?=$getInvoiceData['payment']?></td>
                                </tr>

                                <tr>
                                  <td class="text-bold-800">Total</td>
                                  <td class="text-bold-800 text-end"> SAR <?=$getInvoiceData['payment']?></td>
                                </tr>


                              </tbody>
                          </table>
                        </div>
                    </div>
                  </div>
                </div>
                <div class="container-fluid w-100">
<!--                  <a href="javascript:;" class="btn btn-primary float-end mt-4 ms-2"><i data-feather="send" class="me-3 icon-md"></i>Send Invoice</a>-->
<!--                  <a href="javascript:;" class="btn btn-outline-primary float-end mt-4"><i data-feather="printer" class="me-2 icon-md"></i>Print</a>-->
                </div>
              </div>
            </div>
					</div>
				</div>
			</div>

			<!-- partial:../../partials/_footer.html -->
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
	<!-- End plugin js for this page -->

	<!-- inject:js -->
	<script src="assets/vendors/feather-icons/feather.min.js"></script>
	<script src="assets/js/template.js"></script>
	<!-- endinject -->

	<!-- Custom js for this page -->
	<!-- End custom js for this page -->

</body>
</html>