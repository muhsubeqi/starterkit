/*!
 * oneui - v5.5.0
 * @author pixelcave - https://pixelcave.com
 * Copyright (c) 2022
 */

// Ensure the script runs after the DOM is fully loaded
document.addEventListener("DOMContentLoaded", function() {
    // Set default Chart.js options
    Chart.defaults.color = "#818d96";
    Chart.defaults.scale.grid.lineWidth = 0;
    Chart.defaults.scale.beginAtZero = true;
    Chart.defaults.datasets.bar.maxBarThickness = 45;
    Chart.defaults.elements.bar.borderRadius = 4;
    Chart.defaults.elements.bar.borderSkipped = false;
    Chart.defaults.elements.point.radius = 0;
    Chart.defaults.elements.point.hoverRadius = 0;
    Chart.defaults.plugins.tooltip.radius = 3;
    Chart.defaults.plugins.legend.labels.boxWidth = 10;

    // Initialize charts
    createEarningsChart();
    createTotalOrdersChart();
    createTotalEarningsChart();
    createNewCustomersChart();
});

function createEarningsChart() {
    const element = document.getElementById("js-chartjs-earnings");
    if (element) {
        new Chart(element, {
            type: "bar",
            data: {
                labels: ["MON", "TUE", "WED", "THU", "FRI", "SAT", "SUN"],
                datasets: [
                    {
                        label: "This Week",
                        fill: true,
                        backgroundColor: "rgba(100, 116, 139, .7)",
                        borderColor: "transparent",
                        data: [716, 628, 1056, 560, 956, 890, 790]
                    },
                    {
                        label: "Last Week",
                        fill: true,
                        backgroundColor: "rgba(100, 116, 139, .15)",
                        borderColor: "transparent",
                        data: [1160, 923, 1052, 1300, 880, 926, 963]
                    }
                ]
            },
            options: {
                scales: {
                    x: { display: false, grid: { drawBorder: false } },
                    y: { display: false, grid: { drawBorder: false } }
                },
                interaction: { intersect: false },
                plugins: {
                    legend: { labels: { boxHeight: 10, font: { size: 14 } } },
                    tooltip: {
                        callbacks: {
                            label: (context) => `${context.dataset.label}: $${context.parsed.y}`
                        }
                    }
                }
            }
        });
    } else {
        console.error("Earnings chart element not found!");
    }
}

function createTotalOrdersChart() {
    const element = document.getElementById("js-chartjs-total-orders");
    if (element) {
        new Chart(element, {
            type: "line",
            data: {
                labels: Array(14).fill(0).map((_, i) => ["MON", "TUE", "WED", "THU", "FRI", "SAT", "SUN"][i % 7]),
                datasets: [{
                    label: "Total Orders",
                    fill: true,
                    backgroundColor: "rgba(220, 38, 38, .15)",
                    borderColor: "transparent",
                    data: [33, 29, 32, 37, 38, 30, 34, 28, 43, 45, 26, 45, 49, 39]
                }]
            },
            options: {
                maintainAspectRatio: false,
                tension: 0.4,
                scales: {
                    x: { display: false },
                    y: { display: false }
                },
                interaction: { intersect: false },
                plugins: {
                    legend: { display: false },
                    tooltip: {
                        callbacks: {
                            label: (context) => `${context.parsed.y} Orders`
                        }
                    }
                }
            }
        });
    } else {
        console.error("Total Orders chart element not found!");
    }
}

function createTotalEarningsChart() {
    const element = document.getElementById("js-chartjs-total-earnings");
    if (element) {
        new Chart(element, {
            type: "line",
            data: {
                labels: Array(14).fill(0).map((_, i) => ["MON", "TUE", "WED", "THU", "FRI", "SAT", "SUN"][i % 7]),
                datasets: [{
                    label: "Total Earnings",
                    fill: true,
                    backgroundColor: "rgba(101, 163, 13, .15)",
                    borderColor: "transparent",
                    data: [716, 1185, 750, 1365, 956, 890, 1200, 968, 1158, 1025, 920, 1190, 720, 1352]
                }]
            },
            options: {
                maintainAspectRatio: false,
                tension: 0.4,
                scales: {
                    x: { display: false },
                    y: { display: false }
                },
                interaction: { intersect: false },
                plugins: {
                    legend: { display: false },
                    tooltip: {
                        callbacks: {
                            label: (context) => `$${context.parsed.y}`
                        }
                    }
                }
            }
        });
    } else {
        console.error("Total Earnings chart element not found!");
    }
}

function createNewCustomersChart() {
    const element = document.getElementById("js-chartjs-new-customers");
    if (element) {
        new Chart(element, {
            type: "line",
            data: {
                labels: Array(14).fill(0).map((_, i) => ["MON", "TUE", "WED", "THU", "FRI", "SAT", "SUN"][i % 7]),
                datasets: [{
                    label: "New Customers",
                    fill: true,
                    backgroundColor: "rgba(101, 163, 13, .15)",
                    borderColor: "transparent",
                    data: [25, 15, 36, 14, 29, 19, 36, 41, 28, 26, 29, 33, 23, 41]
                }]
            },
            options: {
                maintainAspectRatio: false,
                tension: 0.4,
                scales: {
                    x: { display: false },
                    y: { display: false }
                },
                interaction: { intersect: false },
                plugins: {
                    legend: { display: false },
                    tooltip: {
                        callbacks: {
                            label: (context) => `${context.parsed.y} Customers`
                        }
                    }
                }
            }
        });
    } else {
        console.error("New Customers chart element not found!");
    }
}
