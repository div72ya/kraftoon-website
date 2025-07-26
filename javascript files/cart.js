document.addEventListener("DOMContentLoaded", function () {
    document.querySelectorAll(".add-to-cart").forEach(button => {
        button.addEventListener("click", function () {
            let productId = this.getAttribute("data-product-id");

            fetch("add_to_cart.php", {
                method: "POST",
                headers: {
                    "Content-Type": "application/x-www-form-urlencoded"
                },
                body: "product_id=" + productId
            })
            .then(response => response.json())
            .then(data => {
                if (data.status === "success") {
                    // Show popup message
                    let popup = document.createElement("div");
                    popup.classList.add("cart-popup");
                    popup.innerText = "1 item added successfully!";
                    document.body.appendChild(popup);

                    setTimeout(() => {
                        popup.remove(); // Remove popup after 2 seconds
                    }, 2000);
                } else {
                    alert("Error: " + data.message);
                }
            })
            .catch(error => console.error("Error:", error));
        });
    });
});
