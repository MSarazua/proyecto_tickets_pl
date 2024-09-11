<?php

namespace App\Http\Controllers;

use App\Models\Requirement;
use App\Models\RequirementDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class RequirementsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('requirement.create');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('requirement.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        DB::beginTransaction();
        try {
            $requirement = new Requirement;
            $requirement->user_id = $request->user_id;
            $requirement->requirement_title = $request->requirement_title;
            $requirement->area = $request->area;
            $requirement->priority = $request->priority;
            $requirement->description = $request->description;
            $requirement->references = $request->references;
            $requirement->save();
            $requirement_detail = new RequirementDetail;
            $requirement_detail->requirement_id = $requirement->id;
            if ($request->hasFile('files')) {
                $requirement_detail->files = $request->file('files')->store('public');
            }
            $requirement_detail->save();
        } catch (\Illuminate\Database\QueryException $e) {
            DB::rollBack();
            dd($e);
            abort(500, $e->errorInfo[2]);
            return response()->json($response, 500);
        }
        DB::commit();
        return redirect()->action([RequirementsController::class, 'index'])->with(['mensaje' => 'Solicitud enviada con éxito']);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
