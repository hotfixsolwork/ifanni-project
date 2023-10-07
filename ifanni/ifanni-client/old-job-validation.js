// Wait for the DOM to be fully loaded
document.addEventListener("DOMContentLoaded", function () {
  // Get references to the form and form elements
  const form = document.getElementById("job");
  const deadlineDateInput = document.getElementById("deadline_date");
  const submitButton = document.querySelector(".submit");
  const loadingIndicator = document.getElementById("loading");

  // Set today's date without time
  const today = new Date();
  today.setHours(0, 0, 0, 0);

  // Initialize flatpickr for the deadline date input
  flatpickr(deadlineDateInput, {
    enableTime: false,
    dateFormat: "Y-m-d",
    minDate: today,
    defaultDate: today,
  });

  // Add a submit event listener to the form
  form.addEventListener("submit", function (event) {
    event.preventDefault();

    // Get the job title input and trim its value
    const jobTitle = document.getElementById("job_title");
    const jobTitleValue = jobTitle.value.trim();

    // Validate the job title length
    if (jobTitleValue.length < 3 || jobTitleValue.length > 20) {
      showAlert(
        "Error",
        "Job Title must be between 3 and 20 characters long.",
        "error"
      );
      jobTitle.focus();
      return false;
    }

    // You can add more validation for other form fields here if needed

    // Check if the file input is empty
    const jobFilesInput = document.querySelector('input[name="job_files[]"]');
    if (jobFilesInput.files.length === 0) {
      showAlert("Error", "Please select at least one file.", "error");
      return false;
    }

    // If all validations pass, submit the form
    const formData = new FormData(form);

    // Show loading indicator and hide the submit button
    submitButton.style.display = "none";
    loadingIndicator.style.display = "block";

    // Perform the form submission using fetch
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
            // Redirect to jobs.php on success after a brief delay
            setTimeout(function () {
              window.location.href = "jobs.php";
            }, 2000); // Delay for 2 seconds (adjust as needed)
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
        // Hide loading indicator and show the submit button again
        submitButton.style.display = "block";
        loadingIndicator.style.display = "none";
      });
  });

  // Function to display a SweetAlert modal
  function showAlert(title, text, icon) {
    Swal.fire({
      title: title,
      text: text,
      icon: icon,
    });
  }
});
