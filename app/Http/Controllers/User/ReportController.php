<?php

namespace App\Http\Controllers\User;

use Illuminate\Support\Facades\Storage;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Report;
use Illuminate\Support\Facades\Auth;

class ReportController extends Controller
{
    use AuthorizesRequests;

    public function create()
    {
        return view('dashboard.user.reports.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'description' => 'required|string',
            'type' => 'required|in:KEJAHATAN,PEMBANGUNAN,SOSIAL',
            'province' => 'required',
            'regency' => 'required',
            'subdistrict' => 'required',
            'village' => 'required',
            'image' => 'required|image|max:2048',
        ]);

        $path = $request->file('image')->store('reports', 'public');

        Report::create([
            'user_id' => Auth::id(),
            'description' => $validated['description'],
            'type' => $validated['type'],
            'province' => $validated['province'],
            'regency' => $validated['regency'],
            'subdistrict' => $validated['subdistrict'],
            'village' => $validated['village'],
            'voting' => json_encode([]),
            'image' => $path,
        ]);

        return redirect()->route('dashboard.user')->with('success', 'Laporan berhasil dibuat.');
    }

    public function show(Report $report)
    {
        $report->load(['user', 'likes', 'comments.user', 'progress.staff']);
        $report->increment('views');

        $comments = $report->comments()->latest()->paginate(5);
        return view('dashboard.user.reports.show', compact('report', 'comments'));
    }

    public function edit(Report $report)
    {
        $this->authorize('update', $report); // pastikan user pemiliknya
        return view('dashboard.user.reports.edit', compact('report'));
    }

    public function update(Request $request, Report $report)
    {
        $this->authorize('update', $report);

        $request->validate([
            'type' => 'required|string',
            'description' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'province' => 'required|string',
            'regency' => 'required|string',
            'subdistrict' => 'required|string',
            'village' => 'required|string',
        ]);

        if ($request->hasFile('image')) {
            if ($report->image) {
                Storage::delete('public/' . $report->image);
            }
            $image = $request->file('image')->store('reports', 'public');
            $report->image = $image;
        }

        $report->update($request->only([
            'type', 'description', 'province', 'regency', 'subdistrict', 'village'
        ]));

        return redirect()->route('dashboard.user')->with('success', 'Laporan berhasil diperbarui.');
    }

    public function destroy(Report $report)
    {
        $this->authorize('delete', $report);

        if ($report->image) {
            Storage::delete('public/' . $report->image);
        }

        $report->delete();

        return redirect()->route('dashboard.user')->with('success', 'Laporan berhasil dihapus.');
    }

    public function toggleLike(Report $report)
    {
        $user = auth()->user();

        if ($report->isLikedBy($user)) {
            $report->likes()->where('user_id', $user->id)->delete();
        } else {
            $report->likes()->create(['user_id' => $user->id]);
        }

        return back();
    }

    public function manage(Request $request)
    {
        $query = Report::query()->where('user_id', auth()->id());

        // Filter berdasarkan tipe laporan
        if ($request->filled('type')) {
            $query->where('type', $request->type);
        }

        // Filter berdasarkan status
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        $reports = $query->orderByDesc('created_at')->get()->groupBy(function ($report) {
            return \Carbon\Carbon::parse($report->created_at)->translatedFormat('d F Y');
        });

        return view('dashboard.user.reports.manage', compact('reports'));
    }

}
