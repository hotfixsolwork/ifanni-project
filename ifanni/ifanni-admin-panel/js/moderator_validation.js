document.addEventListener("DOMContentLoaded", function () {
  const form = document.getElementById("moderatorForm");
  const Email = document.getElementById("email");
  const Password = document.getElementById("password");

  form.addEventListener("submit", function (event) {
    event.preventDefault();

    // Validate client name
    if (Email.value.trim() === "") {
      Swal.fire({
        icon: "error",
        title: "Error",
        text: "Email is required.",
      });
      Email.focus();
      return false;
    }

    // Validate client name (empty field)
    if (Password.value.trim() === "") {
      Swal.fire({
        icon: "error",
        title: "Error",
        text: "Password is required.",
      });
      Password.focus();
      return false;
    }

    // If all validations pass, send the data to the PHP file via AJAX
    const formData = new FormData(form);

    fetch("ajax/insert_new_moderator.php", {
      method: "POST",
      body: formData,
    })
      .then((response) => response.text())
      .then((result) => {
        if (result === "success") {
          Swal.fire({
            icon: "success",
            title: "Success",
            text: "Moderator registration successful!",
          });
          // Clear form fields or redirect to another page
          form.reset(); // Clear form fields
        } else {
          Swal.fire({
            icon: "error",
            title: "Error",
            text: "Moderator registration failed.",
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
