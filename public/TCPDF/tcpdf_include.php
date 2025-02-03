<?php

class MYPDF extends TCPDF
{
    // Property to hold header data
    protected $setCustomHeaderData;

    // Method to set custom header data
    public function setCustomHeaderData($data)
    {
        $this->setCustomHeaderData = $data;
    }

    //Page header
    public function Header()
    {
        // Logo
        $this->SetX(50); // Set x-coordinate
        $this->SetY(10); // Set y-coordinate

        $this->Image('TCPDF/DashboardLogo.png', 10, 8, 50, 0, 'PNG', '', '', false, 300, '', false, false, 0, false, false, false);

        // Define custom header HTML content
        $headerContent = '
            <table style="width: 100%;">
                <thead>
                    <tr>
                        <th width="40%"></th>
                        <th width="20%" align="center">
                            <div>'.$this->setCustomHeaderData['TitleMiddle'].'</div>
                        </th>
                        <th width="40%" align="right">
                            <span style="font-size: 9px;"><b>'.$this->setCustomHeaderData['TitleRight'].'</b></span>
                            <br>
                            <span style="font-size: 9px;">'.$this->setCustomHeaderData['Date'].'</span>
                        </th>
                    </tr>
                </thead>
            </table>
            <div style="border-top: 0.5px solid #000;"></div>
        ';

        // Output header HTML content with custom CSS styles
        $this->writeHTML($headerContent, true, false, true, false, '');
    }

    // Page footer
    public function Footer()
    {
        // Position at 15 mm from bottom
        $this->SetY(-15);
        // Set font
        $this->SetFont('helvetica', 'I', 8);
        // Page number
        $this->Cell(0, 10, 'Page '.$this->getAliasNumPage().'/'.$this->getAliasNbPages(), 0, false, 'C', 0, '', 0, false, 'T', 'M');
    }
}

// create new PDF document
$pdf = new MYPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
