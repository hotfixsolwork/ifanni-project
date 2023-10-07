document.addEventListener("DOMContentLoaded", function () {
  const form = document.getElementById("add-service-provider-info");
  const serviceproviderName = document.getElementById("service_provider_name");
  const serviceproviderEmail = document.getElementById(
    "service_provider_email"
  );
  const serviceproviderPhone = document.getElementById(
    "service_provider_phone"
  );
  const serviceproviderAddress = document.getElementById(
    "service_provider_address"
  );

  form.addEventListener("submit", function (event) {
    event.preventDefault();

    // Validate client name
    if (serviceproviderName.value.trim() === "") {
      alert("Service Prover Name is required.");
      serviceproviderName.focus();
      return false;
    }

    // Validate email (basic format validation)
    const emailPattern = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}$/;
    if (!emailPattern.test(serviceproviderEmail.value)) {
      alert("Please enter a valid email address.");
      serviceproviderEmail.focus();
      return false;
    }

    // Validate client name (empty field)
    if (serviceproviderPhone.value.trim() === "") {
      alert("Service Provder Phone is required.");
      serviceproviderName.focus();
      return false;
    }

    // Validate address
    if (serviceproviderAddress.value.trim() === "") {
      alert("Address is required.");
      serviceproviderAddress.focus();
      return false;
    }

    // If all validations pass, send the data to the PHP file via AJAX
    const formData = new FormData(form);

    fetch("insert_service_provder.php", {
      method: "POST",
      body: formData,
    })
      .then((response) => response.text())
      .then((result) => {
        // Handle the response from the PHP file (e.g., display a success message)
        alert(result);
      })
      .catch((error) => {
        console.error("Error:", error);
      });
  });
});
