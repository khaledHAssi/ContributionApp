<?php

namespace App\Http\Controllers;

use App\Models\Supervisor;
use Illuminate\Http\Request;

class SupervisorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $supervisors = Supervisor::all();
        return response()->view('supervisors.index', compact('supervisors'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view('supervisors.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $validator =
            $request->validate([
                'name' => 'required|string|min:3|max:20|',
                'email' => 'required|string ',
                'user_image' => 'nullable|image|mimes:jpg,png|max:1024',
                'phone' => 'required|numeric|digits:12|',
            ]);
        $supervisor = new Supervisor();
        $supervisor->name  = $request->input('name');
        $supervisor->email = $request->input('email');
        $supervisor->user_image = $request->input('user_image');
        $supervisor->phone = $request->input('phone');
        if ($request->hasFile('user_image')) {
            $userImage = $request->file('user_image');
            $imageName = time() . '_image' . $supervisor->name . '.' . $userImage->getClientOriginalExtension();
            $userImage->storePubliclyAs('supervisors', $imageName, ['disk' => 'public']);
            $supervisor->user_image = 'supervisors/' . $imageName;
        }
        $saved =  $supervisor->save();

        if ($saved) {
            return redirect()->route('supervisors.index')->with('msg', 'Supervisor Created Successfully')->with('type', 'success');
        } else {
            return redirect()->back()->with('msg', 'Supervisor Create Failed')->with('type', 'danger');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Supervisor $supervisor)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        //
        $supervisor = Supervisor::findOrFail($id);

        return view('supervisors.edit', compact('supervisor'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        //
        $validator =
            $request->validate([
                'name' => 'required|string|min:3|max:20|',
                'email' => 'required|string ',
                'user_image' => 'nullable|image|mimes:jpg,png|max:1024',
                'phone' => 'required|numeric|digits:12|',
            ]);
        $supervisor = Supervisor::findOrFail($id);
        $supervisor->name  = $request->input('name');
        $supervisor->email = $request->input('email');
        $supervisor->user_image = $request->input('user_image');
        $supervisor->phone = $request->input('phone');

        $saved =  $supervisor->save();
        if ($saved) {
            return redirect()->route('supervisors.index')->with('msg', 'Supervisor updated Successfully')->with('type', 'success');
        } else {
            return redirect()->back()->with('msg', 'Supervisor update Failed')->with('type', 'danger');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        //

    }
}
