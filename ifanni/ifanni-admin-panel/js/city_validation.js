document.addEventListener("DOMContentLoaded", function () {
  const form = document.getElementById("cityForm");
  const Name = document.getElementById("service_city");
  form.addEventListener("submit", function (event) {
    event.preventDefault();

    // Validate city name
    if (Name.value.trim() === "") {
      Swal.fire({
        icon: "error",
        title: "Error",
        text: "City is required.",
      });
      Name.focus();
      return false;
    }

    // If all validations pass, send the data to the PHP file via AJAX
    const formData = new FormData(form);

    fetch("ajax/insert_new_city.php", {
      method: "POST",
      body: formData,
    })
      .then((response) => response.text())
      .then((result) => {
        if (result === "success") {
          Swal.fire({
            icon: "success",
            title: "Success",
            text: "City registration successful!",
          }).then(() => {
            // Redirect to another page or perform other actions
            // window.location.href = 'your_page.php';
            form.reset(); // Clear form fields
          });
        } else {
          Swal.fire({
            icon: "error",
            title: "Error",
            text: "City registration failed.",
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
