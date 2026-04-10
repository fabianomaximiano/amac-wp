document.addEventListener("DOMContentLoaded", function () {

    // ==============================
    // MENU SCROLL
    // ==============================

    var navbar = document.querySelector(".navbar");

    function toggleNavbarScrolled() {

        if (!navbar) return;

        if (window.scrollY > 50) {

            navbar.classList.add("scrolled");

        } else {

            navbar.classList.remove("scrolled");

        }

    }

    toggleNavbarScrolled();

    window.addEventListener("scroll", toggleNavbarScrolled);



    // ==============================
    // SCROLL SPY
    // ==============================

    var sections = document.querySelectorAll("section[id]");
    var navLinks = document.querySelectorAll(".navbar-nav .menu-item a, .navbar-nav .nav-link");

    function setActiveMenuLink() {

        if (!sections.length || !navLinks.length) return;

        var currentId = "";

        sections.forEach(function (section) {

            var sectionTop = section.offsetTop - 120;
            var sectionHeight = section.offsetHeight;

            if (
                window.scrollY >= sectionTop &&
                window.scrollY < sectionTop + sectionHeight
            ) {

                currentId = section.getAttribute("id");

            }

        });

        navLinks.forEach(function (link) {

            link.classList.remove("active");

            var href = link.getAttribute("href");

            if (
                href &&
                href.charAt(0) === "#" &&
                href.substring(1) === currentId
            ) {

                link.classList.add("active");

            }

        });

    }

    setActiveMenuLink();

    window.addEventListener("scroll", setActiveMenuLink);



    // ==============================
    // TRACKING WHATSAPP
    // ==============================

    document.querySelectorAll(".whatsapp-btn, .header-whatsapp-btn")
        .forEach(function (btn) {

            btn.addEventListener("click", function () {

                if (typeof fbq !== "undefined") {

                    fbq("track", "Lead");

                }

                if (typeof gtag !== "undefined") {

                    gtag("event", "conversion", {
                        event_category: "whatsapp",
                        event_label: "click"
                    });

                }

            });

        });



    // ==============================
    // PRESETS DE CORES
    // ==============================

    document.querySelectorAll(".preset-btn")
        .forEach(function (btn) {

            btn.addEventListener("click", function () {

                if (
                    typeof ajax_object === "undefined" ||
                    !ajax_object.ajax_url
                ) return;

                var preset = this.dataset.preset;

                var formData = new FormData();

                formData.append("action", "apply_preset");
                formData.append("preset", preset);

                fetch(ajax_object.ajax_url, {
                    method: "POST",
                    body: formData
                })
                    .then(function (res) {
                        return res.json();
                    })
                    .then(function () {
                        location.reload();
                    });

            });

        });

});