<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class AdminController extends Controller
{
    public function index()
    {
        $searchColumns = ['id', 'name', 'email'];
        $search = request()->search;
        $order = request()->orderedColumn;
        $orderBy = request()->orderBy;
        $paginate = request()->paginate;
        $query = Admin::query();
        if ($search != '') {
            $query->where(function ($q) use ($search, $searchColumns) {
                foreach ($searchColumns as $key => $value) ($key == 0) ? $q->where($value, 'LIKE', '%' . $search . '%') : $q->orWhere($value, 'LIKE', '%' . $search . '%');
            });
        }
        ($order == '') ? $query->orderByDesc('id') : $query->orderBy($order, $orderBy);
        $admins = $paginate ? $query->paginate($paginate)->appends(request()->query()) : $query->paginate(10)->appends(request()->query());
        return view('admin.users.index', compact('admins'));
    }
    public function create()
    {
        return view('admin.users.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|unique:admins',
            'password' => 'required',
            'conf_password' => 'required|same:password',
        ]);
        Admin::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);
        return redirect()->route('admin.users')->with('message', 'User added successfully');
    }

    public function edit($id)
    {
        $admin = Admin::find($id);
        return view('admin.users.update', compact('admin'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name'  => 'required',
            'email' => [
                'required',
                $this->uniqueExcept('admins', 'email', $id),
            ],
        ]);
        $admin = Admin::find($id);
        if ($request->password) {
            $request->validate([
                'conf_password' => 'required|same:password',
            ]);
            $admin->password = Hash::make($request->password);
        }
        $admin->name = $request->name;
        $admin->email = $request->email;
        $admin->save();
        return redirect()->route('admin.users')->with('message', 'User updated successfully');
    }
    protected function uniqueExcept($table, $column, $id)
    {
        return Rule::unique($table, $column)->ignore($id);
    }
    public function destroy($id)
    {
        Admin::destroy($id);
        return back()->with('message', 'User deleted successfully');
    }
}
