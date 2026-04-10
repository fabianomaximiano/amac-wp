document.addEventListener("DOMContentLoaded", function () {

    var cards =
        document.querySelectorAll(".kanban-card");

    var columns =
        document.querySelectorAll(".kanban-column");

    if (!cards.length || !columns.length) return;



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

            var dragging =
                document.querySelector(".dragging");

            if (dragging) {

                column.appendChild(dragging);

            }

        });



        column.addEventListener("drop", function () {

            if (
                typeof ajax_object === "undefined" ||
                !ajax_object.ajax_url
            ) return;

            var card =
                document.querySelector(".dragging");

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

            });

        });

    });

});