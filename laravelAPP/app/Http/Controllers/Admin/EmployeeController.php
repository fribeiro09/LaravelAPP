<?php

namespace App\Http\Controllers\Admin;

use App\Exports\EmployeeExport;
use Maatwebsite\Excel\Facades\Excel;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUpdateEmployee;
use App\Models\Employee;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class EmployeeController extends Controller
{
    private $repository;

    public function __construct(Employee $employee)
    {
        $this->repository = $employee;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $employees = $this->repository->latest()->paginate();

        return view('admin.pages.employees.index', compact('employees'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.pages.employees.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreUpdateEmployee  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreUpdateEmployee $request)
    {
        $data = $request->all();

        if ($request->hasFile('picture') && $request->picture->isValid()) {
            $data['picture'] = $request->picture->store("employees/");
        }

        $this->repository->create($data);

        return redirect()->route('employees.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if (!$employee = $this->repository->find($id)) {
            return redirect()->back();
        }

        return view('admin.pages.employees.show', compact('employee'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (!$employee = $this->repository->find($id)) {
            return redirect()->back();
        }

        return view('admin.pages.employees.edit', compact('employee'));
    }


    /**
     * Update register by id
     *
     * @param  \App\Http\Requests\StoreUpdateEmployee  $request
     * @param  int  $id
     *
     * @return \Illuminate\Http\Response
     */
    public function update(StoreUpdateEmployee $request, $id)
    {
        if (!$employee = $this->repository->find($id)) {
            return redirect()->back();
        }

        $data = $request->all();

        if ($request->hasFile('picture') && $request->picture->isValid()) {

            if (Storage::exists($employee->picture)) {
                Storage::delete($employee->picture);
            }

            $data['picture'] = $request->picture->store("employees/");
        }

        $employee->update($data);

        return redirect()->route('employees.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        return redirect()->route('employees.index');

        if (!$employee = $this->repository->find($id)) {
            return redirect()->back();
        }

        if (Storage::exists($employee->logo)) {
            Storage::delete($employee->logo);
        }

        $employee->delete();

        return redirect()->route('employees.index');
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

        $filters = $request->only('filter_name', 'filter_status');
        $employees = $this->repository
                            ->where(function($query) use ($request) {
                                if ($request->filter_name) {
                                    $query->Where('name', 'LIKE', "%{$request->filter_name}%");
                                }
                            })->where(function($query) use ($request) {
                                if ($request->filter_status) {
                                    $query->Where('status', $request->filter_status);
                                }
                            })
                            ->latest()
                            ->paginate($qtd);
        if (isset($_POST['export']))
        {
            //return Excel::download(new EmployeeExport($employees), 'Empresas.xlsx');
        }
        else
        {
            return view('admin.pages.employees.index', compact('employees', 'filters'));
        }
    }
}
