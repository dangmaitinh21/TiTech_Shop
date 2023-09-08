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
    const dataFill = document.querySelectorAll(".dataModal");
    dataFill[0].src = product.image;
    dataFill[1].href = product.image;
    dataFill[2].innerHTML = product.name;
    if (product.price === null) {
        dataFill[3].innerHTML = `<a href="contact.html">Contact</a>`;
    } else {
        const price = product.price_sale ? product.price_sale : product.price;
        dataFill[3].innerHTML = `${price}$`;
    }
    dataFill[4].innerHTML = product.description;
}
