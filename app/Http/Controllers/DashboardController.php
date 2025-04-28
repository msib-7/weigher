<?php

namespace App\Http\Controllers;

use App\Models\ms204ts_com9_4\ms204ts_com9_4;
use App\Models\ms303s_1\ms303s_1;
use App\Models\ms303s_1\ms303s_1_group;
use Carbon\Carbon;
use Illuminate\Http\Request;
use LaravelQRCode\Facades\QRCode;
use Mike42\Escpos\EscposImage;
use Mike42\Escpos\ImagickEscposImage;
use Mike42\Escpos\PrintConnectors\WindowsPrintConnector;
use Mike42\Escpos\Printer;
use Exception;
use Imagick;
use ImagickPixel;
use Yajra\DataTables\Facades\DataTables;
// use SimpleSoftwareIO\QrCode\Facades\QrCode;

class DashboardController extends Controller
{
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
        $bns = ms204ts_com9_4::query()
            ->select('lot', 'datetime')
            ->whereNotNull('lot') // Exclude records where 'lot' is null
            ->whereBetween('datetime', [$date1, $date2]) // Use whereDate if you want to filter by date only
            ->orderBy('datetime', 'desc')
            ->get(); // Get the results as a collection

        // Convert 'datetime' to 'Y-m-d' format and filter unique values based on 'lot' and 'datetime'
        $uniqueBns = $bns->map(function ($item) {
            $item->datetime = Carbon::parse($item->datetime)->format('Y-m-d'); // Convert 'datetime' to 'Y-m-d'
            return $item;
        })->unique(function ($item) {
            return $item->lot . $item->datetime; // Create a unique key based on both fields
        })->values(); // Reset the keys

        return response()->json($uniqueBns);
    }

    public function dataIndividu()
    {
        return DataTables::of(
                ms303s_1::query()
                ->where('no', '=', null)
                ->orderBy('datetime', 'desc')
                )->toJson();
    }
    public function dataKelompok()
    {
        return DataTables::of(
                ms303s_1_group::query()
                ->where('no', '!=', null)
                ->where('n', '=', null)
                ->where('bn', '!=', null)
                ->orderBy('datetime', 'desc')
                )->toJson();
    }
    public function dataSummary()
    {
        return DataTables::of(
                ms303s_1::query()
                ->where('n', '!=', null)
                ->orderBy('datetime', 'desc')
                )->toJson();
    }
    public function index()
    {
        // return view('pages.homepage.index');
        return view('pages.homepage.index');
    }

    public function tableView()
    {
        return view('pages.table.index');
    }
    // public function print()
    // {
    //     // $connector = new WindowsPrintConnector("EPSON L1300 Series");
    //     $connector = new WindowsPrintConnector("BIXOLON XD3");
    //     // $connector = new WindowsPrintConnector("COM6");
    //     // $connector = new WindowsPrintConnector("Honeywell_PC42E-T_(203_dpi)_-_DP");
    //     // $connector = new WindowsPrintConnector("Honeywell1");
    //     $printer = new Printer($connector);

    //     // $path = public_path('qr-code.png');
    //     // $path = public_path('document.pdf');
    //     // $pages = ImagickEscposImage::loadPdf($path);
    //     // $tux = EscposImage::load($path, false);
    //     // $image = new Imagick();
    //     // $image->newImage(1, 1, new ImagickPixel('#ffffff'));
    //     // $image->setImageFormat('png');
    //     // $pngData = $image->getImageBlob();
        
    //     // try {

    //         $printer->qrCode('Hello, Laravel 11!');
    //         // $printer->barcode('12345123');
    //         // $printer->text("Hello World!\n");
    //         // $printer->graphics($a);
    //         // $printer->feed(1);
    //         // foreach ($pages as $page) {
    //         //     $printer->graphics($page);
    //         // }

    //     // $printer->graphics($tux);
    //     // $printer->text("Regular Tux.\n");
    //     // $printer->feed();
    //         $printer->cut();

    //         /* Close printer */
    //         $printer->close();
    //     // } catch (Exception $e) {
    //     //     echo "Couldn't print to this printer: " . $e->getMessage() . "\n";
    //     // }

    //     return redirect()->route('dashboard')->with('success', 'Print success');
    // }    
}
