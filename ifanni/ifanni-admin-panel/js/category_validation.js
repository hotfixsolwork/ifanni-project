document.addEventListener("DOMContentLoaded", function () {
  const form = document.getElementById("categoryForm");
  const Name = document.getElementById("name");
  const description = document.getElementById("description");

  form.addEventListener("submit", function (event) {
    event.preventDefault();

    // Validate category name
    if (Name.value.trim() === "") {
      Swal.fire({
        icon: "error",
        title: "Error",
        text: "Category is required.",
      });
      Name.focus();
      return false;
    }

    // Validate description (empty field)
    if (description.value.trim() === "") {
      Swal.fire({
        icon: "error",
        title: "Error",
        text: "Description is required.",
      });
      description.focus();
      return false;
    }

    // If all validations pass, send the data to the PHP file via AJAX
    const formData = new FormData(form);

    fetch("ajax/insert_new_category.php", {
      method: "POST",
      body: formData,
    })
      .then((response) => response.text())
      .then((result) => {
        if (result === "success") {
          Swal.fire({
            icon: "success",
            title: "Success",
            text: "Category registration successful!",
          });
          // Clear form fields or redirect to another page
          form.reset(); // Clear form fields
        } else {
          Swal.fire({
            icon: "error",
            title: "Error",
            text: "Category registration failed.",
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
