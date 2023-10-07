document.addEventListener("DOMContentLoaded", function () {
  //console.log("Initializing Dropzone");
  const myDropzone = new Dropzone("#myDropzone", {
    url: "upload.php", // Replace with your PHP upload script URL
    paramName: "file", // Name of the file parameter
    maxFilesize: 5, // Maximum file size in MB
    acceptedFiles: ".jpg, .jpeg, .png, .pdf", // Allowed file types
    addRemoveLinks: true, // Show remove links
    init: function () {
      // Add event handler for when a file is added
      this.on("addedfile", function (file) {
        // You can add any additional handling here if needed
      });

      // Add event handler for when a file is removed
      this.on("removedfile", function (file) {
        // You can handle file removal here if needed
      });
    },
  });
});
