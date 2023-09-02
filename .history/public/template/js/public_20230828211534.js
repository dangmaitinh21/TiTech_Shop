$.ajaxSetup({
    headers: {
        "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
    },
});

function loadMoreProducts(event) {
    event.preventDefault();
    const page = $("#page").val();
    $.ajax({
        type: "POST",
        dataType: "JSON",
        data: { page },
        url: "services/load-products",
        success(result) {
            if (result.html) {
                $("#list-products").append(result.html);
                $("#page").val(page + 1);
            } else {
                $("#btn-loadMoreProducts").addClass("d-none");
            }
        },
    });
}
