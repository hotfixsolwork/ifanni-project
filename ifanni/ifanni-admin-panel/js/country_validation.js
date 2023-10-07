document.addEventListener("DOMContentLoaded", function () {
  const form = document.getElementById("countryForm");
  const Name = document.getElementById("name");
  form.addEventListener("submit", function (event) {
    event.preventDefault();

    // Validate client name
    if (Name.value.trim() === "") {
      alert("Country  is required.");
      Name.focus();
      return false;
    }

    // If all validations pass, send the data to the PHP file via AJAX
    const formData = new FormData(form);

    fetch("ajax/insert_new_country.php", {
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
