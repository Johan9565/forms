import "./bootstrap";
import Swal from "sweetalert2";
import $ from "jquery";
// Import Select2 and ensure it's attached to jQuery
import select2 from "select2";
select2($);

// Import Select2 CSS
import "select2/dist/css/select2.min.css";

import Chart from "chart.js/auto";
window.$ = window.jQuery = $;
function crearStackedBarChart(
    canvasId,
    etiquetas,
    datasetsPorStack,
    opcionesExtra = {}
) {
    try {
        const canvas = document.getElementById(canvasId);
        if (!canvas) {
            console.error(`Canvas element with id '${canvasId}' not found`);
            return null;
        }

        const ctx = canvas.getContext("2d");
        if (!ctx) {
            console.error(`Could not get 2D context for canvas '${canvasId}'`);
            return null;
        }

        const colores = [
            "rgba(255, 99, 132, 0.7)",
            "rgba(54, 162, 235, 0.7)",
            "rgba(255, 206, 86, 0.7)",
            "rgba(75, 192, 192, 0.7)",
            "rgba(153, 102, 255, 0.7)",
            "rgba(255, 159, 64, 0.7)",
            "rgba(201, 203, 207, 0.7)",
            "rgba(0, 128, 128, 0.7)",
            "rgba(128, 0, 128, 0.7)",
            "rgba(0, 0, 128, 0.7)",
            "rgba(128, 128, 0, 0.7)",
            "rgba(0, 128, 0, 0.7)",
            "rgba(128, 0, 0, 0.7)",
            "rgba(255, 0, 255, 0.7)",
            "rgba(0, 255, 255, 0.7)",
            "rgba(0, 255, 0, 0.7)",
            "rgba(255, 255, 0, 0.7)",
            "rgba(255, 0, 0, 0.7)",
        ];

        // Generar datasets para cada stack
        const datasets = datasetsPorStack.map((stack, stackIndex) => {
            return {
                label: stack.label || `Stack ${stackIndex + 1}`,
                data: stack.data,
                backgroundColor: colores[stackIndex % colores.length],
                stack: "stack1",
                borderWidth: 1,
            };
        });

        // Procesar opciones extra para convertir strings de funciones a funciones reales
        const processedOptions = {};
        if (opcionesExtra && typeof opcionesExtra === "object") {
            if (opcionesExtra.scales) {
                processedOptions.scales = { ...opcionesExtra.scales };
                if (
                    processedOptions.scales.x &&
                    processedOptions.scales.x.ticks
                ) {
                    if (
                        typeof processedOptions.scales.x.ticks.callback ===
                        "string"
                    ) {
                        // Extraer el contenido de la función del string
                        const functionBody =
                            processedOptions.scales.x.ticks.callback
                                .replace(/^function\s*\([^)]*\)\s*\{/, "")
                                .replace(/\}$/, "");
                        processedOptions.scales.x.ticks.callback = new Function(
                            "value",
                            "index",
                            "ticks",
                            functionBody
                        );
                    }
                }
                if (
                    processedOptions.scales.y &&
                    processedOptions.scales.y.ticks
                ) {
                    if (
                        typeof processedOptions.scales.y.ticks.callback ===
                        "string"
                    ) {
                        // Extraer el contenido de la función del string
                        const functionBody =
                            processedOptions.scales.y.ticks.callback
                                .replace(/^function\s*\([^)]*\)\s*\{/, "")
                                .replace(/\}$/, "");
                        processedOptions.scales.y.ticks.callback = new Function(
                            "value",
                            "index",
                            "ticks",
                            functionBody
                        );
                    }
                }
            }

            if (opcionesExtra.plugins) {
                processedOptions.plugins = { ...opcionesExtra.plugins };
                if (
                    processedOptions.plugins.tooltip &&
                    processedOptions.plugins.tooltip.callbacks
                ) {
                    if (
                        typeof processedOptions.plugins.tooltip.callbacks
                            .label === "string"
                    ) {
                        // Extraer el contenido de la función del string
                        const functionBody =
                            processedOptions.plugins.tooltip.callbacks.label
                                .replace(/^function\s*\([^)]*\)\s*\{/, "")
                                .replace(/\}$/, "");
                        processedOptions.plugins.tooltip.callbacks.label =
                            new Function("context", functionBody);
                    }
                }
            }
        }

        return new Chart(ctx, {
            type: "bar",
            data: {
                labels: etiquetas,
                datasets: datasets,
            },
            options: {
                responsive: true,
                scales: {
                    x: {
                        stacked: true,
                    },
                    y: {
                        stacked: true,
                        beginAtZero: true,
                        max: 100, // Default max for percentage charts
                        ...(processedOptions.scales && processedOptions.scales.y
                            ? processedOptions.scales.y
                            : {}),
                    },
                },
                ...processedOptions,
            },
        });
    } catch (error) {
        console.error(
            `Error creating stacked bar chart for '${canvasId}':`,
            error
        );
        return null;
    }
}

// Function to create charts dynamically
function createDynamicChart(chartConfig, config = {}) {
    const { canvasId, labels, datasets, counts, optionLabels } = chartConfig;

    // Check if canvas element exists
    const canvas = document.getElementById(canvasId);
    if (!canvas) {
        console.warn(`Canvas element with id '${canvasId}' not found`);
        return null;
    }

    // Create datasets array dynamically
    const chartDatasets = [];
    Object.keys(datasets).forEach((indexKey, index) => {
        chartDatasets.push({
            label: optionLabels[index] || `Option ${index + 1}`,
            data: datasets[indexKey],
        });
    });

    // Create the chart and return it
    try {
        const chart = crearStackedBarChart(
            canvasId,
            labels,
            chartDatasets,
            config
        );

        // Add counts data to the chart for tooltip access
        if (chart && counts) {
            chart.data.counts = counts;
        }

        return chart;
    } catch (error) {
        console.error(`Error creating chart for ${canvasId}:`, error);
        return null;
    }
}

// Listen for statistics charts initialization
Livewire.on("initializeStatisticsCharts", (data) => {
    // Use setTimeout to ensure DOM is ready
    setTimeout(() => {
        try {
            // Destroy existing charts first to prevent conflicts
            if (window.existingCharts) {
                window.existingCharts.forEach((chart) => {
                    if (chart && typeof chart.destroy === "function") {
                        chart.destroy();
                    }
                });
            }
            window.existingCharts = [];

            // Create charts dynamically from the data
            if (data[0].chartData) {
                Object.keys(data[0].chartData).forEach((chartKey) => {
                    const chartConfig = data[0].chartData[chartKey];
                    const chart = createDynamicChart(
                        chartConfig,
                        data[0].config
                    );
                    if (chart) {
                        window.existingCharts.push(chart);
                    }
                });
            }
        } catch (error) {
            console.error("Error initializing charts:", error);
        }
    }, 100);
});

// Listen for chart cleanup
Livewire.on("cleanupCharts", () => {
    if (window.existingCharts) {
        window.existingCharts.forEach((chart) => {
            if (chart && typeof chart.destroy === "function") {
                chart.destroy();
            }
        });
        window.existingCharts = [];
    }
});

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
                Livewire.dispatch(`${options.callback}`, {
                    result: "denied",
                });
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
