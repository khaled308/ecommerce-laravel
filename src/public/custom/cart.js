const cartCounter = document.getElementById("cart-counter");
const addToCartBtns = document.querySelectorAll(".add-to-cart");

addToCartBtns.forEach((btn) => {
    btn.addEventListener("click", (e) => {
        e.preventDefault();
        const productId = btn
            .closest(".cart-form")
            .querySelector("input[name=product_id]").value;

        const token = btn
            .closest(".cart-form")
            .querySelector("input[name=_token]").value;

        fetch("/cart", {
            method: "POST",
            headers: {
                "Content-Type": "application/json",
                "X-CSRF-TOKEN": token,
            },
            body: JSON.stringify({
                product_id: productId,
                _token: token,
            }),
        })
            .then((res) => res.json())
            .then((data) => {
                console.log(data);
                cartCounter.innerText = data.count;
            })
            .catch((err) => {
                console.log(err);
            });
    });
});
