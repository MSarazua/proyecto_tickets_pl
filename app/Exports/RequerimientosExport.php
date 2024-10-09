<?php
namespace App\Exports;

use App\Models\Requirement;
use Maatwebsite\Excel\Concerns\FromCollection;

class RequerimientosExport implements FromCollection
{
    protected $start_date;
    protected $end_date;

    public function __construct($start_date, $end_date)
    {
        $this->start_date = $start_date;
        $this->end_date = $end_date;
    }

    public function collection()
    {
        // Filtra los requerimientos por el rango de fechas
        return Requirement::whereBetween('created_at', [$this->start_date, $this->end_date])->get();
    }
}
