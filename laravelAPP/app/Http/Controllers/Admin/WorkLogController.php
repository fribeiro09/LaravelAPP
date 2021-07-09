<?php

namespace App\Http\Controllers\Admin;

use App\Exports\WorkLogExport;
use Maatwebsite\Excel\Facades\Excel;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUpdateWorkLog;
use App\Models\Employee;
use App\Models\WorkLog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class WorkLogController extends Controller
{
    private $repository;

    public function __construct(WorkLog $worklog)
    {
        $this->repository = $worklog;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $employees = Employee::all()->sortBy("name");
        $worklogs = $this->repository->with('employee')->latest()->paginate();

        return view('admin.pages.worklogs.index', compact('worklogs','employees'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $employees = Employee::all()->sortBy("name");
        return view('admin.pages.worklogs.create', compact('employees'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreUpdateWorkLog  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreUpdateWorkLog $request)
    {
        $data = $request->all();

        $data['date'] = formatDate($data['date'], 'd/m/Y', 'Y-m-d');

        $this->repository->create($data);

        return redirect()->route('worklogs.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if (!$worklog = $this->repository->find($id)) {
            return redirect()->back();
        }

        return view('admin.pages.worklogs.show', compact('worklog'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $employees = Employee::all()->sortBy("name");
        if (!$worklog = $this->repository->find($id)) {
            return redirect()->back();
        }

        $worklog['date'] = formatDate($worklog['date'], 'Y-m-d', 'd/m/Y');

        return view('admin.pages.worklogs.edit', compact('worklog','employees'));
    }


    /**
     * Update register by id
     *
     * @param  \App\Http\Requests\StoreUpdateWorkLog  $request
     * @param  int  $id
     *
     * @return \Illuminate\Http\Response
     */
    public function update(StoreUpdateWorkLog $request, $id)
    {
        if (!$worklog = $this->repository->find($id)) {
            return redirect()->back();
        }

        $data = $request->all();

        $data['date'] = formatDate($data['date'], 'd/m/Y', 'Y-m-d');

        $worklog->update($data);

        return redirect()->route('worklogs.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        return redirect()->route('worklogs.index');

        if (!$worklog = $this->repository->find($id)) {
            return redirect()->back();
        }

        if (Storage::exists($worklog->logo)) {
            Storage::delete($worklog->logo);
        }

        $worklog->delete();

        return redirect()->route('worklogs.index');
    }


    /**
     * Search results
     *
     * @param  Request $request
     * @return \Illuminate\Http\Response
     */
    public function search(Request $request)
    {
        $qtd = 15;
        if (isset($_POST['export'])) {
            $qtd = 100000;
        }
        $employees = Employee::all()->sortBy("name");
        $filters = $request->only('filter_employee', 'filter_date');
        $worklogs = $this->repository
                            ->where(function($query) use ($request) {
                                if ($request->filter_employee) {
                                    $query->Where('employee_id', $request->filter_employee);
                                }
                            })->where(function($query) use ($request) {
                                if ($request->filter_date) {
                                    $query->Where('date', formatDate($request->filter_date, 'd/m/Y', 'Y-m-d'));
                                }
                            })
                            ->latest()
                            ->paginate($qtd);
        if (isset($_POST['export']))
        {
            //return Excel::download(new WorkLogExport($worklogs), 'Empresas.xlsx');
        }
        else
        {
            return view('admin.pages.worklogs.index', compact('worklogs','employees','filters'));
        }
    }
}
