<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Carbon\Carbon;
use PDF;

use App\Models\Offices;
use App\Models\Borrowed;
use App\Models\Category;

class ReportsController extends Controller
{
    public function logselectdateRead()
    {
        return view('reports.elogbook');
    }

    public function logselectdateShow(Request $request)
    {
        return view('reports.elogbookSearch');
    }

    public function logbookPDF(Request $request)
    {

        $elogs = Borrowed::leftJoin('invtcategory', 'borrowequip.equipid', '=', 'invtcategory.id')
            ->leftJoin('offices', 'borrowequip.department', '=', 'offices.id')
            //->whereDate('borrowequip.dateborrowed', $datequery)
            ->select('invtcategory.id as icid', 'invtcategory.equipment', 'invtcategory.typeequip', 'offices.id as oid', 'offices.office_abbr', 'borrowequip.*')
            ->get();

            //dd($elogs);

        $data = [
            'elogs' => $elogs,
        ];

        $pdf = PDF::loadView('reports.pdf.logbook', $data)->setPaper('Legal', 'landscape');

        return $pdf->stream();
    }
}
