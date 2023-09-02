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

$("#upload").change(function () {
    console.log("123");
    // const form = new FormData();
    // form.append("file", $(this)[0].files[0]);
    // $.ajax({
    //     processData: false,
    //     contentType: false,
    //     type: "POST",
    //     dataType: "JSON",
    //     data: form,
    //     url: "/admin/upload/services",
    //     success: function (result) {
    //         console.log(result);
    //     },
    // });
});
