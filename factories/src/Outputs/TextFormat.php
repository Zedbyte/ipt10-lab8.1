<?php

namespace App\Outputs;

use App\Outputs\ProfileFormatter;

class TextFormat implements ProfileFormatter
{
    private $response;

    public function setData($profile)
    {
        $contact = $profile->getContactDetails();
        $education = $profile->getEducation();

        // Construct output text
        $output = <<<TEXT
            Full Name: {$profile->getFullName()}
            Email: {$contact['email']}
            Phone: {$contact['phone_number']}
            Address: {$this->formatAddress($contact['address'])}
            Education: {$education['degree']} at {$education['university']}
            Skills: {$this->formatList($profile->getSkills())}

            Experience:
            {$this->formatJobs($profile->getExperience())}

            Certifications:
            {$this->formatCertifications($profile->getCertifications())}

            Extra-Curricular Activities:
            {$this->formatActivities($profile->getExtracurricularActivities())}

            Languages:
            {$this->formatLanguages($profile->getLanguages())}

            References:
            {$this->formatReferences($profile->getReferences())}
        TEXT;

        $this->response = $output;
    }

    public function render()
    {
        header('Content-Type: text/plain');
        return $this->response;
    }

    private function formatAddress($address)
    {
        return implode(", ", $address);
    }

    private function formatList($items)
    {
        return implode(", ", $items);
    }

    private function formatJobs($jobs)
    {
        $output = '';
        foreach ($jobs as $job) {
            $output .= "- {$job['job_title']} at {$job['company']} ({$job['start_date']} to {$job['end_date']})\n";
        }
        return $output;
    }

    private function formatCertifications($certifications)
    {
        $output = '';
        foreach ($certifications as $cert) {
            $output .= "- {$cert['name']} ({$cert['date_earned']})\n";
        }
        return $output;
    }

    private function formatActivities($activities)
    {
        $output = '';
        foreach ($activities as $activity) {
            $output .= "- Role: {$activity['role']} Organization: {$activity['organization']} (Start: {$activity['start_date']} End: {$activity['end_date']})\n";
            $output .= "  Description: {$activity['description']}\n";
        }
        return $output;
    }

    private function formatLanguages($languages)
    {
        $output = '';
        foreach ($languages as $lang) {
            $output .= "- {$lang['language']} ({$lang['proficiency']})\n";
        }
        return $output;
    }

    private function formatReferences($references)
    {
        $output = '';
        foreach ($references as $ref) {
            $output .= "- Name: {$ref['name']} Position: {$ref['position']} (Company: {$ref['company']} Email: {$ref['email']})\n";
            $output .= "  Phone Number: {$ref['phone_number']}\n";
        }
        return $output;
    }
}
