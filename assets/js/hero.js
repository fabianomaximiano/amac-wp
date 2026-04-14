document.addEventListener("DOMContentLoaded", function () {
    var MOBILE_BREAKPOINT = 767.98;
    var heroCarousel = document.getElementById("heroCarousel");

    function isMobileViewport() {
        return window.innerWidth <= MOBILE_BREAKPOINT;
    }

    function setupHeroMobileStatic() {
        if (!heroCarousel || !isMobileViewport()) {
            return;
        }

        var slides = heroCarousel.querySelectorAll(".carousel-item");
        var controls = heroCarousel.querySelectorAll(
            ".carousel-control-prev, .carousel-control-next"
        );
        var indicators = heroCarousel.querySelector(".carousel-indicators");

        controls.forEach(function (control) {
            control.style.display = "none";
        });

        if (indicators) {
            indicators.style.display = "none";
        }

        if (
            typeof jQuery !== "undefined" &&
            typeof jQuery(heroCarousel).carousel === "function"
        ) {
            jQuery(heroCarousel).carousel("pause");
            jQuery(heroCarousel).off("slide.bs.carousel.heroMobile");
            jQuery(heroCarousel).on("slide.bs.carousel.heroMobile", function (e) {
                e.preventDefault();
                return false;
            });
        }

        slides.forEach(function (slide, index) {
            slide.classList.remove(
                "carousel-item-next",
                "carousel-item-prev",
                "carousel-item-left",
                "carousel-item-right"
            );

            if (index === 0) {
                slide.classList.add("active");
                slide.style.display = "block";
            } else {
                slide.classList.remove("active");
                slide.style.display = "none";
            }
        });
    }

    function setupHeroDesktop() {
        if (!heroCarousel || isMobileViewport()) {
            return;
        }

        var slides = heroCarousel.querySelectorAll(".carousel-item");
        var controls = heroCarousel.querySelectorAll(
            ".carousel-control-prev, .carousel-control-next"
        );
        var indicators = heroCarousel.querySelector(".carousel-indicators");

        controls.forEach(function (control) {
            control.style.display = "";
        });

        if (indicators) {
            indicators.style.display = "";
        }

        slides.forEach(function (slide) {
            slide.style.display = "";
        });

        if (
            typeof jQuery !== "undefined" &&
            typeof jQuery(heroCarousel).carousel === "function"
        ) {
            jQuery(heroCarousel).off("slide.bs.carousel.heroMobile");
            jQuery(heroCarousel).carousel({
                interval: 5000,
                pause: false,
                ride: "carousel"
            });
        }
    }

    function setupHeroMode() {
        if (isMobileViewport()) {
            setupHeroMobileStatic();
        } else {
            setupHeroDesktop();
        }
    }

    setupHeroMode();

    window.addEventListener("resize", function () {
        setupHeroMode();
    });
});