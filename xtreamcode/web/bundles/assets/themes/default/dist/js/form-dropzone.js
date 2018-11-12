$(function() {
    Dropzone.autoDiscover = false;
    var myDropzone = new Dropzone("#form-upload",{
        acceptedFiles: "video/*",
        url: "http://localhost/besttranscoder/en/admin/vod/upload",
        previewsContainer: ".dropzone-previews",
    });

    var existingFileCount = 0; // The number of files already uploaded

    myDropzone.on("success", function (file, responseText) {
        // Increment file number.
        existingFileCount++;

        // Create the remove button
        var removeButton = Dropzone.createElement("<button class='btn btn-sm btn-block btn-danger'>Remove file</button>");

        // Capture the Dropzone instance as closure.
        var _this = this;

        // Listen to the click event
        removeButton.addEventListener("click", function (e) {
            // Make sure the button click doesn't submit the form:
            e.preventDefault();
            e.stopPropagation();

            // Remove the file preview.
            _this.removeFile(file);

            // If you want to the delete the file on the server as well,
            // you can do the AJAX request here.
            $.ajax({
                type: "POST",
                url: "http://localhost/besttranscoder/en/admin/vod/remove_file", // Send the info to this page
                data: "file=" + responseText,
                success: function (msg) {
                }
            });
        });

        // Add the button to the file preview element.
        file.previewElement.appendChild(removeButton);
    });

    $("#btn-submit").click(function(e){
        if(existingFileCount  == 0) {
            $(".dropzone-previews").css("border-color", "#a94442");
            e.preventDefault;
        }
    });
});
