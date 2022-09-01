<?php

namespace VAVT\UP;

use TCPDF;
use TCPDF_FONTS;

class PDF extends TCPDF
{
    public function __construct($orientation = 'P', $unit = 'mm', $format = 'A4', $unicode = true, $encoding = 'UTF-8', $diskcache = false, $pdfa = false, $pageNumbers = true)
    {
        parent::__construct($orientation, $unit, $format, $unicode, $encoding, $diskcache, $pdfa);
        $this->fontname1 = TCPDF_FONTS::addTTFfont(__DIR__ . '/../../dist/fonts/PTSans-Bold.ttf', 'TrueTypeUnicode', '', 96);
        $this->fontname2 = TCPDF_FONTS::addTTFfont(__DIR__ . '/../../dist/fonts/PTSans-Italic.ttf', 'TrueTypeUnicode', '', 96);
        $this->fontname = TCPDF_FONTS::addTTFfont(__DIR__ . '/../../dist/fonts/PTSans-Regular.ttf', 'TrueTypeUnicode', '', 96);

        $this->setPDFVersion("1.4");
        $this->SetMargins(30, 10, 10);
        $this->SetAutoPageBreak(TRUE, 30);
        $this->pageNumbers = $pageNumbers;


        $this->SetFont($this->fontname1, '', 12);
        $this->SetFont($this->fontname2, '', 12);
        $this->SetFont($this->fontname, '', 12);


    }

    protected $last_page_flag = false;

    public function Close()
    {
        $this->last_page_flag = true;
        parent::Close();
    }

    //Page header
    public function Header()
    {
        // Logo
        //  $image_file = K_PATH_IMAGES.'logo_example.jpg';
        //  $this->Image($image_file, 10, 10, 15, '', 'JPG', '', 'T', false, 300, '', false, false, 0, false, false, false);
        // Set font
        //  $this->SetFont('helvetica', 'B', 20);
        // Title
        //  $this->Cell(0, 15, '<< TCPDF Example 003 >>', 0, false, 'C', 0, '', 0, false, 'M', 'M');
    }

    // Page footer
    public function Footer()
    {


        $this->SetY(-15);

        $this->SetFont($this->fontname, '', 8, '', false);

        $page = $this->PageNo();
        $tpages = $this->getNumPages();


        $txt = '<table ="100%" style="position: absolute">
                <tr><td style="text-align: center;
                               
                                font-size: 12pt;">';
        if ($this->page == 1) {
            $txt .= $this->page1footerhtml;
        } else {
            $txt .= trim($page);
        };

        $txt .= '</td></tr></table>';

        $this->writeHTML($txt, true, false, true, false, 'C');


    }
}
