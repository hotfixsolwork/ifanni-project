document.addEventListener("DOMContentLoaded", function () {
  const form = document.getElementById("job");

  const jobTitle = document.getElementById("job_title");
  const category = document.getElementById("category_id");
  const budget = document.getElementById("budget");
  const country = document.getElementById("country_id");
  const deadline = document.getElementById("deadline_date");
  const description = document.getElementById("description");

  form.addEventListener("submit", function (event) {
    event.preventDefault();

    // Perform validation here for each field
    if (jobTitle.value.trim() === "") {
      Swal.fire({
        title: "Error",
        text: "Name is required.",
        icon: "error",
      });
      jobTitle.focus();
      return false;
    }

    if (category.value === "") {
      Swal.fire({
        title: "Error",
        text: "Category Name is required.",
        icon: "error",
      });
      category.focus();
      return false;
    }

    if (isNaN(parseFloat(budget.value)) || parseFloat(budget.value) <= 0) {
      Swal.fire({
        title: "Error",
        text: "Budget is required.",
        icon: "error",
      });
      budget.focus();
      return;
    }

    if (country.value === "") {
      Swal.fire({
        title: "Error",
        text: "Country is required.",
        icon: "error",
      });
      country.focus();
      return false;
    }

    if (deadline.value.trim() === "") {
      Swal.fire({
        title: "Error",
        text: "Deadline Date is required.",
        icon: "error",
      });
      deadline.focus();
      return false;
    }

    if (description.value.trim() === "") {
      Swal.fire({
        title: "Error",
        text: "Description is required.",
        icon: "error",
      });
      description.focus();
      return false;
    }

    // If all validations pass, submit the form
    const formData = new FormData(form);

    fetch("ajax/insert_job.php", {
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
        console.error("Fetch Error:", error); // Log the specific error message
        Swal.fire({
          title: "Error",
          text: "An error occurred while processing your request.",
          icon: "error",
        });
      });
  });
});
