<?php

namespace App\Service;

use Dompdf\Dompdf;
use Dompdf\Options;

class PdfService
{
    private $domPdf;

    public function __construct()
    {
        $this->domPdf = new Dompdf();

        // Permet de definir les option
        $pdfOptions = new Options();
        //exemple : la font de base (option disponible dans la documentation)
        $pdfOptions->set('defaultFont', 'Courrier');
        $this->domPdf->setPaper('A4', 'landscape');
        // $pdfOptions->set('defaultPapersize', );
        // dd($pdfOptions);
        //associe l'option au pdf
        $this->domPdf->setOptions($pdfOptions);


    }

    //fonction qui permet d'afficher le PDF dans le navigateur
    public function showPdfFile($html){

        //charger le code html
        $this->domPdf->loadHtml($html);
        //Render the HTML as PDF
        $this->domPdf->render();
        //Output the generated PDF to Browser
        $this->domPdf->stream("nomDuDdf.pdf",[
            //false pour l'afficher dans l'ecran
            'attachement'=> false
        ]);
    }

    //Genere un PDF binaire a attacher a un mail par rexemple, N'AFFICHE PAS DE PDF
    public function GenereUnPdfDinaire($html){

        $this->domPdf->loadHtml($html);
        $this->domPdf->render();
        $this->domPdf->output("nomdupdf.pdf",[
            'attachement'=> false
        ]);
    }
}