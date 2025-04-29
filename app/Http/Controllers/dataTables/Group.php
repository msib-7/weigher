<?php

namespace App\Http\Controllers\dataTables;

use App\Http\Controllers\Controller;
use App\Models\ms204ts_com9_4\ms204ts_com9_4;
use App\Models\ms204ts_com9_4\ms204ts_com9_4_group;
use App\Models\ms204ts_com9_4\ms204ts_com9_4_individual;
use App\Models\ms204ts_com9_4\ms204ts_com9_4_summary;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;
use DateTime;
use DB;
use Illuminate\Http\Request;
use Schema;
use Yajra\DataTables\Facades\DataTables;

class Group extends Controller
{
    public function getData(Request $request)
    {
        if ($request->ajax()) {
            $query = ms204ts_com9_4_group::query()
                ->where('lot', $request->bn)
                ->get();

            return response()->json($query);
        }

        $query = ms204ts_com9_4_group::query()
            ->where('lot', $request->bn)
            ->get();

        $isAjax = 'false'; // Set this variable to false for non-AJAX requests
        return view('pages.table.group.index', compact('query', 'isAjax'));
    }

    public function index(Request $request)
    {
        return view('pages.table.group.index');
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
        $bns = ms204ts_com9_4_group::query()
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

    public function getIpc($bn)
    {
        // Step 3: Select the updated data and include ipc as flags
        $dataIpc = ms204ts_com9_4_group::query()
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

    public function getSummary($bn, $ipc)
    {
        $dataSum = ms204ts_com9_4_summary::query()
            ->where('lot', $bn)
            ->where('ipc', $ipc)
            ->orderBy('datetime', 'desc')
            ->get();
            
            // $dataAll = ms204ts_com9_4_group::query()
            // ->whereNotNull('no')
            // ->whereNull('n')
            // ->where('lot', $bn)
            // ->where('ipc', $ipc)
            // ->limit(10)
            // ->orderBy('no', 'asc')
            // ->get();

        // dd($dataAll);
        // return response()->json([$dataSum, $dataAll]);
        return response()->json($dataSum);
    }

    public function print(Request $request)
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

        $pdf = Pdf::loadView('partials.pdf.group.index', $data)->set_option('isPhpEnabled', true);
        return $pdf->stream('Group.pdf');
    }
}
