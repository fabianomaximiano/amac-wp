document.addEventListener("DOMContentLoaded", function () {

    // MODAL ATENDIMENTO
    var modal = document.getElementById("modalAtendimento");
    var abrir = document.getElementById("abrirModal");
    var fechar = document.querySelector(".fechar");

    if (abrir && modal && fechar) {
        abrir.addEventListener("click", function () {
            modal.style.display = "block";
            document.body.classList.add("modal-open");
        });

        fechar.addEventListener("click", function () {
            modal.style.display = "none";
            document.body.classList.remove("modal-open");
        });

        window.addEventListener("click", function (e) {
            if (e.target === modal) {
                modal.style.display = "none";
                document.body.classList.remove("modal-open");
            }
        });

        document.addEventListener("keydown", function (e) {
            if (e.key === "Escape" && modal.style.display === "block") {
                modal.style.display = "none";
                document.body.classList.remove("modal-open");
            }
        });
    }

    var origemInput = document.getElementById("url_origem");
    if (origemInput) {
        origemInput.value = window.location.href;
    }

    // MÁSCARA TELEFONE
    document.querySelectorAll(".telefone").forEach(function (input) {
        input.addEventListener("input", function () {
            this.value = this.value
                .replace(/\D/g, "")
                .replace(/(\d{2})(\d)/, "($1) $2")
                .replace(/(\d{5})(\d)/, "$1-$2")
                .replace(/(-\d{4})\d+?$/, "$1");
        });
    });

    // MÁSCARA CEP
    document.querySelectorAll(".cep").forEach(function (input) {
        input.addEventListener("input", function () {
            this.value = this.value
                .replace(/\D/g, "")
                .replace(/^(\d{5})(\d)/, "$1-$2")
                .replace(/(-\d{3})\d+?$/, "$1");
        });

        input.addEventListener("blur", function () {
            var cep = this.value.replace(/\D/g, "");
            var cidadeInput = document.getElementById("lead_cidade");
            var bairroInput = document.getElementById("lead_bairro");

            if (cep.length !== 8) {
                return;
            }

            fetch("https://viacep.com.br/ws/" + cep + "/json/")
                .then(function (response) {
                    return response.json();
                })
                .then(function (data) {
                    if (!data.erro) {
                        if (cidadeInput && !cidadeInput.value) {
                            cidadeInput.value = data.localidade || "";
                        }

                        if (bairroInput && !bairroInput.value) {
                            bairroInput.value = data.bairro || "";
                        }
                    }
                })
                .catch(function () {
                    console.log("Não foi possível consultar o CEP.");
                });
        });
    });

    // AJAX FORM LEAD
    var form = document.getElementById("leadForm");

    if (form) {
        form.addEventListener("submit", function (e) {
            e.preventDefault();

            var formData = new FormData(this);
            formData.append("action", "salvar_lead");

            fetch(ajax_object.ajax_url, {
                method: "POST",
                body: formData
            })
            .then(function (res) {
                return res.json();
            })
            .then(function (data) {
                var msgBox = document.getElementById("msg");

                if (msgBox && data && data.data) {
                    msgBox.innerHTML = data.data.msg || "Enviado com sucesso.";
                }

                if (data && data.success && data.data && data.data.whatsapp) {
                    setTimeout(function () {
                        window.open(data.data.whatsapp, "_blank");
                    }, 800);
                }
            })
            .catch(function () {
                var msgBox = document.getElementById("msg");
                if (msgBox) {
                    msgBox.innerHTML = "Não foi possível enviar agora. Tente novamente.";
                }
            });
        });
    }

    // TRACKING WHATSAPP
    document.querySelectorAll(".whatsapp-btn, .header-whatsapp-btn").forEach(function (btn) {
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

    // MENU SCROLL
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

    // SCROLL SPY
    var sections = document.querySelectorAll("section[id]");
    var navLinks = document.querySelectorAll(".navbar-nav .menu-item a, .navbar-nav .nav-link");

    function setActiveMenuLink() {
        var currentId = "";

        sections.forEach(function (section) {
            var sectionTop = section.offsetTop - 120;
            var sectionHeight = section.offsetHeight;

            if (window.scrollY >= sectionTop && window.scrollY < sectionTop + sectionHeight) {
                currentId = section.getAttribute("id");
            }
        });

        navLinks.forEach(function (link) {
            link.classList.remove("active");

            var href = link.getAttribute("href");
            if (href && href.charAt(0) === "#" && href.substring(1) === currentId) {
                link.classList.add("active");
            }
        });
    }

    setActiveMenuLink();
    window.addEventListener("scroll", setActiveMenuLink);

    // STATUS DO LEAD
    document.addEventListener("change", function (e) {
        if (!e.target.classList.contains("status-change")) return;

        var id = e.target.dataset.id;
        var status = e.target.value;

        var formData = new FormData();
        formData.append("action", "update_lead_status");
        formData.append("id", id);
        formData.append("status", status);

        fetch(ajax_object.ajax_url, {
            method: "POST",
            body: formData
        }).catch(function () {
            console.log("Erro ao atualizar status do lead.");
        });
    });

    // PRESETS DE CORES
    document.querySelectorAll(".preset-btn").forEach(function (btn) {
        btn.addEventListener("click", function () {
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

    // KANBAN
    var cards = document.querySelectorAll(".kanban-card");
    var columns = document.querySelectorAll(".kanban-column");

    cards.forEach(function (card) {
        card.addEventListener("dragstart", function () {
            card.classList.add("dragging");
        });

        card.addEventListener("dragend", function () {
            card.classList.remove("dragging");
        });
    });

    columns.forEach(function (column) {
        column.addEventListener("dragover", function (e) {
            e.preventDefault();
            var dragging = document.querySelector(".kanban-card.dragging");
            if (dragging) {
                column.appendChild(dragging);
            }
        });

        column.addEventListener("drop", function () {
            var card = document.querySelector(".kanban-card.dragging");
            if (!card) return;

            var id = card.dataset.id;
            var status = column.dataset.status;

            var formData = new FormData();
            formData.append("action", "update_lead_status");
            formData.append("id", id);
            formData.append("status", status);

            fetch(ajax_object.ajax_url, {
                method: "POST",
                body: formData
            }).catch(function () {
                console.log("Erro ao mover card no kanban.");
            });
        });
    });

    // HERO BG RESPONSIVO
    function updateHeroBackgrounds() {
        var slides = document.querySelectorAll(".hero-slide");
        var isMobile = window.innerWidth <= 767.98;

        slides.forEach(function (slide) {
            var desktopBg = slide.getAttribute("data-desktop-bg");
            var mobileBg = slide.getAttribute("data-mobile-bg");
            var imageToUse = isMobile && mobileBg ? mobileBg : desktopBg;

            if (imageToUse) {
                slide.style.backgroundImage = "url('" + imageToUse + "')";
            }
        });
    }

    updateHeroBackgrounds();
    window.addEventListener("resize", updateHeroBackgrounds);

    // HERO CAROUSEL
    var heroCarousel = document.getElementById("heroCarousel");

    if (heroCarousel && typeof jQuery !== "undefined" && typeof jQuery(heroCarousel).carousel === "function") {
        jQuery(heroCarousel).carousel({
            interval: 5000,
            pause: false,
            ride: "carousel",
            wrap: true,
            keyboard: true
        });

        jQuery(heroCarousel).find(".carousel-control-prev").on("click", function (e) {
            e.preventDefault();
            jQuery(heroCarousel).carousel("prev");
        });

        jQuery(heroCarousel).find(".carousel-control-next").on("click", function (e) {
            e.preventDefault();
            jQuery(heroCarousel).carousel("next");
        });

        jQuery(heroCarousel).find(".carousel-indicators li").on("click", function () {
            var slideTo = jQuery(this).attr("data-slide-to");
            if (typeof slideTo !== "undefined") {
                jQuery(heroCarousel).carousel(parseInt(slideTo, 10));
            }
        });
    }

});