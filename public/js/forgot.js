document.addEventListener("DOMContentLoaded", function () {
    // Efek tambahan untuk interaksi
    const cards = document.querySelectorAll(".group");
    cards.forEach((card) => {
        card.addEventListener("click", function () {
            // Optional: tambah efek ripple atau tracking
            console.log("User mengakses menu bantuan");
        });
    });
});
