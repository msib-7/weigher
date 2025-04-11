<?php

namespace App\Http\Controllers;

use App\Models\ms303s_1\ms303s_1;
use App\Models\ms303s_1\ms303s_1_group;
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
