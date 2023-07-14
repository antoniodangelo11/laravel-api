import "./bootstrap";

import "~resources/scss/app.scss";

import.meta.glob(["../img/**"]);

import * as bootstrap from "bootstrap";


const confirmDelete = document.querySelector("#btn-confirm-delete");

if (confirmDelete) {
    document.querySelectorAll(".js-delete").forEach((button) => {
        // seleziono tutti i button con la classe js-delete
        button.addEventListener("click", function () {
            console.log("hai cliccato il bottone con id " + this.dataset.id);
            confirmDelete.action = confirmDelete.dataset.template.replace(
                "***",
                this.dataset.id
            );
        });
    });
}