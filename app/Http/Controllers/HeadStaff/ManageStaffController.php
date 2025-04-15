<?php

namespace App\Http\Controllers\HeadStaff;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Exports\StaffExport;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class ManageStaffController extends Controller
{
    public function index()
    {
        $staff = User::where('role', 'staff')->latest()->paginate(10);
        return view('dashboard.head.manage-staff.index', compact('staff'));
    }

    public function create()
    {
        return view('dashboard.head.manage-staff.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:6|confirmed',
            'staff_province' => 'required|string|max:255',
        ]);

        User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
            'role' => 'staff',
            'staff_province' => $validated['staff_province'] ?? null
        ]);

        return redirect()->route('headstaff.staff.index')->with('success', 'Staff berhasil ditambahkan.');
    }

    public function edit(User $user)
    {
        if ($user->role !== 'staff') abort(404);
        return view('dashboard.head.manage-staff.edit', compact('user'));
    }

    public function update(Request $request, User $user)
    {
        if ($user->role !== 'staff') abort(404);

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'password' => 'nullable|string|min:6|confirmed',
            'staff_province' => 'required|string|max:255',
        ]);

        $user->name = $validated['name'];
        $user->email = $validated['email'];
        $user->staff_province = $validated['staff_province'] ?? null;

        if (!empty($validated['password'])) {
            $user->password = Hash::make($validated['password']);
        }

        $user->save();

        return redirect()->route('headstaff.staff.index')->with('success', 'Data staff diperbarui.');
    }

    public function destroy(User $user)
    {
        if ($user->role !== 'staff') abort(404);
        $user->delete();
        return redirect()->route('headstaff.staff.index')->with('success', 'Staff berhasil dihapus.');
    }

    public function export()
    {
        return Excel::download(new StaffExport, 'data-staff.xlsx');
    }
}
