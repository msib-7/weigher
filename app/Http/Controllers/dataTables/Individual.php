<?php

namespace App\Http\Controllers\dataTables;

use App\Http\Controllers\Controller;
use App\Models\ms204ts_com9_4\ms204ts_com9_4_individual;
use App\Models\ms204ts_com9_4\ms204ts_com9_4_summary;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Mike42\Escpos\PrintConnectors\NetworkPrintConnector;
use Mike42\Escpos\PrintConnectors\WindowsPrintConnector;
use Mike42\Escpos\Printer;
use Rawilk\Printing\Facades\Printing;
use Yajra\DataTables\Facades\DataTables;

class Individual extends Controller
{
    public function getData(Request $request)
    {
        if ($request->ajax()) {
            $query = ms204ts_com9_4_individual::query()
                ->where('lot', $request->bn)
                ->where('ipc', $request->ipc);

            return DataTables::of($query)
                ->addIndexColumn()
                ->editColumn('datetime', function ($row) {
                    return Carbon::parse($row->datetime)->format('d-m-Y H:i:s');
                })
                ->editColumn('weight', function ($row) {
                    return number_format($row->weight, 2, '.');
                })
                ->make(true);
        }

        $query = ms204ts_com9_4_individual::query()
            ->where('lot', $request->bn)
            ->where('ipc', $request->ipc);

        return DataTables::of($query)
            ->addIndexColumn()
            ->editColumn('datetime', function ($row) {
                return Carbon::parse($row->datetime)->format('d-m-Y H:i:s');
            })
            ->editColumn('weight', function ($row) {
                return number_format($row->weight, 2, '.');
            })
            ->make(true);
    }

    public function index()
    {
        return view('pages.table.individual.index');
    }

    public function exportPDF(Request $request)
    {
        // Generate a unique print ID
        $printId = (string) \Ramsey\Uuid\Uuid::uuid4();
        $data['printId'] = $printId;
        $data['namaMesin'] = 'ms204ts_com9_4';
        $data['namaBn'] = $request->bn;
        // Get the data and summary from the request
        $data['dataTimbangan'] = $request->data; // This is already an array
        $data['summaryAwal'] = $request->summary['awal']; // This is also an array
        $data['summaryTengah'] = $request->summary['tengah']; // This is also an array
        $data['summaryAkhir'] = $request->summary['akhir']; // This is also an array

        $pdf = Pdf::loadView('partials.pdf.individual.index', $data)->setPaper('a4', 'landscape')->set_option('isPhpEnabled', true);
        $formattedDate = Carbon::now()->format('d M Y H:i:s');
        return $pdf->download('Individual_' . $formattedDate . '.pdf');
    }

    public function getIpc($bn)
    {
        // Step 3: Select the updated data and include ipc as flags
        $dataIpc = ms204ts_com9_4_individual::query()
            ->where('lot', $bn)
            ->orderBy('datetime', 'desc')
            ->get();

        // Collect unique flags based on the updated ipc values
        $uniqueFlags = [];
        foreach ($dataIpc as $item) {
            // Only add the flag if it's not already in the array
            if (!in_array($item->ipc, $uniqueFlags)) {
                $uniqueFlags[] = $item->ipc; // Use ipc as the flag
            }
        }

        return response()->json([
            'flags' => $uniqueFlags,
            'data' => $dataIpc // Return the updated data
        ]);
    }

    public function getBn(Request $request)
    {
        $date = $request->date; // Ensure this is in 'MM/DD/YYYY - MM/DD/YYYY' format
        $token = strtok($date, " - ");

        $date1 = '';
        $date2 = '';

        if ($token !== false) {
            // Convert the first date to 'Y-m-d' format
            $date1 = Carbon::createFromFormat('m/d/Y', $token)->format('Y-m-d');
            $token = strtok(" - "); // Continue tokenizing with the same delimiter
        }

        if ($token !== false) {
            // Convert the second date to 'Y-m-d' format
            $date2 = Carbon::createFromFormat('m/d/Y', $token)->format('Y-m-d');
        }

        // Query the database
        $bns = ms204ts_com9_4_individual::query()
            ->select('lot', 'datetime')
            ->whereNotNull('lot') // Exclude records where 'lot' is null
            ->whereBetween('datetime', [$date1, $date2]) // Use whereDate if you want to filter by date only
            ->orderBy('datetime', 'desc')
            ->get(); // Get the results as a collection

        // Convert 'datetime' to 'Y-m-d' format and filter unique values based on 'lot' and 'datetime'
        $uniqueBns = $bns->unique(function ($item) {
            return $item->lot; // Create a unique key based on both fields
        })->values(); // Reset the keys

        return response()->json($uniqueBns);
    }

    public function getSummary($bn, $ipc)
    {
        $dataSum = ms204ts_com9_4_summary::query()
            ->where('lot', $bn)
            ->where('ipc', $ipc)
            ->orderBy('datetime', 'desc')
            ->get();

        return response()->json($dataSum);
    }

    public function loadChart1($bn){
        $data = ms204ts_com9_4_individual::query()
            ->whereNotNull('no')
            ->whereNull('n')
            ->where('lot', $bn)
            ->orderBy('datetime', 'desc')
            ->get();

        // dd($dataAll);
        return response()->json($data);
    }

    public function printD(Request $request)
    {
        // try {
        //     // $connector = new NetworkPrintConnector("172.24.72.247", 9100);
        //     $connector = new WindowsPrintConnector("EPSON L1300 Series");

        //     /* Print a "Hello world" receipt" */
        //     $printer = new Printer($connector);
        //     $printer->text("Hello World!\n");
        //     $printer->cut();

        //     /* Close printer */
        //     $printer->close();
        // } catch (Exception $e) {
        //     echo "Couldn't print to this printer: " . $e->getMessage() . "\n";
        // }
        // Generate a unique print ID
        $printId = (string) \Ramsey\Uuid\Uuid::uuid4();
        $data['printId'] = $printId;
        $data['namaMesin'] = 'ms204ts_com9_4';
        $data['namaBn'] = $request->bn;
        // Get the data and summary from the request
        $data['dataTimbangan'] = $request->data; // This is already an array
        $data['summaryAwal'] = $request->summary['awal']; // This is also an array
        $data['summaryTengah'] = $request->summary['tengah']; // This is also an array
        $data['summaryAkhir'] = $request->summary['akhir']; // This is also an array

        $formattedDate = Carbon::now()->format('d-M-Y_H:i:s');
        $pdfName = 'Individual_' . $formattedDate;
        $pdf = Pdf::loadView('partials.pdf.individual.index', $data)->setPaper('a4', 'landscape')->set_option('isPhpEnabled', true);

        // Sanitize filename
        $pdfName = str_replace([':', '\\', '/', '*', '?', '"', '<', '>', '|'], '-', $pdfName);

        // Define directory (using absolute path)
        $directory = '../public/assets/pdf/'; // Adjust this path as needed

        // Create directory if missing
        if (!file_exists($directory)) {
            mkdir($directory, 0755, true);
        }

        $pdfNameFinal = $pdfName . '.pdf';
        // Save and stream
        $pdf->save($directory . $pdfNameFinal);

        Printing::newPrintTask()
            ->printer(74325571)
            ->file('../public/assets/pdf/' . $pdfNameFinal)
            ->send();
    }
}
