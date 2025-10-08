<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

class PdfController extends Controller
{
    public function generatePdf()
    {
        $data = [
            'title' => 'Ejemplo de PDF',
            'content' => 'Este es un ejemplo de generación de PDF con DomPDF',
            'date' => now()->format('d/m/Y H:i:s')
        ];

        $pdf = Pdf::loadView('pdf.example', $data);
        
        return $pdf->download('ejemplo.pdf');
    }

    public function viewPdf()
    {
        $data = [
            'title' => 'Ejemplo de PDF',
            'content' => 'Este es un ejemplo de generación de PDF con DomPDF',
            'date' => now()->format('d/m/Y H:i:s')
        ];

        $pdf = Pdf::loadView('pdf.example', $data);
        
        return $pdf->stream('ejemplo.pdf');
    }
}
