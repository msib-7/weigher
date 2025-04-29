<!DOCTYPE html>
<html lang="en">

<head>
    <title>Data Timbangan "{{ $namaMesin }}" - {{ $namaBn }}</title>
    <meta http-equiv="Content-Type" content="text/html" charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />

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
        <h2>Data Timbangan "{{ $namaMesin }}" - {{ $namaBn }}</h2>

        <div class="section">
            @if (is_null($dataTimbangan))
                <p>No data available.</p>
            @else
                <table>
                    <tr>
                        <td>
                            @if (!empty($dataTimbangan['awal']))
                                @foreach ($dataTimbangan['awal'] as $index => $ipc)
                                    IPC KE - {{ $ipc['ipc'] }}<br>
                                    @break
                                @endforeach
                            @endif
                        </td>
                        <td>
                            @if (!empty($dataTimbangan['tengah']))
                                @foreach ($dataTimbangan['tengah'] as $index => $ipc)
                                    IPC KE - {{ $ipc['ipc'] }}<br>
                                    @break
                                @endforeach
                            @endif
                        </td>
                        <td>
                            @if (!empty($dataTimbangan['akhir']))
                                @foreach ($dataTimbangan['akhir'] as $index => $ipc)
                                    IPC KE - {{ $ipc['ipc'] }}<br>
                                    @break
                                @endforeach
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <td style="width: 33%;">
                            @if (!isset($dataTimbangan['awal']) || empty($dataTimbangan['awal']))
                                <p>Tidak Ada IPC terpilih.</p>
                            @else
                                <?php        $no = 1; ?>
                                @foreach (array_chunk($dataTimbangan['awal'], 10) as $chunk)
                                    <table width="33%">
                                        <thead>
                                            <tr>
                                                @php
                                                $columns = [
                                                    'datetime' => 'DATETIME',
                                                    'weight' => 'WEIGHT',
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
                                                <?php                $no++; ?>
                                            @endforeach
                                        </tbody>
                                    </table>
                                @endforeach
                            @endif
                        </td>
                        <td style="width: 33%;">
                            @if (!isset($dataTimbangan['tengah']) || empty($dataTimbangan['tengah']))
                                <p>Tidak Ada IPC terpilih.</p>
                            @else
                            <?php        $no = 1; ?>
                                @foreach (array_chunk($dataTimbangan['tengah'], 10) as $chunk)
                                    <table width="33%">
                                        <thead>
                                            <tr>
                                                @php
            $columns = [
                'datetime' => 'DATETIME',
                'weight' => 'WEIGHT',
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
                                                <?php                $no++; ?>
                                            @endforeach
                                        </tbody>
                                    </table>
                                @endforeach
                            @endif
                        </td>
                        <td style="width: 33%;">
                            @if (!isset($dataTimbangan['akhir']) || empty($dataTimbangan['akhir']))
                                <p>Tidak Ada IPC terpilih.</p>
                            @else
                            <?php        $no = 1; ?>
                                @foreach (array_chunk($dataTimbangan['akhir'], 10) as $chunk)
                                    <table width="33%">
                                        <thead>
                                            <tr>
                                                @php
            $columns = [
                'datetime' => 'DATETIME',
                'weight' => 'WEIGHT',
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
                                                <?php                $no++; ?>
                                            @endforeach
                                        </tbody>
                                    </table>
                                @endforeach
                            @endif
                        </td>
                    </tr>   
                </table>
            @endif
        </div>

        <div class="section">
            <table>
                <tr>
                    <td style="width: 33%;">
                        <div>
                            Summary IPC Awal
                            <table>
                                <tbody>
                                    <tr>
                                        <td class="text-center">N</td>
                                        <td class="text-center">{{ $summaryAwal['n'] }}</td>
                                    </tr>
                                    <tr>
                                        <td class="text-center">X</td>
                                        <td class="text-center">{{ $summaryAwal['x'] }}</td>
                                    </tr>
                                    <tr>
                                        <td class="text-center">SDEV</td>
                                        <td class="text-center">{{ $summaryAwal['s_dev'] }}</td>
                                    </tr>
                                    <tr>
                                        <td class="text-center">SREL</td>
                                        <td class="text-center">{{ $summaryAwal['s_rel'] }}</td>
                                    </tr>
                                    <tr>
                                        <td class="text-center">MIN</td>
                                        <td class="text-center">{{ $summaryAwal['min'] }}</td>
                                    </tr>
                                    <tr>
                                        <td class="text-center">MAX</td>
                                        <td class="text-center">{{ $summaryAwal['max'] }}</td>
                                    </tr>
                                    <tr>
                                        <td class="text-center">DIFF</td>
                                        <td class="text-center">{{ $summaryAwal['diff'] }}</td>
                                    </tr>
                                    <tr>
                                        <td class="text-center">SUM</td>
                                        <td class="text-center">{{ $summaryAwal['sum'] }}</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </td>
                    <td style="width: 33%;">
                        <div>
                            Summary IPC Tengah
                            <table>
                                <tbody>
                                    <tr>
                                        <td class="text-center">N</td>
                                        <td class="text-center">{{ $summaryTengah['n'] }}</td>
                                    </tr>
                                    <tr>
                                        <td class="text-center">X</td>
                                        <td class="text-center">{{ $summaryTengah['x'] }}</td>
                                    </tr>
                                    <tr>
                                        <td class="text-center">SDEV</td>
                                        <td class="text-center">{{ $summaryTengah['s_dev'] }}</td>
                                    </tr>
                                    <tr>
                                        <td class="text-center">SREL</td>
                                        <td class="text-center">{{ $summaryTengah['s_rel'] }}</td>
                                    </tr>
                                    <tr>
                                        <td class="text-center">MIN</td>
                                        <td class="text-center">{{ $summaryTengah['min'] }}</td>
                                    </tr>
                                    <tr>
                                        <td class="text-center">MAX</td>
                                        <td class="text-center">{{ $summaryTengah['max'] }}</td>
                                    </tr>
                                    <tr>
                                        <td class="text-center">DIFF</td>
                                        <td class="text-center">{{ $summaryTengah['diff'] }}</td>
                                    </tr>
                                    <tr>
                                        <td class="text-center">SUM</td>
                                        <td class="text-center">{{ $summaryTengah['sum'] }}</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </td>
                    <td style="width: 33%;">
                        <div>
                            Summary IPC Akhir
                            <table>
                                <tbody>
                                    <tr>
                                        <td class="text-center">N</td>
                                        <td class="text-center">{{ $summaryAkhir['n'] }}</td>
                                    </tr>
                                    <tr>
                                        <td class="text-center">X</td>
                                        <td class="text-center">{{ $summaryAkhir['x'] }}</td>
                                    </tr>
                                    <tr>
                                        <td class="text-center">SDEV</td>
                                        <td class="text-center">{{ $summaryAkhir['s_dev'] }}</td>
                                    </tr>
                                    <tr>
                                        <td class="text-center">SREL</td>
                                        <td class="text-center">{{ $summaryAkhir['s_rel'] }}</td>
                                    </tr>
                                    <tr>
                                        <td class="text-center">MIN</td>
                                        <td class="text-center">{{ $summaryAkhir['min'] }}</td>
                                    </tr>
                                    <tr>
                                        <td class="text-center">MAX</td>
                                        <td class="text-center">{{ $summaryAkhir['max'] }}</td>
                                    </tr>
                                    <tr>
                                        <td class="text-center">DIFF</td>
                                        <td class="text-center">{{ $summaryAkhir['diff'] }}</td>
                                    </tr>
                                    <tr>
                                        <td class="text-center">SUM</td>
                                        <td class="text-center">{{ $summaryAkhir['sum'] }}</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </td>
                </tr>
            </table>
        </div>
    </div>

    <div class="footer">
    </div>

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
            $printID = "Print ID: " . "{{ $printId }}";  // Format of display message
            $pdf->page_text($x, $y, $printID, $font, $size, $color, $word_space, $char_space, $angle);
        }
    </script>
</body>

</html>