document.addEventListener("DOMContentLoaded", function () {

    // ==============================
    // MODAL
    // ==============================

    var modal = document.getElementById("modalAtendimento");
    var abrir = document.getElementById("abrirModal");
    var fechar = document.querySelector(".fechar");

    function fecharModal() {

        if (!modal) return;

        modal.style.display = "none";
        document.body.classList.remove("modal-open");

    }

    if (abrir && modal && fechar) {

        abrir.addEventListener("click", function () {

            modal.style.display = "block";
            document.body.classList.add("modal-open");

        });

        fechar.addEventListener("click", fecharModal);

        window.addEventListener("click", function (e) {

            if (e.target === modal) fecharModal();

        });

        document.addEventListener("keydown", function (e) {

            if (
                e.key === "Escape" &&
                modal.style.display === "block"
            ) {

                fecharModal();

            }

        });

    }



    // ==============================
    // URL ORIGEM
    // ==============================

    var origemInput = document.getElementById("url_origem");

    if (origemInput) {

        origemInput.value = window.location.href;

    }



    // ==============================
    // TELEFONE
    // ==============================

    document.querySelectorAll(".telefone")
        .forEach(function (input) {

            input.addEventListener("input", function () {

                this.value = this.value
                    .replace(/\D/g, "")
                    .replace(/(\d{2})(\d)/, "($1) $2")
                    .replace(/(\d{5})(\d)/, "$1-$2")
                    .replace(/(-\d{4})\d+?$/, "$1");

            });

        });



    // ==============================
    // CEP
    // ==============================

    document.querySelectorAll(".cep")
        .forEach(function (input) {

            input.addEventListener("input", function () {

                this.value = this.value
                    .replace(/\D/g, "")
                    .replace(/^(\d{5})(\d)/, "$1-$2")
                    .replace(/(-\d{3})\d+?$/, "$1");

            });

            input.addEventListener("blur", function () {

                var cep = this.value.replace(/\D/g, "");

                if (cep.length !== 8) return;

                var cidadeInput = document.getElementById("lead_cidade");
                var bairroInput = document.getElementById("lead_bairro");

                if (!cidadeInput || !bairroInput) return;

                cidadeInput.value = "Carregando...";
                bairroInput.value = "Carregando...";

                fetch("https://viacep.com.br/ws/" + cep + "/json/")
                    .then(function (res) {
                        return res.json();
                    })
                    .then(function (data) {

                        if (data.erro) return;

                        cidadeInput.value = data.localidade || "";
                        bairroInput.value = data.bairro || "";

                    });

            });

        });



    // ==============================
    // FORM AJAX
    // ==============================

    var form = document.getElementById("leadForm");

    if (!form) return;

    form.addEventListener("submit", function (e) {

        e.preventDefault();

        if (
            typeof ajax_object === "undefined" ||
            !ajax_object.ajax_url
        ) return;

        var msgBox = document.getElementById("msg");

        var formData = new FormData(form);

        formData.append("action", "salvar_lead");

        fetch(ajax_object.ajax_url, {

            method: "POST",
            body: formData

        })
            .then(function (res) {
                return res.json();
            })
            .then(function (data) {

                if (!msgBox) return;

                if (data.success) {

                    msgBox.className =
                        "form-message form-message-success";

                    msgBox.innerHTML =
                        data.data.msg ||
                        "Solicitação enviada com sucesso.";

                    form.reset();

                } else {

                    msgBox.className =
                        "form-message form-message-error";

                    msgBox.innerHTML =
                        "Não foi possível enviar.";

                }

            });

    });

});