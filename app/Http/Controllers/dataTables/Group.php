<?php

namespace App\Http\Controllers\dataTables;

use App\Http\Controllers\Controller;
use App\Models\ms303s_1\ms303s_1_group;
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
            if (!$request->has('bn') || empty($request->bn)) {
                return response()->json(['error' => 'BN parameter is required'], 400);
            }

            $query = ms303s_1_group::query()
                ->whereNotNull('no')
                ->whereNull('n')
                ->where('bn', $request->bn)
                ->limit(10);

            // Check if ipc_flag is provided and filter accordingly
            if ($request->has('ipc_flag') && !empty($request->ipc_flag)) {
                $query->where('ipc', $request->ipc_flag); // Adjust this line based on your actual column name for IPC flag
            }

            return DataTables::of($query)
                ->addIndexColumn()
                ->editColumn('datetime', function ($row) {
                    return \Carbon\Carbon::parse($row->datetime)->format('d-m-Y H:i:s');
                })
                ->make(true);
        }

        if (!$request->has('bn') || empty($request->bn)) {
            return response()->json(['error' => 'BN parameter is required'], 400);
        }

        $query = ms303s_1_group::query()
            ->whereNotNull('no')
            ->whereNull('n')
            ->where('bn', $request->bn)
            ->limit(10)
            ->orderBy('datetime', 'desc');

        $this->getIpc($request->bn);

        return DataTables::of($query)
            ->addIndexColumn()
            ->editColumn('datetime', function ($row) {
                return \Carbon\Carbon::parse($row->datetime)->format('d-m-Y H:i:s');
            })
            ->make(true);
    }

    public function index(Request $request)
    {
        // Jika tidak ada parameter BN, bisa redirect kembali atau tampilkan pesan
        if (!$request->has('bn') || empty($request->bn)) {
            return redirect()->route('v1.dashboard')->with('error', 'Silakan pilih BN terlebih dahulu');
        }

        $bn = $request->bn;
        return view('pages.table.group.index', compact('bn'));
    }

    public function getBn(Request $request)
    {
        $bns = ms303s_1_group::query()
            ->select('bn')
            ->distinct()
            ->orderBy('bn', 'asc')
            ->pluck('bn');

        return response()->json($bns);
    }

    public function getIpc($bn)
    {
        // Step 1: Check if the 'ipc' column exists before adding it
        if (!Schema::hasColumn('ms303s_1_group', 'ipc')) {
            DB::statement('ALTER TABLE public.ms303s_1_group ADD COLUMN ipc INTEGER;');
        }

        // Step 2: Calculate and update the 'ipc' column
        DB::statement('
            WITH ranked_data AS (
                SELECT *,
                    ROW_NUMBER() OVER (ORDER BY datetime) AS rn
                FROM public.ms303s_1_group
            ),
            flagged_data AS (
                SELECT *,
                    CASE 
                        WHEN no = 1 THEN 1
                        ELSE 0
                    END AS is_one
                FROM ranked_data
            ),
            final_data AS (
                SELECT *,
                    SUM(is_one) OVER (PARTITION BY bn ORDER BY rn ROWS BETWEEN UNBOUNDED PRECEDING AND CURRENT ROW) AS calculated_ipc,
                    LAG(no) OVER (PARTITION BY bn ORDER BY rn) AS prev_no
                FROM flagged_data
            )
            UPDATE public.ms303s_1_group
            SET ipc = subquery.ipc
            FROM (
                SELECT no, bn, datetime,
                    CASE 
                        WHEN is_one = 1 THEN calculated_ipc
                        WHEN prev_no = 1 OR prev_no != 1 THEN calculated_ipc
                        ELSE 0
                    END AS ipc
                FROM final_data
            ) AS subquery
            WHERE public.ms303s_1_group.no = subquery.no
            AND public.ms303s_1_group.bn = subquery.bn
            AND public.ms303s_1_group.datetime = subquery.datetime;
        ');

        // Step 3: Select the updated data and include ipc as flags
        $updatedData = DB::table('ms303s_1_group')
            ->select('no', 'bn', 'datetime', 'ipc')
            ->orderBy('datetime', 'desc')
            ->get();

        // Collect unique flags based on the updated ipc values
        $uniqueFlags = [];
        foreach ($updatedData as $item) {
            // Only add the flag if it's not already in the array
            if (!in_array($item->ipc, $uniqueFlags)) {
                $uniqueFlags[] = $item->ipc; // Use ipc as the flag
            }
        }

        return response()->json([
            'flags' => $uniqueFlags,
            'data' => $updatedData // Return the updated data
        ]);
    }
}
