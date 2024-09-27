<?php

namespace App\Http\Controllers;

use App\Models\Area;
use App\Models\Requirement;
use App\Models\RequirementDetail;
use App\Models\TicketLog;
use App\Models\TicketLogDetail;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Spatie\Permission\Models\Role;

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
        $currentUser = auth()->user();

        if ($currentUser->hasRole('Admin')) {
            $objetc = Requirement::all();
        } elseif ($currentUser->hasRole('Dev')) {
            $objetc = Requirement::where('dev_user_id', $currentUser->id)->get();
        } else {
            $objetc = collect();
        }

        return view('requirement.index', [
            'objetc' => $objetc,
            'requirements' => $requirements,
            'currentUser' => $currentUser
        ]);
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
            $requirement->status = 0;
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
        $objetc = Requirement::with(['user', 'area', 'details', 'devUser'])->findOrFail($id);
        $logs = TicketLog::where('requirement_id', $id)->with('user')->get();
        $ticketLogDetails = TicketLogDetail::whereIn('ticket_id', $logs->pluck('id'))->get(); 
        $devUsers = User::role('Dev')->get();
        $currentUser = auth()->user();
        
        return view('requirement.edit', [
            'objetc' => $objetc,
            'logs' => $logs,
            'ticketLogDetails' => $ticketLogDetails,
            'devUsers' => $devUsers,
            'currentUser' => $currentUser
        ]);
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
            $requirement = Requirement::findOrFail($id);
            $currentUser = auth()->user();
    
            if ($currentUser->hasRole('Dev')) {
                if ($request->has('status') && $requirement->status !== $request->status) {
                    $requirement->status = $request->status;
                    TicketLog::create([
                        'requirement_id' => $requirement->id,
                        'user_id' => $currentUser->id,
                        'action' => 'Cambio de estado',
                        'description' => 'El estado cambió de ' . $requirement->getOriginal('status') . ' a ' . $request->status,
                    ]);
                }
            }
    
            if ($currentUser->hasRole('Admin')) {
                if ($request->has('dev_user_id') && $requirement->dev_user_id !== $request->dev_user_id) {
                    $requirement->dev_user_id = $request->dev_user_id;
                    TicketLog::create([
                        'requirement_id' => $requirement->id,
                        'user_id' => $currentUser->id,
                        'action' => 'Cambio de asignación',
                        'description' => 'El desarrollador asignado cambió a ' . User::find($request->dev_user_id)->name,
                    ]);
                }
            }
    
            if ($request->has('logs')) {
                foreach ($request->logs as $logId => $logData) {
                    $log = TicketLog::findOrFail($logId);
                    
                    // Actualizar la descripción del log
                    if (isset($logData['description'])) {
                        $log->description = $logData['description'];
                        $log->save();
                    }
                }
            }
    
            if ($request->has('new_log')) {
                $newLog = TicketLog::create([
                    'requirement_id' => $requirement->id,
                    'user_id' => $currentUser->id,
                    'action' => 'Nuevo log',
                    'description' => $request->new_log['description'],
                ]);

                if ($request->hasFile('files')) {
                    $files = $request->file('files');

                    foreach ($files as $file) {
                        $ticket_detail = new TicketLogDetail;
                        $ticket_detail->ticket_id = $newLog->id;
                        $filename = time() . '_' . $file->getClientOriginalName();
                        $filePath = $file->storeAs('files', $filename, 'public');
                        
                        $ticket_detail->files = $filePath;
                        $ticket_detail->save();
                    }
                }
            }
    
            // Guardar cambios en el requerimiento
            $requirement->save();
            DB::commit();
    
            return redirect()->route('requerimientos.index', $id)
                             ->with('mensaje', 'Actualización realizada con éxito.');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->route('requerimientos.edit', $id)
                             ->with('error', 'Error al actualizar. Inténtalo de nuevo.');
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

    public function tablero()
    {
        $requirements = Requirement::with(['user', 'area', 'devUser'])->get();
        $currentUser = auth()->user();

        if ($currentUser->hasRole('Admin')) {
            $objetc = Requirement::all();
        } elseif ($currentUser->hasRole('Dev')) {
            $objetc = Requirement::where('dev_user_id', $currentUser->id)->get();
        } else {
            $objetc = collect();
        }

        return view('requirement.tablero', [
            'objetc' => $objetc,
            'requirements' => $requirements,
            'currentUser' => $currentUser
        ]);
    }
}
