<?php

namespace App\Http\Controllers;

use App\Models\Area;
use App\Models\Requirement;
use App\Models\RequirementDetail;
use App\Models\User;
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
        $requirements = Requirement::with(['user', 'area', 'devUser'])->get();
        $objetc = Requirement::all();
        return view('requirement.index', ['objetc' => $objetc, 'requirements' => $requirements]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $objetc = Area::all();
        return view('requirement.create', ['objetc' => $objetc]);
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
            // Crea un nuevo registro en Requirement
            $requirement = new Requirement;
            $requirement->user_id = $request->user_id;
            $requirement->requirement_title = $request->requirement_title;
            $requirement->area_id = $request->area;
            $requirement->priority = $request->priority;
            $requirement->description = $request->description;
            $requirement->references = $request->references;
            $requirement->save();

            // Guarda archivos si existen
            if ($request->hasFile('files')) {
                $files = $request->file('files');

                foreach ($files as $file) {
                    $requirement_detail = new RequirementDetail;
                    $requirement_detail->requirement_id = $requirement->id;

                    // Usa el nombre original del archivo
                    $filename = time() . '_' . $file->getClientOriginalName();
                    $filePath = $file->storeAs('files', $filename, 'public');
                    
                    $requirement_detail->files = $filePath;
                    $requirement_detail->save();
                }
            }

            DB::commit();
            return redirect()->action([RequirementsController::class, 'index'])->with(['mensaje' => 'Solicitud enviada con éxito']);
        } catch (\Illuminate\Database\QueryException $e) {
            DB::rollBack();
            dd($e);
            abort(500, $e->errorInfo[2]);
            return response()->json($response, 500);
        }
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
        $objetc = Requirement::find($id);
        $requirements = Requirement::with(['user', 'area', 'details', 'devUser'])->get();
        $devUsers = User::role('Dev')->get();
        // Obtener el rol del usuario
        $currentUser = auth()->user();
        return view('requirement.edit', ['objetc' => $objetc, 'requirements' => $requirements, 'devUsers' => $devUsers, 'currentUser' => $currentUser]);
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
        DB::beginTransaction();

        try {
            // Encuentra el requerimiento por ID
            $requirement = Requirement::findOrFail($id);

            if ($request->has('dev_user_id')) {
                $requirement->dev_user_id = $request->dev_user_id;
                $requirement->save();
            }

            DB::commit();
            return redirect()->route('requerimientos.index', $id)
                            ->with('mensaje', 'Desarrollador asignado con éxito.');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->route('requerimientos.edit', $id)
                            ->with('error', 'Error al asignar desarrollador. Inténtalo de nuevo.');
        }
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
