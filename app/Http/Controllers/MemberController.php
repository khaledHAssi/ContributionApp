<?php

namespace App\Http\Controllers;

use App\Models\Member;
use App\Models\Supervisor;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\DB;

class MemberController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    public function master()
    {
        return view('master');
    }
    public function index()
    {
        $members = Member::all();
        $members = $members->load('supervisor');
        return response()->view('members.index', compact('members'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $supervisors = Supervisor::all();
        return view('members.create', compact('supervisors'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator =
            $request->validate([
                'job' => 'required|string|min:3',
                'name' => 'required|string|min:3|max:20|',
                'supervisor_id' => 'required|',
                'phone' => 'required|numeric|digits:12|',
                'identification_number' => 'required|numeric|digits:9|',
                'salary' => 'required|numeric',
                'contributions' => 'required|numeric',
                'birthday' => 'required|date',
            ]);
        $member = new Member;
        $member->name = $request->input('name');
        $member->supervisor_id = $request->input('supervisor_id');
        $member->type = $request->input('type');
        $member->job = $request->input('job');
        $member->phone = $request->input('phone');
        $member->identification_number = $request->input('identification_number');
        $member->salary = $request->input('salary');
        $member->contributions = $request->input('contributions');
        $member->birthday = $request->input('birthday');
        $saved = $member->save();
        if ($saved) {
            return redirect()->route('members.index')->with('msg', 'ثم إنشاء عضو بنجاح')->with('type', 'success');
        } else {
            return redirect()->back()->with('msg', 'لم يتم إنشاء عضو')->with('type', 'danger');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Member $member)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $member = Member::find($id);
        $members = Member::all();
        $members = $members->load('supervisor');
        $supervisors = DB::select('SELECT `id`, `name` , `email` FROM `supervisors`');
        return view('members.edit', compact('member', 'members', 'supervisors'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $validator =
            $request->validate([
                'job' => 'required|string|min:3',
                'name' => 'required|string|min:3|max:20|',
                'supervisor_id' => 'required|',
                'phone' => 'required|numeric|digits:12|',
                'identification_number' => 'required|numeric|digits:9|',
                'salary' => 'required|numeric',
                'contributions' => 'required|numeric',
                'birthday' => 'required|date',
            ]);
        $member = Member::findOrFail($id);
        $member->name = $request->input('name');
        $member->supervisor_id = $request->input('supervisor_id');
        $member->type = $request->input('type');
        $member->job = $request->input('job');
        $member->phone = $request->input('phone');
        $member->identification_number = $request->input('identification_number');
        $member->salary = $request->input('salary');
        $member->contributions = $request->input('contributions');
        $member->birthday = $request->input('birthday');
        $saved = $member->save();
        if ($saved) {
            return redirect()->route('members.index')->with('msg', 'ثم تحديث العضو بنجاح ')->with('type', 'success');
        } else {
            return redirect()->back()->with('msg', 'لم يتم التحديث ')->with('type', 'danger');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $member = Member::findOrFail($id);
        $deleted = $member->delete();
        if ($deleted) {
            return redirect()->back()->with('msg', 'ثم حذف العضو بنجاح')->with('type', 'success');
        } else {
            return redirect()->back()->with('msg', 'لم يتم حذف العضو')->with('type', 'danger');
        }
    }
}
