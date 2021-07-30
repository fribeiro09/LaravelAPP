<?php

namespace App\Http\Controllers\Admin;

use App\Exports\ReportExport;
use App\Http\Controllers\Controller;
use App\Models\Employee;
use App\Models\WorkLog;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;

class ReportController extends Controller
{
    private $worklog;

    public function __construct(Employee $employee, User $user, WorkLog $worklog)
    {
        $this->employee = $employee;
        $this->worklog = $worklog;
        $this->user = $user;

        // $this->middleware(['can:avaliador']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $employees = Employee::all();

        return view('admin.pages.reports.index', compact('employees'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->all();

        if ($data['model'] === "Rel") {

            $worklogs = DB::table('work_logs')
            ->join('employees', 'employees.id', '=', 'work_logs.employee_id')
            ->select('work_logs.*', 'employees.name as employee_name')
            ->where(function($query) use ($request) {
                if ($request->filter_employee) {
                    $query->Where('employees.id', $request->filter_employee);
                }
            })
            ->where(function($query) use ($request) {
                if ($request->filter_date_start) {
                    $query->whereDate('work_logs.date', '>=', formatDate($request->filter_date_start, 'd/m/Y', 'Y-m-d'));
                }
            })
            ->where(function($query) use ($request) {
                if ($request->filter_date_end) {
                    $query->whereDate('work_logs.date', '<=', formatDate($request->filter_date_end, 'd/m/Y', 'Y-m-d'));
                }
            })
            ->orderBy('employee_name', 'asc')
            ->orderBy('work_logs.date', 'asc')
            ->get();

            if (count($worklogs) > 1) {
                return view('admin.pages.reports.report', compact('worklogs'));
            } else {
                $error_msg = "Nenhuma informação encontrada nos Filtros Aplicados.";
                $employees = Employee::all();
                $filters = $request->only('filter_employee', 'filter_date_start', 'filter_date_end', 'model');
                return view('admin.pages.reports.index', compact('filters','employees', 'error_msg'));
            }



        } else if ($data['model'] === "Rec") {
            $worklogs = DB::table('work_logs')
            ->join('employees', 'employees.id', '=', 'work_logs.employee_id')
            ->selectRaw('SUM(time_to_sec(work_logs.time)) as time, MIN(work_logs.date) as date_start, MAX(work_logs.date) as date_end, employees.name as employee_name')
            ->where(function($query) use ($request) {
                if ($request->filter_employee) {
                    $query->Where('employees.id', $request->filter_employee);
                }
            })
            ->where(function($query) use ($request) {
                if ($request->filter_date_start) {
                    $query->whereDate('work_logs.date', '>=', formatDate($request->filter_date_start, 'd/m/Y', 'Y-m-d'));
                }
            })
            ->where(function($query) use ($request) {
                if ($request->filter_date_end) {
                    $query->whereDate('work_logs.date', '<=', formatDate($request->filter_date_end, 'd/m/Y', 'Y-m-d'));
                }
            })
            ->groupBy('employee_name')
            ->orderBy('employee_name', 'asc')
            ->get();

            $date = null;
            if ($request->filter_date_start) {
                $date['start'] = $request->filter_date_start;
            }
            if ($request->filter_date_end) {
                $date['end'] = $request->filter_date_end;
            }

            return view('admin.pages.reports.receipt', compact('worklogs', 'date'));
        }
    }
}
