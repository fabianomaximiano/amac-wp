document.addEventListener("DOMContentLoaded", function () {

    var MOBILE_BREAKPOINT = 767.98;

    function isMobileViewport() {

        return window.innerWidth <= MOBILE_BREAKPOINT;

    }



    // ==============================
    // BACKGROUND RESPONSIVO
    // ==============================

    function updateHeroBackgrounds() {

        var slides = document.querySelectorAll(".hero-slide");

        var isMobile = isMobileViewport();

        slides.forEach(function (slide) {

            var desktopBg = slide.getAttribute("data-desktop-bg");
            var mobileBg = slide.getAttribute("data-mobile-bg");

            var imageToUse =
                isMobile && mobileBg
                    ? mobileBg
                    : desktopBg;

            if (imageToUse) {

                slide.style.backgroundImage =
                    "url('" + imageToUse + "')";

            }

        });

    }



    // ==============================
    // HERO CAROUSEL
    // ==============================

    function setupHeroCarousel() {

        var heroCarousel =
            document.getElementById("heroCarousel");

        if (!heroCarousel) return;

        var isMobile = isMobileViewport();

        var slides =
            heroCarousel.querySelectorAll(".carousel-item");

        var controls =
            heroCarousel.querySelectorAll(
                ".carousel-control-prev, .carousel-control-next"
            );

        var indicators =
            heroCarousel.querySelector(".carousel-indicators");



        if (isMobile) {

            controls.forEach(function (c) {
                c.style.display = "none";
            });

            if (indicators) {
                indicators.style.display = "none";
            }

            slides.forEach(function (slide, index) {

                slide.classList.remove("active");

                if (index === 0) {

                    slide.classList.add("active");
                    slide.style.display = "block";

                } else {

                    slide.style.display = "none";

                }

            });

        } else {

            controls.forEach(function (c) {
                c.style.display = "";
            });

            if (indicators) {
                indicators.style.display = "";
            }

            if (
                typeof jQuery !== "undefined" &&
                typeof jQuery(heroCarousel).carousel === "function"
            ) {

                jQuery(heroCarousel).carousel({
                    interval: 5000,
                    pause: false,
                    ride: "carousel"
                });

            }

        }

    }



    updateHeroBackgrounds();

    setupHeroCarousel();



    window.addEventListener("resize", function () {

        updateHeroBackgrounds();

        setupHeroCarousel();

    });

});