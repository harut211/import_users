// $(document).ready(function () {
//     let $fileUpload = $('#file-upload');
//     let $fileInput = $('#file-input');
//     let $fileList = $('#file-list');
//     let uploadedFiles = [];
//
//
//     $fileUpload.on('dragover', function (e) {
//         e.preventDefault();
//         e.stopPropagation();
//         $(this).addClass('dragover');
//     });
//
//     $fileUpload.on('dragleave', function (e) {
//         e.preventDefault();
//         e.stopPropagation();
//         $(this).removeClass('dragover');
//     });
//
//     $fileUpload.on('drop', function (e) {
//         e.preventDefault();
//         e.stopPropagation();
//         $(this).removeClass('dragover');
//
//         let files = e.originalEvent.dataTransfer.files;
//         handleFiles(files);
//     });
//
//
//     $fileUpload.on('click', function (e) {
//         if (e.target.id !== 'file-input') {
//             $fileInput.click();
//         }
//     });
//
//     $fileInput.on('change', function () {
//         let files = this.files;
//         handleFiles(files);
//     });
//
//
//     function handleFiles(files) {
//         $fileList.empty();
//         $.each(files, function (index, file) {
//             uploadedFiles.push(file);
//             $fileList.append('<p>' + file.name + '</p>');
//         });
//     }
//
//     $('.file-send').on('click', function (){
//         if (uploadedFiles.length === 0) {
//             alert('Please select or drop files first.');
//             return;
//         }
//
//         let formData = new FormData();
//         $.each(uploadedFiles, function(index, file) {
//             formData.append('files[]', file);
//         });
//
//         $.ajax({
//             url: "/file-upload",
//             type: "POST",
//             data: formData,
//             processData: false,
//             contentType: false,
//             success: function(result){
//                 try {
//                     let  url = "http://127.0.0.1:8000/select-headers/" + result;
//                     window.location.replace(url);
//                     console.log(result);
//                 } catch (error) {
//                     alert(error.message);
//                 }
//
//             },
//             error: function(error) {
//                alert('Something went wrong... ');
//             }
//         });
//     });
// });
$(document).ready(function () {
    let $fileUpload = $('#file-upload');
    let $fileInput = $('#file-input');
    let $fileList = $('#file-list');
    let uploadedFile = null;

    $fileUpload.on('dragover', function (e) {
        e.preventDefault();
        e.stopPropagation();
        $(this).addClass('dragover');
    });

    $fileUpload.on('dragleave', function (e) {
        e.preventDefault();
        e.stopPropagation();
        $(this).removeClass('dragover');
    });

    $fileUpload.on('drop', function (e) {
        e.preventDefault();
        e.stopPropagation();
        $(this).removeClass('dragover');

        let file = e.originalEvent.dataTransfer.files[0];
        handleFile(file);
    });

    $fileUpload.on('click', function (e) {
        if (e.target.id !== 'file-input') {
            $fileInput.click();
        }
    });

    $fileInput.on('change', function () {
        let file = this.files[0];
        handleFile(file);
    });

    function handleFile(file) {
        $fileList.empty();
        uploadedFile = file;
        $fileList.append('<p>' + file.name + '</p>');
    }

    $('.file-send').on('click', function () {
        if (!uploadedFile) {
            alert('Please select or drop a file first.');
            return;
        }

        let formData = new FormData();
        formData.append('file', uploadedFile);

        $.ajax({
            url: "/file-upload",
            type: "POST",
            data: formData,
            processData: false,
            contentType: false,
            success: function(result) {
                try {
                    let url = "http://127.0.0.1:8000/select-headers/" + result;
                    window.location.replace(url);
                    console.log(result);
                } catch (error) {
                    alert(error.message);
                }
            },
            error: function(error) {
                alert('Something went wrong...');
            }
        });
    });
});
