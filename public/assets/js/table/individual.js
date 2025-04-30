$(function () {
    $("#kt_daterangepicker_1").daterangepicker();
    let bnParam;
    let selectedBn;
    let selectedFlag1, selectedFlag2, selectedFlag3;
    let chart1, chart2, chart3;

    // Hide the tables initially
    $("#weigher-table-individu-awal").hide();
    $("#weigher-table-individu-tengah").hide();
    $("#weigher-table-individu-akhir").hide();
    $("#summary-table-awal").hide();
    $("#summary-table-tengah").hide();
    $("#summary-table-akhir").hide();

    // Event listener untuk memeriksa pilihan
    $('#kt_daterangepicker_1').on('change', function () {
        loadBnOptions();
        loadIpcFlags(null); // Load IPC flags with "All Batches" option
        resetSum(); // Reset summary values
    });

    // Event handler untuk filter
    $("#bn-filter").on("change", function () {
        bnParam = $(this).val(); // Ambil nilai BN dari dropdown
        if (bnParam == "" || bnParam == null) {
            bnParam = All; // Set ke null jika "All Batches" dipilih
        }

        loadIpcFlags(bnParam); // Load IPC flags berdasarkan BN yang dipilih
        resetSum(); // Reset summary values
    });

    function loadIpcFlags(bn) {
        $.ajax({
            url: "/getIpc/I/" + bn,
            method: "GET",
            beforeSend: function () {
                const selectIds = [
                    "#ipc-flag-select-awal",
                    "#ipc-flag-select-tengah",
                    "#ipc-flag-select-akhir",
                ];

                selectIds.forEach(function (selectId) {
                    const selectField = $(selectId);
                    selectField.empty();
                    selectField.append("<option>loading..</option>");
                });
            },
            success: function (response) {
                const selectIds = [
                    "#ipc-flag-select-awal",
                    "#ipc-flag-select-tengah",
                    "#ipc-flag-select-akhir",
                ];

                selectIds.forEach(function (selectId) {
                    const selectField = $(selectId);
                    if (response.flags.length === 0) {
                        selectField.empty();
                        selectField.append(
                            '<option>no data match...</option>'
                        );
                    }else{
                        selectField.empty();
                        selectField.append(
                            '<option value="">Select IPC</option>'
                        );

                        // Populate the select field with unique flags, excluding null or empty values
                        response.flags.forEach(function (flag) {
                            if (flag) {
                                // This checks if flag is not null or an empty string
                                selectField.append(
                                    $("<option>", {
                                        value: flag,
                                        text: flag,
                                    })
                                );
                            }
                        });
                    }
                });
            },
            error: function (error) {
                console.error("Error fetching IPC flags:", error);
            },
        });
    }

    function loadBnOptions() {
        const selectedDate = $("#kt_daterangepicker_1").val();

        $.ajax({
            url: "/getBn/I",
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
        $("#weigher-table-individu-tengah").hide();
        $("#weigher-table-individu-akhir").hide();
        $("#summary-table-awal").hide();
        $("#summary-table-tengah").hide();
        $("#summary-table-akhir").hide();

        $(".n-awal").text(0);
        $(".x-awal").text(0);
        $(".s_dev-awal").text(0);
        $(".s_rel-awal").text(0);
        $(".min-awal").text(0);
        $(".max-awal").text(0);
        $(".diff-awal").text(0);
        $(".sum-awal").text(0);

        $(".n-tengah").text(0);
        $(".x-tengah").text(0);
        $(".s_dev-tengah").text(0);
        $(".s_rel-tengah").text(0);
        $(".min-tengah").text(0);
        $(".max-tengah").text(0);
        $(".diff-tengah").text(0);
        $(".sum-tengah").text(0);

        $(".n-akhir").text(0);
        $(".x-akhir").text(0);
        $(".s_dev-akhir").text(0);
        $(".s_rel-akhir").text(0);
        $(".min-akhir").text(0);
        $(".max-akhir").text(0);
        $(".diff-akhir").text(0);
        $(".sum-akhir").text(0);
    }

    $("#ipc-flag-select-awal").on("change", function () {
        selectedFlag1 = $(this).val();
        bnParam = $("#bn-filter").val(); // Get the selected BN value

        if (selectedFlag1) {
            // Load data into the DataTable based on the selected IPC flag
            tableAwal.ajax.reload();
            $("#weigher-table-individu-awal").show(); // Show the table
            $("#summary-table-awal").show();
            $.ajax({
                url: "/getSummary/I/" + bnParam + "/" + selectedFlag1,
                method: "GET",
                success: function (dataSum) {
                    // tableAwal.ajax.reload(); // Reload DataTable dengan filter baru
                    // tableTengah.ajax.reload(); // Reload DataTable dengan filter baru
                    // tableAkhir.ajax.reload(); // Reload DataTable dengan filter baru
                    if (dataSum.length > 0) {
                        // Update the summary fields with the dataSum received from the server
                        $(".n-awal").text(dataSum[0].n);
                        $(".x-awal").text(parseFloat(dataSum[0].x).toFixed(2));
                        $(".s_dev-awal").text(dataSum[0].s_dev);
                        $(".s_rel-awal").text(dataSum[0].s_rel);
                        $(".min-awal").text(dataSum[0].min);
                        $(".max-awal").text(dataSum[0].max);
                        $(".diff-awal").text(dataSum[0].diff);
                        $(".sum-awal").text(dataSum[0].sum);
                    } else {
                        let tableData = tableAwal.rows().data().toArray(); // Get data from DataTable
                        if (tableData.length > 0) {
                            let weights = tableData.map((row) => row.weight); // Assuming 'weight' is the column name
                            let n = weights.length;
                            let sum = weights.reduce((a, b) => a + b);
                            let avg = sum / n;
                            let min = Math.min(...weights);
                            let max = Math.max(...weights);
                            let diff = max - min;
                            let s_dev = 0; // You can calculate standard deviation if needed
                            let s_rel = 0; // You can calculate relative standard deviation if needed

                            // Update the summary fields
                            $(".n-awal").text(n);
                            $(".x-awal").text(avg);
                            $(".s_dev-awal").text(s_dev);
                            $(".s_rel-awal").text(s_rel);
                            $(".min-awal").text(min);
                            $(".max-awal").text(max);
                            $(".diff-awal").text(diff);
                            $(".sum-awal").text(sum);
                        }
                    }
                },
            });
        } else {
            $("#weigher-table-individu-awal").hide(); // Hide the table if no flag is selected
        }
    });

    $("#ipc-flag-select-tengah").on("change", function () {
        selectedFlag2 = $(this).val();
        bnParam = $("#bn-filter").val(); // Get the selected BN value

        if (selectedFlag2) {
            // Load data into the DataTable based on the selected IPC flag
            tableTengah.ajax.reload();
            $("#weigher-table-individu-tengah").show(); // Show the table
            $("#summary-table-tengah").show();
            $.ajax({
                url: "/getSummary/I/" + bnParam + "/" + selectedFlag2,
                method: "GET",
                success: function (dataSum) {
                    // tableAwal.ajax.reload(); // Reload DataTable dengan filter baru
                    // tableTengah.ajax.reload(); // Reload DataTable dengan filter baru
                    // tableAkhir.ajax.reload(); // Reload DataTable dengan filter baru
                    if (dataSum.length > 0) {
                        // Update the summary fields with the dataSum received from the server
                        $(".n-tengah").text(dataSum[0].n);
                        $(".x-tengah").text(dataSum[0].x);
                        $(".s_dev-tengah").text(dataSum[0].s_dev);
                        $(".s_rel-tengah").text(dataSum[0].s_rel);
                        $(".min-tengah").text(dataSum[0].min);
                        $(".max-tengah").text(dataSum[0].max);
                        $(".diff-tengah").text(dataSum[0].diff);
                        $(".sum-tengah").text(dataSum[0].sum);
                    } else {
                        let tableData = tableTengah.rows().data().toArray(); // Get data from DataTable
                        if (tableData.length > 0) {
                            let weights = tableData.map((row) => row.weight); // Assuming 'weight' is the column name
                            let n = weights.length;
                            let sum = weights.reduce((a, b) => a + b);
                            let avg = sum / n;
                            let min = Math.min(...weights);
                            let max = Math.max(...weights);
                            let diff = max - min;
                            let s_dev = 0; // You can calculate standard deviation if needed
                            let s_rel = 0; // You can calculate relative standard deviation if needed

                            // Update the summary fields
                            $(".n-tengah").text(n);
                            $(".x-tengah").text(avg);
                            $(".s_dev-tengah").text(s_dev);
                            $(".s_rel-tengah").text(s_rel);
                            $(".min-tengah").text(min);
                            $(".max-tengah").text(max);
                            $(".diff-tengah").text(diff);
                            $(".sum-tengah").text(sum);
                        }
                    }
                },
            });
        } else {
            $("#weigher-table-individu-tengah").hide(); // Hide the table if no flag is selected
        }
    });

    $("#ipc-flag-select-akhir").on("change", function () {
        selectedFlag3 = $(this).val();
        bnParam = $("#bn-filter").val(); // Get the selected BN value

        if (selectedFlag3) {
            // Load data into the DataTable based on the selected IPC flag
            tableAkhir.ajax.reload();
            $("#weigher-table-individu-akhir").show(); // Show the table
            $("#summary-table-akhir").show();
            $.ajax({
                url: "/getSummary/I/" + bnParam + "/" + selectedFlag3,
                method: "GET",
                success: function (dataSum) {
                    // tableAwal.ajax.reload(); // Reload DataTable dengan filter baru
                    // tableTengah.ajax.reload(); // Reload DataTable dengan filter baru
                    // tableAkhir.ajax.reload(); // Reload DataTable dengan filter baru
                    if (dataSum.length > 0) {
                        // Update the summary fields with the dataSum received from the server
                        $(".n-akhir").text(dataSum[0].n);
                        $(".x-akhir").text(dataSum[0].x);
                        $(".s_dev-akhir").text(dataSum[0].s_dev);
                        $(".s_rel-akhir").text(dataSum[0].s_rel);
                        $(".min-akhir").text(dataSum[0].min);
                        $(".max-akhir").text(dataSum[0].max);
                        $(".diff-akhir").text(dataSum[0].diff);
                        $(".sum-akhir").text(dataSum[0].sum);
                    } else {
                        let tableData = tableAkhir.rows().data().toArray(); // Get data from DataTable
                        if (tableData.length > 0) {
                            let weights = tableData.map((row) => row.weight); // Assuming 'weight' is the column name
                            let n = weights.length;
                            let sum = weights.reduce((a, b) => a + b);
                            let avg = sum / n;
                            let min = Math.min(...weights);
                            let max = Math.max(...weights);
                            let diff = max - min;
                            let s_dev = 0; // You can calculate standard deviation if needed
                            let s_rel = 0; // You can calculate relative standard deviation if needed

                            // Update the summary fields
                            $(".n-akhir").text(n);
                            $(".x-akhir").text(avg);
                            $(".s_dev-akhir").text(s_dev);
                            $(".s_rel-akhir").text(s_rel);
                            $(".min-akhir").text(min);
                            $(".max-akhir").text(max);
                            $(".diff-akhir").text(diff);
                            $(".sum-akhir").text(sum);
                        }
                    }
                },
            });
        } else {
            $("#weigher-table-individu-akhir").hide(); // Hide the table if no flag is selected
        }
    });

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
            url: JSON_INDIVIDU_URL,
            data: function (d) {
                d.bn = bnParam; // Selalu gunakan BN dari URL
                d.ipc = selectedFlag1;
            },
        },
        columns: [
            { data: "no" },
            { data: "datetime" },
            { data: "weight" },
            { data: "ipc" },
        ],
    });

    var tableTengah = $("#weigher-table-individu-tengah").DataTable({
        processing: true,
        serverSide: true,
        order: [[0, "asc"]],
        info: false,
        ajax: {
            url: JSON_INDIVIDU_URL,
            data: function (d) {
                d.bn = bnParam; // Selalu gunakan BN dari URL
                d.ipc = selectedFlag2;
            },
        },
        columns: [
            { data: "no" },
            { data: "datetime" },
            { data: "weight" },
            { data: "ipc" },
        ],
    });

    var tableAkhir = $("#weigher-table-individu-akhir").DataTable({
        processing: true,
        serverSide: true,
        order: [[0, "asc"]],
        info: false,
        ajax: {
            url: JSON_INDIVIDU_URL,
            data: function (d) {
                d.bn = bnParam; // Selalu gunakan BN dari URL
                d.ipc = selectedFlag3;
            },
        },
        columns: [
            { data: "no" },
            { data: "datetime" },
            { data: "weight" },
            { data: "ipc" },
        ],
    });

    $("#export-pdf-btn").on("click", function (e) {
        e.preventDefault(); // Prevent the default anchor behavior

        // Check if any of the tables are hidden
        var isAwalVisible = $("#weigher-table-individu-awal").is(":visible");
        var isTengahVisible = $("#weigher-table-individu-tengah").is(":visible");
        var isAkhirVisible = $("#weigher-table-individu-akhir").is(":visible");

        // // If any table is hidden, show an alert and return

        // Gather data from all DataTables
        var dataAwal = isAwalVisible ? tableAwal.rows().data().toArray() : [];
        var dataTengah = isTengahVisible
            ? tableTengah.rows().data().toArray()
            : [];
        var dataAkhir = isAkhirVisible
            ? tableAkhir.rows().data().toArray()
            : [];

        var data = {
            awal: dataAwal,
            tengah: dataTengah,
            akhir: dataAkhir,
        };

        var summaryAwal = {
            n: parseFloat($(".n-awal").text()),
            x: parseFloat($(".x-awal").text()),
            s_dev: parseFloat($(".s_dev-awal").text()),
            s_rel: parseFloat($(".s_rel-awal").text()),
            min: parseFloat($(".min-awal").text()),
            max: parseFloat($(".max-awal").text()),
            diff: parseFloat($(".diff-awal").text()),
            sum: parseFloat($(".sum-awal").text()),
        };

        var summaryTengah = {
            n: parseFloat($(".n-tengah").text()),
            x: parseFloat($(".x-tengah").text()),
            s_dev: parseFloat($(".s_dev-tengah").text()),
            s_rel: parseFloat($(".s_rel-tengah").text()),
            min: parseFloat($(".min-tengah").text()),
            max: parseFloat($(".max-tengah").text()),
            diff: parseFloat($(".diff-tengah").text()),
            sum: parseFloat($(".sum-tengah").text()),
        };

        var summaryAkhir = {
            n: parseFloat($(".n-akhir").text()),
            x: parseFloat($(".x-akhir").text()),
            s_dev: parseFloat($(".s_dev-akhir").text()),
            s_rel: parseFloat($(".s_rel-akhir").text()),
            min: parseFloat($(".min-akhir").text()),
            max: parseFloat($(".max-akhir").text()),
            diff: parseFloat($(".diff-akhir").text()),
            sum: parseFloat($(".sum-akhir").text()),
        };

        var summary = {
            awal: summaryAwal,
            tengah: summaryTengah,
            akhir: summaryAkhir,
        };

        // Send data to the controller
        $.ajax({
            url: JSON_INDIVIDU_PRINT_URL,
            method: "POST",
            data: {
                data: data,
                summary: summary,
                bn: bnParam,
                _token: CSRF_TOKEN,
            },
        });
    });

    $("#print-btn").on("click", function (e) {
        e.preventDefault(); // Prevent the default anchor behavior
        // Send data to the controller
        $.ajax({
            url: JSON_PRINT_URL,
            method: "POST",
            data: {
                // data: data,
                // summary: summary,
                // bn: bnParam,
                _token: CSRF_TOKEN,
            },
        });
    });

    // // Hide the tables initially
    // $('#weigher-table-individu').hide();

    // $('#bn-filter').on('change', function () {
    //     selectedBn = $(this).val(); // Store the selected value
    //     tableAwal.ajax.reload(); // Reload the DataTable when the BN filter changes
    //     if (selectedBn) {
    //         $('#weigher-table-individu').show(); // Show the table
    //          // Extract 'no' values and format them
    //         $.ajax({
    //             url: '/chart/1/' + selectedBn,
    //             method: 'GET',
    //             success: function (data) {
    //                 var ipc = data.map(function (row) {
    //                     return 'IPC ke - ' + row.ipc; // Format as "Tablet - {no}"
    //                 });
    //                 var weight = data.map(function (row) {
    //                     return row.weight;
    //                 });
    //                 var no = data.map(function (row) {
    //                     return row.no;
    //                 });
    //                 var ipc_no = data.map(function (row) {
    //                     return 'IPC: ' + row.ipc + ' - ' + `No.Tablet: ` + row.no; // Format as "Tablet - {no}"
    //                 });
    //                 var weightSumByIPC = data.reduce(function (acc, row) {
    //                     // Create a key for the IPC
    //                     var ipcKey = 'IPC ke - ' + row.ipc;

    //                     // Initialize the sum if it doesn't exist
    //                     if (!acc[ipcKey]) {
    //                         acc[ipcKey] = 0;
    //                     }

    //                     // Parse the weight to a float
    //                     const weight = parseFloat(row.weight, 10); // Assuming row.weight is a string or number

    //                     // Check if weight is a valid number before adding
    //                     if (!isNaN(weight)) {
    //                         // Add the weight to the corresponding IPC key
    //                         acc[ipcKey] += weight;
    //                     }

    //                     return acc;
    //                 }, {});

    //                 // Convert the result to an array if needed
    //                 var summedWeights = Object.keys(weightSumByIPC).map(function (ipcKey) {
    //                     return {
    //                         ipc: ipcKey,
    //                         totalWeight: weightSumByIPC[ipcKey]
    //                     };
    //                 });
    //                 // Find the row with the minimum weight
    //                 var minWeightRow = data.reduce(function (minRow, currentRow) {
    //                     return (parseFloat(currentRow.weight) < parseFloat(minRow.weight)) ? currentRow : minRow;
    //                 });

    //                 // Find the row with the maximum weight
    //                 var maxWeightRow = data.reduce(function (maxRow, currentRow) {
    //                     return (parseFloat(currentRow.weight) > parseFloat(maxRow.weight)) ? currentRow : maxRow;
    //                 });

    //                 // Update the min and max weight values in the UI
    //                 $('#min_weight_value').text(minWeightRow.weight);
    //                 $('#min_weight_ipc').text(minWeightRow.ipc);
    //                 $('#min_weight_tablet').text(minWeightRow.no);
    //                 $('#max_weight_value').text(maxWeightRow.weight);
    //                 $('#max_weight_ipc').text(maxWeightRow.ipc);
    //                 $('#max_weight_tablet').text(maxWeightRow.no);

    //                 // Update the chart with new categories and data
    //                 if (chart1) {
    //                     chart1.updateOptions({
    //                         xaxis: {
    //                             categories: ipc // Update categories
    //                         },
    //                         series: [{
    //                             type: 'area',
    //                             name: 'Weight',
    //                             data: weight,
    //                         }],
    //                     });
    //                     const stringWeight1 = weight;
    //                     const series = stringWeight1.map(num => parseFloat(num, 10));
    //                     chart2.updateOptions({
    //                         series: series,
    //                         labels: ipc_no,
    //                     });
    //                     chart3.updateOptions({
    //                         series: summedWeights.map(item => item.totalWeight),
    //                         labels: summedWeights.map(item => item.ipc),
    //                     });
    //                 } else {
    //                     // If chart is not initialized, create it
    //                     createChart1(ipc, weight, no);
    //                     createChart2(ipc_no, weight);
    //                     createChart3(summedWeights);
    //                 }
    //             },
    //         });
    //     } else {
    //         $('#weigher-table-individu').hide(); // Hide the table if no flag is selected
    //     }
    // });
    // function convertDataToNumbers(data) {
    //     return data.map(item => {
    //         return {
    //             n: parseInt(item.n, 10) || 0, // Convert to integer
    //             x: parseFloat(item.x) || 0,   // Convert to float
    //             s_dev: parseFloat(item.s_dev) || 0,
    //             s_rel: parseFloat(item.s_rel) || 0,
    //             min: parseFloat(item.min) || 0,
    //             max: parseFloat(item.max) || 0,
    //             diff: parseFloat(item.diff) || 0,
    //             sum: parseFloat(item.sum) || 0,
    //             // Add other fields as necessary
    //         };
    //     });
    // }

    // function calculateMetrics(data) {
    //     return data.reduce((metrics, item) => {
    //         // Ensure that each value is a number before adding
    //         metrics.n += (typeof item.n === 'number' ? item.n : 0);
    //         metrics.x += (typeof item.x === 'number' ? item.x : 0);
    //         metrics.sDev += (typeof item.s_dev === 'number' ? item.s_dev : 0);
    //         metrics.sRel += (typeof item.s_rel === 'number' ? item.s_rel : 0);
    //         metrics.diff += (typeof item.diff === 'number' ? item.diff : 0);
    //         metrics.sum += (typeof item.sum === 'number' ? item.sum : 0);

    //         // Update min and max
    //         // metrics.min = Math.min(metrics.min, (typeof item.min === 'number' ? item.min : metrics.min));
    //         // metrics.max = Math.max(metrics.max, (typeof item.max === 'number' ? item.max : metrics.max));

    //         metrics.min += (typeof item.min === 'number' ? item.min : 0);
    //         metrics.max += (typeof item.max === 'number' ? item.max : 0);

    //         return metrics;
    //     }, {
    //         n: 0,
    //         x: 0,
    //         sDev: 0,
    //         sRel: 0,
    //         min: 0, // Initialize to Infinity for min calculation
    //         max: 0, // Initialize to -Infinity for max calculation
    //         diff: 0,
    //         sum: 0
    //     });
    // }

    // Function to create the chart

    function createChart1(ipc, weight, no) {
        var element = document.getElementById("lineChart1");
        var height = parseInt(KTUtil.css(element, "height"));
        var labelColor = KTUtil.getCssVariableValue("--bs-gray-500");
        var borderColor = KTUtil.getCssVariableValue("--bs-gray-400");
        var baseColor = KTUtil.getCssVariableValue("--bs-info");
        var lightColor = KTUtil.getCssVariableValue("--bs-info-light");

        var options = {
            series: [
                {
                    type: "area",
                    name: "Weight",
                    data: weight,
                },
            ],
            chart: {
                fontFamily: "inherit",
                height: height,
                toolbar: {
                    show: false,
                },
            },
            plotOptions: {
                bar: {
                    horizontal: false,
                    columnWidth: ["30%"],
                    endingShape: "rounded",
                },
            },
            legend: {
                show: false,
            },
            dataLabels: {
                enabled: false,
            },
            stroke: {
                curve: "smooth",
                show: true,
                width: 3,
                colors: [baseColor],
            },
            markers: {
                size: 0,
            },
            xaxis: {
                categories: ipc, // Initial categories
                axisBorder: {
                    show: false,
                },
                axisTicks: {
                    show: false,
                },
                labels: {
                    style: {
                        colors: labelColor,
                        fontSize: "12px",
                    },
                },
            },
            yaxis: {
                labels: {
                    style: {
                        colors: labelColor,
                        fontSize: "12px",
                    },
                },
            },
            fill: {
                opacity: 1,
            },
            states: {
                normal: {
                    filter: {
                        type: "none",
                        value: 0,
                    },
                },
                hover: {
                    filter: {
                        type: "none",
                        value: 0,
                    },
                },
                active: {
                    allowMultipleDataPointsSelection: false,
                    filter: {
                        type: "none",
                        value: 0,
                    },
                },
            },
            tooltip: {
                style: {
                    fontSize: "12px",
                },
                y: {
                    formatter: function (val) {
                        return val;
                    },
                },
            },
            colors: [lightColor],
            grid: {
                borderColor: borderColor,
                strokeDashArray: 4,
                yaxis: {
                    lines: {
                        show: true,
                    },
                },
            },
        };

        chart1 = new ApexCharts(element, options);
        chart1.render();
    }

    function createChart2(ipc_no, weight) {
        var element = document.getElementById("pieChart1");
        var height = parseInt(KTUtil.css(element, "height"));
        var labelColor = KTUtil.getCssVariableValue("--bs-gray-500");
        var borderColor = KTUtil.getCssVariableValue("--bs-gray-400");
        var baseColor = KTUtil.getCssVariableValue("--bs-primary");
        var secondaryColor = KTUtil.getCssVariableValue("--bs-warning");

        const stringArray = weight;
        const series = stringArray.map((num) => parseFloat(num, 10));

        var options = {
            chart: {
                height: 380,
                width: "100%",
                type: "donut",
            },
            series: series,
            labels: ipc_no,
            plotOptions: {
                pie: {
                    donut: {
                        labels: {
                            show: true,
                            name: {
                                show: true,
                                fontSize: "14px",
                                fontFamily: "Helvetica, Arial, sans-serif",
                                fontWeight: 600,
                                color: "#000",
                                offsetY: 0,
                            },
                            value: {
                                show: true,
                                fontSize: "16px",
                                fontFamily: "Helvetica, Arial, sans-serif",
                                fontWeight: 400,
                                color: "#000",
                                offsetY: 0,
                            },
                        },
                    },
                },
            },
        };

        chart2 = new ApexCharts(element, options);

        chart2.render();
    }

    function createChart3(summedWeights) {
        var element = document.getElementById("pieChart2");
        var height = parseInt(KTUtil.css(element, "height"));
        var labelColor = KTUtil.getCssVariableValue("--bs-gray-500");
        var borderColor = KTUtil.getCssVariableValue("--bs-gray-400");
        var baseColor = KTUtil.getCssVariableValue("--bs-primary");
        var secondaryColor = KTUtil.getCssVariableValue("--bs-warning");

        var options = {
            chart: {
                height: 380,
                width: "100%",
                type: "donut",
            },
            series: summedWeights.map((item) => item.totalWeight),
            labels: summedWeights.map((item) => item.ipc),
            plotOptions: {
                pie: {
                    donut: {
                        labels: {
                            show: true,
                            name: {
                                show: true,
                                fontSize: "14px",
                                fontFamily: "Helvetica, Arial, sans-serif",
                                fontWeight: 600,
                                color: "#000",
                                offsetY: 0,
                            },
                            value: {
                                show: true,
                                fontSize: "16px",
                                fontFamily: "Helvetica, Arial, sans-serif",
                                fontWeight: 400,
                                color: "#000",
                                offsetY: 0,
                            },
                        },
                    },
                },
            },
        };

        chart3 = new ApexCharts(element, options);

        chart3.render();
    }

});