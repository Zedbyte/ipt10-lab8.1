<?php

namespace App\Outputs;

use App\Outputs\ProfileFormatter;
use Fpdf\Fpdf;

class PDFFormat implements ProfileFormatter
{
    private $pdf;

    public function setData($profile)
    {
        $this->pdf = new Fpdf();
        $this->pdf->AddPage();
        
        // Set title
        $this->pdf->SetFont('Arial', 'B', 16);
        $this->pdf->Cell(0, 10, 'Profile of ' . $profile->getFullName(), 0, 1, 'C');

        $this->pdf->SetFont('Arial', '', 12);
        
        // Contact Information
        $this->pdf->Cell(0, 10, 'Email: ' . $profile->getContactDetails()['email'], 0, 1);
        $this->pdf->Cell(0, 10, 'Phone: ' . $profile->getContactDetails()['phone_number'], 0, 1);
        
        // Address
        $address = implode(", ", $profile->getContactDetails()['address']);
        $this->pdf->Cell(0, 10, 'Address: ' . $address, 0, 1);
        
        // Education
        $this->pdf->Cell(0, 10, 'Education: ' . $profile->getEducation()['degree'] . ' at ' . $profile->getEducation()['university'], 0, 1);
        
        // Skills
        $this->pdf->Cell(0, 10, 'Skills: ', 0, 1);
        foreach ($profile->getSkills() as $skill) {
            $this->pdf->Cell(0, 10, '- ' . $skill, 0, 1);
        }

        // Experience
        $this->pdf->Cell(0, 10, 'Experience:', 0, 1);
        foreach ($profile->getExperience() as $job) {
            $this->pdf->Cell(0, 10, '- ' . $job['job_title'] . ' at ' . $job['company'] . ' (' . $job['start_date'] . ' to ' . $job['end_date'] . ')', 0, 1);
        }

        // Certifications
        $this->pdf->Cell(0, 10, 'Certifications:', 0, 1);
        foreach ($profile->getCertifications() as $cert) {
            $this->pdf->Cell(0, 10, '- ' . $cert['name'] . ' (' . $cert['date_earned'] . ')', 0, 1);
        }

        // Extra-Curricular Activities
        $this->pdf->Cell(0, 10, 'Extra-Curricular Activities:', 0, 1);
        foreach ($profile->getExtracurricularActivities() as $extra) {
            $this->pdf->Cell(0, 10, '- Role: ' . $extra['role'] . ' Organization: ' . $extra['organization'], 0, 1);
            $this->pdf->Cell(0, 10, '  Description: ' . $extra['description'], 0, 1);
            $this->pdf->Cell(0, 10, '  Start: ' . $extra['start_date'] . ' End: ' . $extra['end_date'], 0, 1);
        }

        // Languages
        $this->pdf->Cell(0, 10, 'Languages:', 0, 1);
        foreach ($profile->getLanguages() as $lang) {
            $this->pdf->Cell(0, 10, '- ' . $lang['language'] . ' (' . $lang['proficiency'] . ')', 0, 1);
        }

        // References
        $this->pdf->Cell(0, 10, 'References:', 0, 1);
        foreach ($profile->getReferences() as $ref) {
            $this->pdf->Cell(0, 10, '- Name: ' . $ref['name'] . ' Position: ' . $ref['position'], 0, 1);
            $this->pdf->Cell(0, 10, '  Company: ' . $ref['company'] . ' Email: ' . $ref['email'], 0, 1);
            $this->pdf->Cell(0, 10, '  Phone: ' . $ref['phone_number'], 0, 1);
        }
    }

    public function render()
    {
        // Output PDF to browser or save to file
        return $this->pdf->Output();
    }
}