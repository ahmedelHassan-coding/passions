document.addEventListener("DOMContentLoaded", function () {
    const filters = document.querySelectorAll(".gallery-filter");
    const items = document.querySelectorAll(".gallery-item");

    filters.forEach(filter => {
        filter.addEventListener("click", function () {
            // إزالة التفعيل من جميع الأزرار
            filters.forEach(btn => btn.classList.remove("active"));
            this.classList.add("active");

            const filterValue = this.getAttribute("data-filter");

            items.forEach(item => {
                const itemCategory = item.getAttribute("data-category");

                if (filterValue === "all" || filterValue === itemCategory) {
                    item.classList.remove("hidden");
                    item.style.opacity = "0";
                    setTimeout(() => {
                        item.style.opacity = "1";
                    }, 100);
                } else {
                    item.style.opacity = "0";
                    setTimeout(() => {
                        item.classList.add("hidden");
                    }, 300);
                }
            });
        });
    });
});

document.addEventListener("DOMContentLoaded", function () {
    const galleryItems = document.querySelectorAll(".gallery-item img");
    const lightbox = document.getElementById("lightbox");
    const lightboxImg = document.getElementById("lightbox-img");
    const closeLightbox = document.querySelector(".close-lightbox");

    // عند النقر على أي صورة، تظهر في النافذة المنبثقة
    galleryItems.forEach(img => {
        img.addEventListener("click", function () {
            lightboxImg.src = this.src;
            lightbox.classList.add("show");
        });
    });

    // إغلاق النافذة عند النقر على زر الإغلاق
    closeLightbox.addEventListener("click", function () {
        lightbox.classList.remove("show");
    });

    // إغلاق النافذة عند النقر خارج الصورة
    lightbox.addEventListener("click", function (e) {
        if (e.target !== lightboxImg) {
            lightbox.classList.remove("show");
        }
    });
});
