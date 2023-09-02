$.ajaxSetup({
    headers: {
        "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
    },
});

function delItem(id, url) {
    if (confirm("You really want to delete this item?")) {
        $.ajax({
            type: "DELETE",
            datatype: "JSON",
            data: { id },
            url: url,
            success: function (result) {
                if (result.error === false) {
                    alert(result.message);
                    location.reload();
                } else {
                    alert(result.message);
                }
            },
        });
    }
}

//Upload Image
$("#fileImg").change(function () {
    const form = new FormData();
    const inputFile = $(this)[0];
    if (inputFile.files.length > 0) {
        form.append("file", inputFile.files[0]);
    }
    $.ajax({
        type: "POST",
        url: window.location.origin + "/admin/upload/services",
        data: form,
        dataType: "json",
        processData: false,
        contentType: false,
        success: function (response) {
            if (response.error === false) {
                $("#previewImg").attr("src", response.url);
                $("#previewImg").addClass("d-block");
                $("#dataUrlImage").val(response.url);
            } else {
                alert(response.message);
            }
        },
    });
});
