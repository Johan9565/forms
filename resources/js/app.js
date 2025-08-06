import "./bootstrap";
import Swal from "sweetalert2";
import $ from "jquery";
// Import Select2 and ensure it's attached to jQuery
import select2 from "select2";
select2($);

// Import Select2 CSS
import "select2/dist/css/select2.min.css";

Livewire.on("sweetalert2", (options = {}) => {
    if (Array.isArray(options)) options = options[0];
    console.log(options);
    const defaults = {
        title: "¿Estás seguro?",
        text: "",
        icon: "info", // success, error, warning, info, question
        confirmButtonText: "Aceptar",
        cancelButtonText: "Cancelar",
        showCancelButton: false,
        showCloseButton: false,
        showDenyButton: false,
        denyButtonText: "No",
        focusConfirm: true,
        focusCancel: false,
        focusDeny: false,
        allowOutsideClick: true,
        allowEscapeKey: true,
        allowEnterKey: true,
        backdrop: true,
        toast: false,
        position: "center", // 'top', 'top-start', 'top-end', 'center', etc.
        timer: null,
        timerProgressBar: false,
        width: "32rem",
        customClass: {}, // puedes personalizar clases de botones, popup, etc.
    };

    const config = { ...defaults, ...options };

    Swal.fire(config).then((result) => {
        // Si el evento contiene un 'callback' Livewire, lo disparamos según la respuesta
        if (options.callback) {
            if (result.isConfirmed) {
                Livewire.dispatch(`${options.callback}`, {
                    result: "confirmed",
                });
            } else if (result.isDenied) {
                Livewire.dispatch(`${options.callback}`, { result: "denied" });
            } else if (result.isDismissed) {
                Livewire.dispatch(`${options.callback}`, {
                    result: "dismissed",
                });
            }
        }
    });
});

window.initializeSelect2Simple = function (selectId) {
    if (typeof $ === "undefined") {
        // If jQuery is not available yet, wait a bit and try again
        setTimeout(() => window.initializeSelect2Simple(selectId), 100);
        return;
    }

    // Check if Select2 is available
    if (typeof $.fn.select2 === "undefined") {
        console.error("Select2 is not available. Retrying in 100ms...");
        setTimeout(() => window.initializeSelect2Simple(selectId), 100);
        return;
    }

    let select = $(selectId);
    if (select.length === 0) {
        // If element is not found, wait a bit and try again
        setTimeout(() => window.initializeSelect2Simple(selectId), 100);
        return;
    }

    let model = select.data("model");
    let isUpdating = false;

    // Initialize select2 only once
    if (!select.hasClass("select2-initialized")) {
        try {
            select.select2({
                placeholder:
                    select.attr("data-placeholder") ||
                    select.find("option:first").text(),
                allowClear: true,
            });
            select.addClass("select2-initialized");
        } catch (error) {
            console.error("Error initializing Select2:", error);
            return;
        }
    }

    // Handle change events
    select.on("change", function (e) {
        if (isUpdating) return;
        isUpdating = true;

        // Find the Livewire component and update the value
        const livewireId = select.closest("[wire\\:id]").attr("wire:id");
        if (livewireId && model) {
            window.Livewire.find(livewireId)
                .set(model, $(this).val())
                .then(() => {
                    isUpdating = false;
                });
        } else {
            isUpdating = false;
        }
    });

    // Listen for Livewire updates
    if (model) {
        Livewire.on(model + "Updated", (value) => {
            if (isUpdating) return;
            isUpdating = true;

            select.val(value).trigger("change");
            isUpdating = false;
        });
    }
};
