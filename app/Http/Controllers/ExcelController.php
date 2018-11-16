<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Exports\YourExport;
use App\Imports\YourImport;
use Maatwebsite\Excel\Excel;

class ExcelController extends Controller
{
    private $excel;

    public function __construct(Excel $excel)
    {
        $this->excel = $excel;
    }

    public function export()
    {
        return $this->excel->download(new YourExport, 'users.xlsx');
    }

    public function import()
    {
        return $this->excel->import(new YourImport, 'users.xlsx');
    }
}
