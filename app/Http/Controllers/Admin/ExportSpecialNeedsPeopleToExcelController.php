<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Exports\SpecialNeedsPeopleExport;
use Maatwebsite\Excel\Facades\Excel;

class ExportSpecialNeedsPeopleToExcelController extends Controller
{
    public function exportSpecialNeedsPeople()
    {
        return Excel::download(new SpecialNeedsPeopleExport, 'ذوي الاحتياجات الخاصة.xlsx');
    }
}