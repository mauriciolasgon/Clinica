<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf as PDF;

class PdfController extends Controller
{
    public function generateAtestadoPdf(Request $request)
    {
        $data = $request->validate([
            'atestado' => 'required|string',
        ]);

        $pdf = PDF::loadView('pdf/pdfs', [
            'content' => $data['atestado'],
            'nome'=>'Atestados'    
    ]);

        return $pdf->stream('atestado.pdf');
    }

    public function generateEncaminhamentosPdf(Request $request)
    {
        $data = $request->validate([
            'encaminhamentos' => 'required|string',
        ]);

        $pdf = PDF::loadView('pdf/pdfs', ['content' => $data['encaminhamentos'],
        'nome'=>'Encaminhamentos'    
    ]);

        return $pdf->stream('encaminhamentos.pdf');
    }
}
