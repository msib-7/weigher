<?php

namespace App\Http\Controllers\dataTables;

use App\Http\Controllers\Controller;
use App\Models\ms204ts_com9_4\ms204ts_com9_4_summary;
use App\Models\ms303s_1\ms303s_1_summary;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class Summary extends Controller
{
    public function getData(Request $request)
    {
        if ($request->ajax()) {
            $query = ms204ts_com9_4_summary::query()
                ->where('lot', $request->bn);

            return DataTables::of($query)
                ->addIndexColumn()
                ->editColumn('datetime', function ($row) {
                    return Carbon::parse($row->datetime)->format('d-m-Y H:i:s');
                })
                ->editColumn('x', function ($row) {
                    return number_format($row->x, 2, '.', '');
                })
                ->editColumn('s_dev', function ($row) {
                    return number_format($row->s_dev, 2, '.', '');
                })
                ->editColumn('s_rel', function ($row) {
                    return number_format($row->s_rel, 2, '.', '');
                })
                ->editColumn('min', function ($row) {
                    return number_format($row->min, 2, '.', '');
                })
                ->editColumn('max', function ($row) {
                    return number_format($row->max, 2, '.', '');
                })
                ->editColumn('diff', function ($row) {
                    return number_format($row->diff, 2, '.', '');
                })
                ->editColumn('sum', function ($row) {
                    return number_format($row->sum, 2, '.', '');
                })
                ->make(true);
        }

        $query = ms204ts_com9_4_summary::query()
            ->where('lot', $request->bn);

        return DataTables::of($query)
            ->addIndexColumn()
            ->editColumn('datetime', function ($row) {
                return Carbon::parse($row->datetime)->format('d-m-Y H:i:s');
            })
            ->editColumn('x', function ($row) {
                return number_format($row->x, 2, '.', '');
            })
            ->editColumn('s_dev', function ($row) {
                return number_format($row->s_dev, 2, '.', '');
            })
            ->editColumn('s_rel', function ($row) {
                return number_format($row->s_rel, 2, '.', '');
            })
            ->editColumn('min', function ($row) {
                return number_format($row->min, 2, '.', '');
            })
            ->editColumn('max', function ($row) {
                return number_format($row->max, 2, '.', '');
            })
            ->editColumn('diff', function ($row) {
                return number_format($row->diff, 2, '.', '');
            })
            ->editColumn('sum', function ($row) {
                return number_format($row->sum, 2, '.', '');
            })
            ->make(true);
    }

    public function index()
    {
        return view('pages.table.summary.index');
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
        $bns = ms204ts_com9_4_summary::query()
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
}
