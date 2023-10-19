<?php

namespace App\Http\Controllers;

use App\Models\Permit;
use Illuminate\Http\Request;
use App\Models\InformationPermit;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class PermitController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $permits = Auth::user()->hasrole('Wakasek') || Auth::user()->hasRole('Admin') ?
                        Permit::latest()->get() : Permit::whereNoId(Auth::user()->no_id)->get();

        $information_permits = InformationPermit::latest()->get();

        return view('permit.permit', [
            'title' => 'Perizinan',
            'permits' => $permits,
            'information_permits' => $information_permits,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'date' => 'required|date',
            'permit_document' => 'required|file',
            'classroom_document' => 'nullable|file',
            'information_permit_id' => 'required|numeric'
        ]);

        if($validator->fails()){
            return back()->with('error', 'There was a problem adding.');
        }

        $validated = $validator->validated();

        if($request->file('permit_document')){
            $path = $request->file('permit_document')->store('file_uploads');
            $validated['permit_document'] = $path;
        }

        if($request->file('classroom_document')){
            $path = $request->file('classroom_document')->store('file_uploads');
            $validated['classroom_document'] = $path;
        }

        $validated['no_id'] = Auth::user()->no_id;

        Permit::create($validated);

        return back();
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $permit = Permit::findOrFail($id);

        $rules = [
            'date' => 'required|date',
            'information_permit_id' => 'required|numeric'
        ];

        if($request->file('permit_document')){
            $rules['permit_document'] = 'required|file';
        }

        if($request->file('classroom_document')){
            $rules['classroom_document'] = 'nullable|file';
        }

        $validator = Validator::make($request->all(), $rules);

        if($validator->fails()){
            return back()->with('error', 'There was a problem making the change.');
        }

        $validated = $validator->validated();

        if($request->file('permit_document')){
            Storage::delete($permit->permit_document);
            $path = $request->file('permit_document')->store('file_uploads');

            $validated['permit_document'] = $path;
        }

        if($request->file('classroom_document')){
            Storage::delete($permit->classroom_document);
            $path = $request->file('classroom_document')->store('file_uploads');

            $validated['classroom_document'] = $path;
        }

        $permit->update($validated);

        return back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $permit = Permit::findOrFail($id);

        if($permit->permit_document){
            Storage::delete($permit->permit_document);
        }

        if($permit->classroom_document){
            Storage::delete($permit->classroom_document);
        }

        $permit->delete();

        return back();
    }

    public function approve(string $id)
    {
        $permit = Permit::findOrFail($id);

        $permit->update(['status_permit' => 'Approve']);

        return back();
    }
}
