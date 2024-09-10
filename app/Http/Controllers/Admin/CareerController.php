<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Services\Helpers\Punjabi;
use App\Mail\CareerMail;
use App\Models\Career;
use App\Models\HomeSetting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class CareerController extends Controller
{
    public function create()
    {
        return view('frontend.pages.career');
    }
    public function store(Request $request)
    {
        $request->validate([
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'required|email',
            'phone' => 'required|min:10|max:15',
            'status' => 'required',
            'dob' => 'required',
            'position' => 'required',
            'resume' => 'required|mimes:pdf,docx|max:2048',
            'address' => 'required',
            'city' => 'required',
            'pincode' => 'required',
            'province' => 'required',
        ]);
        $resume = '';
        if ($request->hasFile('resume')) {
            $folder = 'career-resume';
            $resume = Punjabi::upload($request->resume, $folder);
            $resume = 'storage/' . $resume;
        }
        $availability = '';
        if (!is_null($request->availability)) {
            foreach ($request->availability as $availabel) {
                $availability .= $availabel . ' ,';
            }
        }
        $career = Career::create([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'email' => $request->email,
            'phone' => $request->phone,
            'status' => $request->status,
            'dob' => $request->dob,
            'position' => $request->position,
            'city' => $request->city,
            'province' => $request->province,
            'address' => $request->address,
            'pincode' => $request->pincode,
            'resume' => $resume,
            'applied_at' => date('Y-m-d'),
            'availability' => $availability,
            'comments' => $request->comments,
        ]);
        $setting = HomeSetting::latest()->first();
        $emails = explode(',', $setting->admin_mails);
        if ($emails) {
            Mail::to($emails)->send(new CareerMail($career));
        }
        return back()->with('message', 'Applied successfully');
    }
    public function index()
    {
        $searchColumns = ['id', 'first_name', 'last_name', 'email', 'phone', 'city', 'pincode', 'position', 'status'];
        $search = request()->search;
        $order = request()->orderedColumn;
        $orderBy = request()->orderBy;
        $paginate = request()->paginate;
        $from_date = request()->from_date;
        $to_date = request()->to_date;
        $query = Career::query();
        if ($search != '') {
            $query->where(function ($q) use ($search, $searchColumns) {
                foreach ($searchColumns as $key => $value) ($key == 0) ? $q->where($value, 'LIKE', '%' . $search . '%') : $q->orWhere($value, 'LIKE', '%' . $search . '%');
            });
        }
        if ($from_date && $to_date) {
            $query->whereBetween('applied_at', [$from_date, $to_date]);
        } elseif ($from_date) {
            $query->whereDate('applied_at', $from_date);
        } elseif ($to_date) {
            $query->whereDate('applied_at', $to_date);
        }
        ($order == '') ? $query->orderByDesc('id') : $query->orderBy($order, $orderBy);
        $applicants = $paginate ? $query->paginate($paginate)->appends(request()->query()) : $query->paginate(10)->appends(request()->query());
        return  view('admin.career.index', compact('applicants'));
    }
    public function show($id)
    {
        $applicant = Career::find($id);
        return view('admin.career.details', compact('applicant'));
    }
}
