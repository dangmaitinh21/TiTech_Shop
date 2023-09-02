$.ajaxSetup({
    headers: {
        "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
    },
});

function delCategory(id, url) {
    if (confirm("You really want to delete this category?")) {
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

function delProduct(id, url) {
    console.log(id, url);
    if (confirm("You really want to delete this product?")) {
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

$("#uploadImg").change(function () {
    const form = new FormData();
    console.log(url("admin/upload/services"));
    // const inputFile = $(this)[0];
    // if (inputFile.files.length > 0) {
    //     form.append("file", inputFile.files[0]);
    // }
    // $.ajax({
    //     type: "POST",
    //     url: '{{url("admin/upload/services")}}',
    //     data: form,
    //     dataType: "json",
    //     processData: false,
    //     contentType: false,
    //     success: function (response) {
    //         if (response.error === false) {
    //             $("#previewImg").attr("src", response.url);
    //             $("#productImage").val(response.url);
    //         } else {
    //             alert(response.message);
    //         }
    //     },
    // });
});
