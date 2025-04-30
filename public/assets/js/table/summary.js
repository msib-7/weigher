$(function () {
    $("#kt_daterangepicker_1").daterangepicker();
    let bnParam;
    let selectedBn;
    let selectedFlag1, selectedFlag2, selectedFlag3;
    let chart1, chart2, chart3;

    // Hide the tables initially
    $("#weigher-table-individu-awal").hide();
    $("#summary-table-awal").hide();

    // Event listener untuk memeriksa pilihan
    $('#kt_daterangepicker_1').on('change', function () {
        loadBnOptions();
    });

    // Event handler untuk filter
    $("#bn-filter").on("change", function () {
        bnParam = $(this).val(); // Ambil nilai BN dari dropdown
        if (bnParam == "" || bnParam == null) {
            bnParam = All; // Set ke null jika "All Batches" dipilih
        }
        
        tableAwal.ajax.reload();
        $("#weigher-table-individu-awal").show(); // Show the table
        $("#summary-table-awal").show();
        $.ajax({
            url: JSON_URL,
            method: "get",
            data: {
                bn: bnParam,
                _token: CSRF_TOKEN,
            },
            success: function () {
                $("#weigher-table-individu-awal").show(); // Show the table
                $("#summary-table-awal").show();
            },
            error: function (xhr, status, error) {
                // Handle errors here
                console.error("AJAX Error:", status, error);
                alert("Terjadi kesalahan saat memuat data. Silakan coba lagi.");
            },
        });
    });

    function loadBnOptions() {
        const selectedDate = $("#kt_daterangepicker_1").val();

        $.ajax({
            url: "/getBn/S",
            method: "get",
            data: {
                date: selectedDate,
                _token: CSRF_TOKEN,
            },
            beforeSend: function () {
                $("#bn-filter").empty();
                $("#bn-filter").append(
                    '<option>loading...</option>'
                );
            },
            success: function (data) {
                if (data.length === 0) {
                    $("#bn-filter").empty(); // Clear previous options
                    $("#bn-filter").append("<option>No Data Match...</option>");
                } else {
                    setTimeout(function () {
                        $("#bn-filter").empty(); // Clear previous options
                        $("#bn-filter").append(
                            "<option>Select Batch Number</option>"
                        );
                        $.each(data, function (index, value) {
                            $("#bn-filter").append(
                                $("<option>", {
                                    value: value.lot,
                                    text: value.lot,
                                })
                            );
                        });
                    }, 2000); // Delay of 500ms before executing
                }
            },
            error: function (xhr, status, error) {
                // Handle errors here
                console.error("AJAX Error:", status, error);
                alert("Terjadi kesalahan saat memuat data. Silakan coba lagi.");
            },
        });
    }

    function resetSum(){
        $("#weigher-table-individu-awal").hide();
        $("#summary-table-awal").hide();

        $(".n-awal").text(0);
        $(".x-awal").text(0);
        $(".s_dev-awal").text(0);
        $(".s_rel-awal").text(0);
        $(".min-awal").text(0);
        $(".max-awal").text(0);
        $(".diff-awal").text(0);
        $(".sum-awal").text(0);
    }

    function convertDataToNumbers(data) {
        return data.map((item) => {
            return {
                n: parseInt(item.n, 10) || 0, // Convert to integer
                x: parseFloat(item.x) || 0, // Convert to float
                s_dev: parseFloat(item.s_dev) || 0,
                s_rel: parseFloat(item.s_rel) || 0,
                min: parseFloat(item.min) || 0,
                max: parseFloat(item.max) || 0,
                diff: parseFloat(item.diff) || 0,
                sum: parseFloat(item.sum) || 0,
                // Add other fields as necessary
            };
        });
    }

    function calculateMetrics(data) {
        return data.reduce(
            (metrics, item) => {
                // Ensure that each value is a number before adding
                metrics.n += typeof item.n === "number" ? item.n : 0;
                metrics.x += typeof item.x === "number" ? item.x : 0;
                metrics.sDev += typeof item.s_dev === "number" ? item.s_dev : 0;
                metrics.sRel += typeof item.s_rel === "number" ? item.s_rel : 0;
                metrics.diff += typeof item.diff === "number" ? item.diff : 0;
                metrics.sum += typeof item.sum === "number" ? item.sum : 0;

                // Update min and max
                // metrics.min = Math.min(metrics.min, (typeof item.min === 'number' ? item.min : metrics.min));
                // metrics.max = Math.max(metrics.max, (typeof item.max === 'number' ? item.max : metrics.max));

                metrics.min += typeof item.min === "number" ? item.min : 0;
                metrics.max += typeof item.max === "number" ? item.max : 0;

                return metrics;
            },
            {
                n: 0,
                x: 0,
                sDev: 0,
                sRel: 0,
                min: 0, // Initialize to Infinity for min calculation
                max: 0, // Initialize to -Infinity for max calculation
                diff: 0,
                sum: 0,
            }
        );
    }

    var tableAwal = $("#weigher-table-individu-awal").DataTable({
        processing: true,
        serverSide: true,
        order: [[0, "asc"]],
        info: false,
        ajax: {
            url: JSON_URL,
            data: function (d) {
                d.bn = bnParam; // Selalu gunakan BN dari URL
            },
        },
        columns: [
            { data: null, orderable: false },
            { data: "datetime" },
            // { data: "weight" },
            { data: "n" },
            { data: "x" },
            { data: "s_dev" },
            { data: "s_rel" },
            { data: "min" },
            { data: "max" },
            { data: "diff" },
            { data: "sum" },
            { data: "lot" },
            { data: "ipc" },
        ],
        columnDefs: [
            {
                targets: 0,
                render: function (data, type, row, meta) {
                    return meta.row + meta.settings._iDisplayStart + 1; // Calculate the row index
                },
            },
        ],
    });

    // $("#export-pdf-btn").on("click", function (e) {
    //     e.preventDefault(); // Prevent the default anchor behavior

    //     // Check if any of the tables are hidden
    //     var isAwalVisible = $("#weigher-table-individu-awal").is(":visible");

    //     // // If any table is hidden, show an alert and return

    //     // Gather data from all DataTables
    //     var dataAwal = isAwalVisible ? tableAwal.rows().data().toArray() : [];

    //     var data = {
    //         awal: dataAwal,
    //     };

    //     var summaryAwal = {
    //         n: parseFloat($(".n-awal").text()),
    //         x: parseFloat($(".x-awal").text()),
    //         s_dev: parseFloat($(".s_dev-awal").text()),
    //         s_rel: parseFloat($(".s_rel-awal").text()),
    //         min: parseFloat($(".min-awal").text()),
    //         max: parseFloat($(".max-awal").text()),
    //         diff: parseFloat($(".diff-awal").text()),
    //         sum: parseFloat($(".sum-awal").text()),
    //     };

    //     var summary = {
    //         awal: summaryAwal,
    //     };

    //     // Send data to the controller
    //     $.ajax({
    //         url: JSON_SUMMARY_PRINT_URL,
    //         method: "POST",
    //         data: {
    //             data: data,
    //             summary: summary,
    //             bn: bnParam,
    //             _token: CSRF_TOKEN,
    //         },
    //     });
    // });
});