<?php

namespace App\Http\Controllers\dataTables;

use App\Http\Controllers\Controller;
use App\Models\ms303s_1\ms303s_1_individual;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class Individual extends Controller
{
    public function getData()
    {
        return DataTables::of(
            ms303s_1_individual::query()
                ->where('no', '=', null)
                ->orderBy('datetime', 'desc')
        )
        ->addIndexColumn()
        ->toJson();
    }

    public function index()
    {
        return view('pages.table.individual.index');
    }

    public function print(Request $request)
    {
        // Get the data and summary from the request
        $data['dataTimbangan'] = $request->data; // This is already an array
        $data['summary'] = $request->summary; // This is also an array
        $data['jenis'] = 'Individual';

        $pdf = Pdf::loadView('partials.pdf.index', $data)->set_option('isPhpEnabled', true);
        return $pdf->stream('Individual.pdf');
    }
}
