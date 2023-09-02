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
                $("#page").val(+page + 1);
                if (!result.canLoadMore) {
                    $("#btn-loadMoreProducts").addClass("d-none");
                }
            }
        },
    });
}

function showModal(product, event) {
    event.preventDefault();
    product = JSON.parse(product);
    $("#dataProduct-1").attr("data-thumb", product.image);
    $("#dataProduct-2").attr("src", product.image);
    $("#dataProduct-3").attr("href", product.image);
    $("#dataProduct-4").text(product.name);
    $("#dataProduct-5").text(`${product.price_sale}$`);
    $("#dataProduct-6").text(product.description);
    $(".js-modal1").addClass("show-modal1");
}

$(document).ready(function () {
    $("#shoping-cart-form").submit(function (event) {
        event.preventDefault(); // Ngăn chặn hành vi mặc định của form submit

        // Thực hiện các xử lý khác ở đây, chẳng hạn gửi dữ liệu qua AJAX
    });
});