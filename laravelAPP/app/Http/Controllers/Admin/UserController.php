<?php

namespace App\Http\Controllers\Admin;

use App\Exports\UserExport;
use Maatwebsite\Excel\Facades\Excel;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUpdateUser;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    protected $repository;

    public function __construct(User $user)
    {
        $this->repository = $user;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = $this->repository->latest()->paginate();

        return view('admin.pages.users.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.pages.users.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreUpdateUser  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreUpdateUser $request)
    {
        $data = $request->all();

        $data['password'] = bcrypt($data['password']);

        if ($request->hasFile('picture') && $request->picture->isValid()) {
            $data['picture'] = $request->picture->store("users/");
        }

        $this->repository->create($data);

        return redirect()->route('users.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if (!$user = $this->repository->find($id)) {
            return redirect()->back();
        }

        return view('admin.pages.users.show', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (!$user = $this->repository->find($id)) {
            return redirect()->back();
        }

        return view('admin.pages.users.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\StoreUpdateUser  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(StoreUpdateUser $request, $id)
    {
        if (!$user = $this->repository->find($id)) {
            return redirect()->back();
        }
        $data = $request->only(['name', 'email', 'picture', 'status']);

        if ($request->password) {
            $data['password'] = bcrypt($request->password);
        }

        if ($request->hasFile('picture') && $request->picture->isValid()) {

            if (Storage::exists($user->picture)) {
                Storage::delete($user->picture);
            }

            $data['picture'] = $request->picture->store("users/");
        }

        $user->update($data);

        return redirect()->route('users.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (!$user = $this->repository->find($id)) {
            return redirect()->back();
        }

        if (Storage::exists($user->signature)) {
            Storage::delete($user->signature);
        }

        $user->delete();

        return redirect()->route('users.index');
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
        $users = $this->repository
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
            //return Excel::download(new UserExport($users), 'Usuarios.xlsx');
        }
        else
        {
            return view('admin.pages.users.index', compact('users', 'filters'));
        }


    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function profile($id)
    {
        if (!$user = $this->repository->find($id)) {
            return redirect()->route('admin.index');
        }

        return view('admin.pages.users.profile', compact('user'));
    }

}
