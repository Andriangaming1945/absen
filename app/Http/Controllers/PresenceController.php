<?php

namespace App\Http\Controllers;

use App\Imports\PresenceImport;
use App\Models\Presence;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Maatwebsite\Excel\Facades\Excel;

class PresenceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if($request->from_filter && $request->until_filter){
            $presences = Presence::orderBy('date', 'desc')->whereBetween('date', [$request->from_filter, $request->until_filter])->get();
        } else {
            $presences = Presence::orderBy('date', 'desc')->get();
        }

        return view('presence', [
            'title' => 'Presence',
            'presences' => $presences
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
            'presences' => 'required|file'
        ]);

        if($validator->fails()){
            return  back()->with('error', 'There was a problem adding.');
        }

        $validator->validated();

        if($request->file('presences')){
            $excel = $request->file('presences')->store('file_uploads');

            Excel::import(new PresenceImport(), $excel);

            Storage::delete($excel);

            return back();
        }

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
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
