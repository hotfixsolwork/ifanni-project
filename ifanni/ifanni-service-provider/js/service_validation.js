document.addEventListener("DOMContentLoaded", function () {
  const form = document.getElementById("service");
  const serviceTitle = document.getElementById("service_title");
  const category = document.getElementById("category_id");
  const country = document.getElementById("country_id");
  const city = document.getElementById("city_id");
  const description = document.getElementById("description");
  const serviceTitleError = document.getElementById("serviceTitleError");
  const descriptionError = document.getElementById("descriptionError");
  const submitButton = document.querySelector(".submit");
  const loadingIndicator = document.getElementById("loading");

  form.addEventListener("submit", function (event) {
    event.preventDefault();

    // Reset error messages and loading indicator
    serviceTitleError.textContent = "";
    descriptionError.textContent = "";
    loadingIndicator.style.display = "block";
    submitButton.disabled = true;
    submitButton.textContent = "Submitting...";

    // Validate service title (empty field and character limits)
    if (serviceTitle.value.trim() === "") {
      serviceTitleError.textContent = "Service Title is required.";
      serviceTitle.focus();
      resetLoadingIndicator();
      return false;
    } else if (
      serviceTitle.value.length < 5 ||
      serviceTitle.value.length > 50
    ) {
      serviceTitleError.textContent =
        "Service Title must be between 5 and 50 characters.";
      serviceTitle.focus();
      resetLoadingIndicator();
      return false;
    }

    // Validate category (empty field)
    if (category.value.trim() === "") {
      category.nextElementSibling.textContent = "Category is required.";
      resetLoadingIndicator();
      return false;
    }

    // Validate country (empty field)
    if (country.value.trim() === "") {
      country.nextElementSibling.textContent = "Country is required.";
      resetLoadingIndicator();
      return false;
    }

    // Validate city (empty field)
    if (city.value.trim() === "") {
      city.nextElementSibling.textContent = "City is required.";
      resetLoadingIndicator();
      return false;
    }

    // Validate description (empty field and character limits)
    if (description.value.trim() === "") {
      descriptionError.textContent = "Description is required.";
      description.focus();
      resetLoadingIndicator();
      return false;
    } else if (
      description.value.length < 25 ||
      description.value.length > 500
    ) {
      descriptionError.textContent =
        "Description must be between 25 and 500 characters.";
      description.focus();
      resetLoadingIndicator();
      return false;
    }

    // If all validations pass, you can submit the form
    const formData = new FormData(form);

    fetch("ajax/insert_service.php", {
      method: "POST",
      body: formData,
    })
      .then((response) => response.text())
      .then((result) => {
        if (result === "success") {
          // Show a SweetAlert on success
          Swal.fire({
            title: "Success",
            text: "Service registration successful!",
            icon: "success",
          }).then((result) => {
            if (result.isConfirmed || result.isDismissed) {
              // Redirect to all-service.php on SweetAlert confirmation or dismissal
              window.location.href = "all-service.php";
            }
          });
        } else {
          showAlert("Error", "Service registration failed.");
        }
      })
      .catch((error) => {
        console.error("Error:", error);
        showAlert("Error", "An error occurred while processing the request.");
      })
      .finally(() => {
        resetLoadingIndicator();
      });
  });

  // Helper function to reset the loading indicator and submit button
  function resetLoadingIndicator() {
    loadingIndicator.style.display = "none";
    submitButton.disabled = false;
    submitButton.textContent = "Submit";
  }

  // Helper function to show an alert
  function showAlert(title, text, icon) {
    alert(title + ": " + text);
  }
});
