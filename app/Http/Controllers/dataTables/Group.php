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
        // Validasi harus ada parameter BN
        if ($request->ajax()) {
            $query = ms204ts_com9_4_group::query()
                ->where('lot', $request->bn);

            return DataTables::of($query)
                ->addIndexColumn()
                ->editColumn('datetime', function ($row) {
                    return Carbon::parse($row->datetime)->format('d-m-Y H:i:s');
                })
                ->make(true);
        }
        $query = ms204ts_com9_4_group::query()
            ->where('lot', $request->bn);

        return DataTables::of($query)
            ->addIndexColumn()
            ->editColumn('datetime', function ($row) {
                return Carbon::parse($row->datetime)->format('d-m-Y H:i:s');
            })
            ->make(true);
    }

    public function index(Request $request)
    {
        return view('pages.table.group.index');
    }

    public function getBn(Request $request)
    {
        $date = $request->date; // Ensure this is in 'Y-m-d' format if you're using whereDate

        $bns = ms204ts_com9_4_group::query()
            ->select('lot', 'datetime')
            ->whereDate('datetime', '=', $date) // Use whereDate if you want to filter by date only
            ->orderBy('lot', 'desc')
            ->pluck('lot');

        // Convert the collection to an array and filter unique values
        $uniqueBns = $bns->unique()->values(); // This will keep only unique values

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
