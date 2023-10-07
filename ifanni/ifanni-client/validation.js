document.addEventListener("DOMContentLoaded", function () {
  const form = document.getElementById("add-client-info");
  const clientName = document.getElementById("client_name");
  const clientEmail = document.getElementById("client_email");
  const clientPhone = document.getElementById("client_phone");
  const clientAddress = document.getElementById("client_adress");

  form.addEventListener("submit", function (event) {
    event.preventDefault();

    // Validate client name
    if (clientName.value.trim() === "") {
      alert("Client Name is required.");
      clientName.focus();
      return false;
    }

    // Validate email (basic format validation)
    const emailPattern = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}$/;
    if (!emailPattern.test(clientEmail.value)) {
      alert("Please enter a valid email address.");
      clientEmail.focus();
      return false;
    }

    // Validate client name (empty field)
    if (clientPhone.value.trim() === "") {
      alert("Client Phone is required.");
      clientName.focus();
      return false;
    }

    // Validate address
    if (clientAddress.value.trim() === "") {
      alert("Address is required.");
      clientAddress.focus();
      return false;
    }

    // If all validations pass, send the data to the PHP file via AJAX
    const formData = new FormData(form);

    fetch("insert_client.php", {
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
