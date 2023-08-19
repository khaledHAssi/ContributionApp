<?php

namespace App\Http\Controllers;

use App\Models\Member;
use Illuminate\Http\Request;

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
        return response()->view('members.index', compact('members'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('members.create');
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
                'phone' => 'required|numeric|digits:12|',
                'identification_number' => 'required|numeric|digits:10|',
                'monthly_number' => 'required|numeric',
                'family_members_number' => 'required|numeric',
                'contributions' => 'required|numeric',
                'birthday' => 'required|date',
            ]);
        $member = new Member;
        $member->name = $request->input('name');
        $member->type = $request->input('type');
        $member->job = $request->input('job');
        $member->phone = $request->input('phone');
        $member->identification_number = $request->input('identification_number');
        $member->monthly_number = $request->input('monthly_number');
        $member->family_members_number = $request->input('family_members_number');
        $member->contributions = $request->input('contributions');
        $member->birthday = $request->input('birthday');
        $saved = $member->save();
        if ($saved) {
            return redirect()->route('members.index')->with('msg', 'Member Created Successfully')->with('type', 'success');
        } else {
            return redirect()->back()->with('msg', 'Member Create Failed')->with('type', 'danger');
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
        return view('members.edit', compact('member', 'members'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $validator =
            $request->validate([
                'job' => 'nullable|string|min:3',
                'name' => 'nullable|string|min:3|max:20|',
                'phone' => 'nullable|numeric|digits:12|',
                'identification_number' => 'nullable|numeric|digits:10|',
                'monthly_number' => 'nullable|numeric',
                'family_members_number' => 'nullable|numeric',
                'contributions' => 'nullable|numeric',
                'birthday' => 'nullable|date',
            ]);
        $member = Member::findOrFail($id);
        $member->name = $request->input('name');
        $member->type = $request->input('type');
        $member->job = $request->input('job');
        $member->phone = $request->input('phone');
        $member->identification_number = $request->input('identification_number');
        $member->monthly_number = $request->input('monthly_number');
        $member->family_members_number = $request->input('family_members_number');
        $member->contributions = $request->input('contributions');
        $member->birthday = $request->input('birthday');
        $saved = $member->save();
        if ($saved) {
            return redirect()->route('members.index')->with('msg', 'Member updated successfully')->with('type', 'success');
        } else {
            return redirect()->back()->with('msg', 'Member update Failed')->with('type', 'danger');
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
            return redirect()->back()->with('msg', 'Member deleted successfully')->with('type', 'success');
        } else {
            return redirect()->back()->with('msg', 'Member delete Failed')->with('type', 'danger');
        }
    }
}
