document.addEventListener("DOMContentLoaded", function () {
  const form = document.getElementById("job");
  const submitButton = document.querySelector(".submit");
  const loadingIndicator = document.getElementById("loading");

  // Initialize flatpickr for the deadline date input
  flatpickr(document.getElementById("deadline_date"), {
    enableTime: false,
    dateFormat: "Y-m-d",
    minDate: "today",
  });

  form.addEventListener("submit", function (event) {
    event.preventDefault();

    // Clear previous validation messages
    clearValidationMessages();

    const jobTitle = document.getElementById("job_title");
    const jobTitleValue = jobTitle.value.trim();

    if (jobTitleValue.length < 3 || jobTitleValue.length > 20) {
      displayValidationMessage(
        "job_title_message",
        "Job Title must be between 3 and 20 characters long."
      );
      jobTitle.focus();
      return false;
    }

    const deadlineDate = document.getElementById("deadline_date");
    const deadlineDateValue = deadlineDate.value.trim();

    if (!deadlineDateValue) {
      displayValidationMessage(
        "deadline_date_message",
        "Deadline is required."
      );
      deadlineDate.focus();
      return false;
    }
    const location = document.getElementById("location");
    const locationValue = location.value.trim();

    if (locationValue.length < 3 || locationValue.length > 25) {
      displayValidationMessage(
        "location_message",
        "Location must be between 3 and 25 characters long."
      );
      location.focus();
      return false;
    }

    const description = document.getElementById("description");
    const descriptionValue = description.value.trim();

    if (descriptionValue.length < 10 || descriptionValue.length > 500) {
      displayValidationMessage(
        "description_message",
        "Description must be between 10 and 500 characters long."
      );
      description.focus();
      return false;
    }

    const jobFilesInput = document.querySelector('input[name="job_files[]"]');
    if (jobFilesInput.files.length === 0) {
      displayValidationMessage(
        "job_files_message",
        "Please select at least one file."
      );
      return false;
    }

    // If all validations pass, submit the form
    const formData = new FormData(form);

    submitButton.style.display = "none";
    loadingIndicator.style.display = "block";

    fetch("insert_job.php", {
      method: "POST",
      body: formData,
    })
      .then((response) => {
        console.log("Response Status:", response.status);
        return response.text();
      })
      .then((responseText) => {
        console.log("Response Data:", responseText);

        try {
          const result = JSON.parse(responseText);

          if (result.success) {
            showAlert("Success", result.message, "success");
            setTimeout(function () {
              window.location.href = "jobs.php";
            }, 2000);
          } else {
            showAlert("Error", result.message, "error");
          }
        } catch (error) {
          console.error("JSON Parsing Error:", error);
          showAlert(
            "Error",
            "An error occurred while processing your request.",
            "error"
          );
        }
      })
      .catch((error) => {
        console.error("Fetch Error:", error);
        showAlert(
          "Error",
          "An error occurred while processing your request.",
          "error"
        );
      })
      .finally(() => {
        submitButton.style.display = "none";
        loadingIndicator.style.display = "block";
      });
  });

  function showAlert(title, text, icon) {
    Swal.fire({
      title: title,
      text: text,
      icon: icon,
    });
  }

  function displayValidationMessage(containerId, message) {
    const validationMessageElement = document.getElementById(containerId);
    validationMessageElement.textContent = message;
    validationMessageElement.style.color = "red";
    validationMessageElement.style.display = "block";
  }

  function clearValidationMessages() {
    const validationMessageElements = document.querySelectorAll(
      ".validation-message"
    );
    validationMessageElements.forEach((element) => {
      element.textContent = "";
      element.style.display = "none";
    });
  }
});
