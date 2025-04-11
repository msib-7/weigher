<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html" charset="utf-8" />
    <title>title</title>
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="shortcut icon" href="{{ asset('assets/logo/logo_only.png') }}" />
    <link href="/assets/plugins/global/plugins.bundle.css" rel="stylesheet" type="text/css" />
    <link href="/assets/css/style.bundle.css" rel="stylesheet" type="text/css" />

    <style>
        .page-break {
            page-break-after: always;
        }
    </style>
    <style>
        body {
            font-family: 'Inter', sans-serif;
            font-size: 9;
            margin: 0;
            /* padding: 20px; */
            background: #f9f9f9;
        }

        .container {
            background: white;
            border-radius: 10px;
        }

        h2 {
            text-align: center;
            margin: 10px 0;
            color: #333;
        }

        h3 {
            text-align: center;
            margin: 10px 0;
            color: #333;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin: 20px 0;
            border-radius: 10px;
            overflow: hidden;
        }

        th,
        td {
            border: 1px solid #ddd;
            padding: 20px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
            font-weight: bold;
        }

        td {
            background-color: #fff;
        }

        .text-center {
            text-align: center;
        }

        .footer {
            position: fixed;
            bottom: 0;
            left: 0;
            right: 0;
            text-align: center;
            font-size: 0.9rem;
            padding: 10px 0;
            border-top: 1px solid #ddd;
        }

        .table-header {
            font-size: 35px;
        }

        @media print {
            body {
                margin: 0;
                padding: 0;
            }

            table {
                page-break-inside: auto;
            }

            tr {
                page-break-inside: avoid;
                page-break-after: auto;
            }

            .footer {
                position: fixed;
                bottom: 0;
                left: 0;
                right: 0;
                text-align: center;
                font-size: 0.9rem;
                padding: 10px 0;
                border-top: 1px solid #ddd;
            }

            .new-page {
                margin-top: 20px;
                /* Adjust this value as needed */
            }
        }
    </style>
</head>

<body>
    <div class="container">
        <h2>Data Timbangan {nama mesin} {nama bn} {{$jenis}}</h2>

        <div class="section">
            <?php $no = 1; ?>
            @foreach (array_chunk($dataTimbangan, 22) as $chunk)
                            {{-- <table class="{{ !$loop->last ? 'new-page' : '' }}"> --}}
                                <table class="">
                                    <thead>
                                        <tr>
                                            @php
                                                $columns = [
                                                    'id' => 'ID',
                                                    'device_name' => 'DEVICE',
                                                    'kode_asset' => 'KODE ASSET',
                                                    'datetime' => 'DATETIME',
                                                    'epoc' => 'EPOC',
                                                    'no' => 'NO',
                                                    'weight' => 'WEIGHT',
                                                    'n' => 'N',
                                                    'x' => 'X',
                                                    's_dev' => 'S_DEV',
                                                    's_rel' => 'S_REL',
                                                    'min' => 'MIN',
                                                    'max' => 'MAX',
                                                    'diff' => 'DIFF',
                                                    'sum' => 'SUM',
                                                    'lot' => 'LOT',
                                                    'name' => 'NAME',
                                                    'cnt' => 'CNT',
                                                ];
                                            @endphp

                                            <th class="table-header text-center">NO</th>
                                            @foreach ($columns as $key => $label)
                                                @if (!is_null($chunk[0][$key]))
                                                    <th class="table-header text-center">{{ $label }}</th>
                                                @endif
                                            @endforeach
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($chunk as $item)
                                            <tr>
                                                <td class="text-center">{{ $no }}</td>
                                                @foreach ($columns as $key => $label)
                                                    @if (!is_null($item[$key]))
                                                        <td class="text-center">{{ $item[$key] }}</td>
                                                    @endif
                                                @endforeach
                                            </tr>
                                            <?php        $no++; ?>
                                        @endforeach
                                    </tbody>
                                </table>
                                @if (!$loop->last)
                                <div class="footer"></div>
                                    <div class="page-break"></div>
                                </div>
                            </div>
                            <div class="container mt-10">
                                <div class="section">
                                    <h2>Data Timbangan {nama mesin} {nama bn} {jenis data}</h2>
                                @endif
            @endforeach
        </div>

        <div class="section">
            <div class="row">
                <div>
                    <table>
                        <thead>
                            <th class="text-center" style="width: 25%;">Summary</th>
                            <th class="text-center" style="width: 25%;">Average</th>
                            <th class="text-center" style="width: 25%;">Max</th>
                            <th class="text-center" style="width: 25%;">Min</th>
                        </thead>
                        <tbody>
                            <tr>
                                <td class="text-center">
                                    {{ $summary['sum'] }}
                                </td>
                                <td class="text-center">
                                    {{ $summary['avg'] }}
                                </td>
                                <td class="text-center">
                                    {{ $summary['max'] }}
                                </td>
                                <td class="text-center">
                                    {{ $summary['min'] }}
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <div class="footer">
    </div>

    <script src="/assets/plugins/global/plugins.bundle.js"></script>
    <script src="/assets/js/scripts.bundle.js"></script>
    {{--
    <script>
        // Set the print date
        document.getElementById('print-date').innerText = 'Printed on: ' + new Date().toLocaleString('en-GB', { day: '2-digit', month: 'short', year: 'numeric', hour: '2-digit', minute: '2-digit', second: '2-digit' });
    </script> --}}
    <script type="text/php">
        if (isset($pdf)) { 
            // Shows number center-bottom of A4 page with $x,$y values
            $x = 745;  // X-axis i.e. vertical position 
            $y = 560; // Y-axis horizontal position
            $text = "Page {PAGE_NUM} of {PAGE_COUNT}";  // Format of display message
            $font =  $fontMetrics->get_font("Inter", "bold");
            $size = 10;
            $color = array(0,0,0);
            $word_space = 0.0;  // Default
            $char_space = 0.0;  // Default
            $angle = 0.0;   // Default
            $pdf->page_text($x, $y, $text, $font, $size, $color, $word_space, $char_space, $angle);

            // Shows print date center-bottom of A4 page with $x,$y values
            $x = 45;  // X-axis i.e. vertical position 
            $y = 560; // Y-axis horizontal position
            $printDate = "Printed on: " . date('d M Y H:i:s');  // Format of display message
            $pdf->page_text($x, $y, $printDate, $font, $size, $color, $word_space, $char_space, $angle);

            

            
            // Shows print id
            $x = 45;  // X-axis i.e. vertical position 
            $y = 570; // Y-axis horizontal position
            $printID = "Print ID: " . "custom id";  
            $pdf->page_text($x, $y, $printID, $font, $size, $color, $word_space, $char_space, $angle);
        }
    </script>
</body>

</html>