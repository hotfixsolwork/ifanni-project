document.addEventListener("DOMContentLoaded", function () {
  const form = document.getElementById("invocieForm");

  var customAttribute1Element = document.getElementById("customAttribute1");

  form.addEventListener("submit", function (event) {
    event.preventDefault();

    const Payment = document.getElementById("payment");
    const deadline = document.getElementById("deadline_date");

    var selectElement = document.getElementById("job_id");
    var selectedOption = selectElement.options[selectElement.selectedIndex];
    var customAttribute1 = selectedOption.getAttribute(
      "data-custom-attribute1"
    );

    if (Payment.value === "") {
      // Use SweetAlert for error message
      Swal.fire({
        icon: "error",
        title: "Oops...",
        text: "Payment is required!",
      });
      Payment.focus();
      return false;
    }

    const formData = new FormData(form);
    formData.append("customAttribute1", customAttribute1);

    fetch("insert_invoice.php", {
      method: "POST",
      body: formData,
    })
      .then((response) => response.text())
      .then((result) => {
        if (result === "Success") {
          // Use SweetAlert for success message
          Swal.fire({
            icon: "success",
            title: "Success",
            text: "Invoice sent successfully!",
          });
          // Clear the form or perform any other actions
          form.reset();
        } else {
          // Use SweetAlert for error message
          Swal.fire({
            icon: "error",
            title: "Oops...",
            text: "An error occurred while processing the request.",
          });
        }
      })
      .catch((error) => {
        console.error("Error:", error);
        // Use SweetAlert for error message
        Swal.fire({
          icon: "error",
          title: "Oops...",
          text: "An error occurred while processing the request.",
        });
      });
  });
});
