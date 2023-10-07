document.addEventListener("DOMContentLoaded", function () {
  const form = document.getElementById("serviceForm");
  const Name = document.getElementById("service_area");
  form.addEventListener("submit", function (event) {
    event.preventDefault();

    // Validate service area name
    // Validate service area name
    if (Name.value.trim() === "") {
      Swal.fire({
        title: "Error",
        text: "Service Area Name is required.",
        icon: "error",
      });
      Name.focus();
      return false;
    }

    // If all validations pass, send the data to the PHP file via AJAX
    const formData = new FormData(form);

    fetch("ajax/insert_new_service_area.php", {
      method: "POST",
      body: formData,
    })
      .then((response) => response.json())
      .then((result) => {
        // Handle the response from the PHP file
        if (result.status === "success") {
          Swal.fire({
            title: "Success",
            text: result.message,
            icon: "success",
          }).then(function () {
            // You can redirect to another page here if needed
            // window.location.href = 'your_redirect_page.php';
          });
        } else {
          Swal.fire({
            title: "Error",
            text: result.message,
            icon: "error",
          });
        }
      })
      .catch((error) => {
        Swal.fire({
          title: "Error",
          text: "An error occurred while processing your request.",
          icon: "error",
        });
        console.error("Error:", error);
      });
  });
});
