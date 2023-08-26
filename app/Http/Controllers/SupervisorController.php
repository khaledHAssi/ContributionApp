<?php

namespace App\Http\Controllers;

use App\Models\Supervisor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

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
                'user_image' => 'required|image|mimes:jpg,png|max:1024',
                'phone' => 'required|numeric|digits:12|',
            ]);
        $supervisor = new Supervisor();
        $supervisor->name  = $request->input('name');
        $supervisor->email = $request->input('email');
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
        if ($request->hasFile('user_image')) {
            if ($supervisor->user_image != null) {
                Storage::delete($supervisor->user_image);
            }
            $userImage = $request->file('user_image');
            $imageName = time() . '_image' . $supervisor->name . '.' . $userImage->getClientOriginalExtension();
            $userImage->storePubliclyAs('supervisors', $imageName, ['disk' => 'public']);
            $supervisor->user_image = 'supervisors/' . $imageName;
        }
        $saved =  $supervisor->save();
        if ($saved) {
            return redirect()->route('supervisors.index')->with('msg', 'تم التعديل بنجاح')->with('type', 'success');
        } else {
            return redirect()->back()->with('msg', 'فشل التعديل')->with('type', 'danger');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $supervisor = Supervisor::findOrFail($id);
        $deleted = $supervisor->delete();

        if ($deleted && $supervisor->user_image) {
            $ifDeleted = Storage::delete($supervisor->user_image);

            if ($ifDeleted) {
                return redirect()->route('supervisors.index')->with('msg', 'تم حذف المشرف')->with('type', 'success');
            } else {
                return redirect()->route('supervisors.index')->with('msg', 'فشل حذف المشرف')->with('type', 'danger');
            }
        }

        return redirect()->route('supervisors.index')->with('msg', 'تم حذف المشرف')->with('type', 'success');
    }
}
