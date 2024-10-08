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
use App\Mail\RequirementCreated;
use App\Mail\UserAssignmentMail;
use App\Mail\DevAssignmentMail;
use Illuminate\Support\Facades\Mail;

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
        } elseif ($currentUser->hasRole('User')) {
            $objetc = Requirement::where('user_id', $currentUser->id)->get();
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

            $adminEmails = User::role('Admin')->pluck('email')->toArray();
            // Envía el correo a los administradores
            try {
                Mail::to($adminEmails)->send(new RequirementCreated($requirement));
            } catch (\Exception $e) {
                \Log::error('Error al enviar el correo al admin: ' . $e->getMessage());
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
            $logInserted = false;
            
            if ($currentUser->hasRole('Dev')) {
                if ($request->has('status') && $requirement->status !== $request->status) {
                    $requirement->status = $request->status;
                    
                    $originalStatus = $this->getStatusName($requirement->getOriginal('status'));
                    $newStatus = $this->getStatusName($request->status);
                    
                    $description = 'El estado cambió de ' . $originalStatus . ' a ' . $newStatus;

                    if (!empty($request->description)) {
                        $description .= '. ' . trim($request->description);
                    }

                    if (!empty(trim($description)) && !$logInserted) {
                        TicketLog::create([
                            'requirement_id' => $requirement->id,
                            'user_id' => $currentUser->id,
                            'action' => 'Cambio de estado',
                            'description' => $description,
                        ]);
                        $logInserted = true;
                    }
                }
            }


            if ($currentUser->hasRole('Admin')) {
                if ($request->has('dev_user_id') && $requirement->dev_user_id !== $request->dev_user_id) {
                    $requirement->dev_user_id = $request->dev_user_id;
                    $requirement->save(); // Guarda los cambios
                    if (!$logInserted) {
                        TicketLog::create([
                            'requirement_id' => $requirement->id,
                            'user_id' => $currentUser->id,
                            'action' => 'Cambio de asignación',
                            'description' => 'El desarrollador asignado cambió a ' . User::find($request->dev_user_id)->name,
                        ]);
                        $logInserted = true;
                    }
            
                    $devUser = User::find($request->dev_user_id);
                    $ownerUser = User::find($requirement->user_id);

                    try {
                        Mail::to($devUser->email)->send(new DevAssignmentMail($requirement));
                    } catch (\Exception $e) {
                        \Log::error('Error al enviar el correo: ' . $e->getMessage());
                    }            
                    // Enviar correo al propietario de la solicitud
                    try {
                        Mail::to($ownerUser->email)->send(new UserAssignmentMail($requirement));
                    } catch (\Exception $e) {
                        \Log::error('Error al enviar el correo al propietario: ' . $e->getMessage());
                    }
                }
            }
            
            

            if ($request->has('logs')) {
                foreach ($request->logs as $logId => $logData) {
                    $log = TicketLog::findOrFail($logId);
                    if (isset($logData['description']) && !empty(trim($logData['description']))) {
                        $log->description = trim($logData['description']);
                        $log->save();
                    }
                }
            }

            if ($request->has('new_log') && !empty(trim($request->new_log['description']))) {
                $newLog = TicketLog::create([
                    'requirement_id' => $requirement->id,
                    'user_id' => $currentUser->id,
                    'action' => 'Nuevo log',
                    'description' => trim($request->new_log['description']),
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

    private function getStatusName($status)
    {
        switch ($status) {
            case 0:
                return 'Pendiente';
            case 1:
                return 'En progreso';
            case 2:
                return 'Finalizado';
            default:
                return 'Desconocido';
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
        } elseif ($currentUser->hasRole('User')) {
            $objetc = Requirement::where('user_id', $currentUser->id)->get();
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
