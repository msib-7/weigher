<?php

namespace App\Http\Controllers\dataTables;

use App\Http\Controllers\Controller;
use App\Models\ms303s_1\ms303s_1_summary;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class Summary extends Controller
{
    public function getData()
    {
        return DataTables::of(
            ms303s_1_summary::query()
                ->where('n', '!=', null)
                ->orderBy('datetime', 'desc')
        )
            ->addIndexColumn()
            ->toJson();
    }

    public function index()
    {
        return view('pages.table.summary.index');
    }
}
