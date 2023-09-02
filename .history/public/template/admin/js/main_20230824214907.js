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
