<?php

namespace App\Http\Controllers\dataTables;

use App\Http\Controllers\Controller;
use App\Models\ms303s_1\ms303s_1_group;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class Group extends Controller
{
    public function getData()
    {
        return DataTables::of(
            ms303s_1_group::query()
                ->where('no', '!=', null)
                ->where('n', '=', null)
                ->where('bn', '!=', null)
                ->orderBy('datetime', 'desc')
        )
            ->addIndexColumn()
            ->toJson();
    }

    public function index()
    {
        return view('pages.table.group.index');
    }
}
