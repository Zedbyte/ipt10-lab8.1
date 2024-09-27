<?php

namespace App\Outputs;

use App\Outputs\ProfileFormatter;

class HTMLFormat implements ProfileFormatter
{
    private $response;

    public function setData($profile)
    {
        $fullName = $profile->getFullName();
        $contact = $profile->getContactDetails();
        $education = $profile->getEducation();
        
        // Start HTML structure
        $output = <<<HTML
            <html>
                <head>
                    <title>Profile of {$fullName}</title>
                </head>
                <body>
                    <h1>Profile of {$fullName}</h1>

                    <p><strong>Email:</strong> {$contact['email']}</p>
                    <p><strong>Phone:</strong> {$contact['phone_number']}</p>
                    <p><strong>Address:</strong> {$this->formatAddress($contact['address'])}</p>

                    <p><strong>Education:</strong> {$education['degree']} at {$education['university']}</p>

                    <h2>Skills</h2>
                    {$this->formatList($profile->getSkills())}

                    <h2>Experience</h2>
                    {$this->formatJobs($profile->getExperience())}

                    <h2>Certifications</h2>
                    {$this->formatCertifications($profile->getCertifications())}

                    <h2>Extra-Curricular Activities</h2>
                    {$this->formatActivities($profile->getExtracurricularActivities())}

                    <h2>Languages</h2>
                    {$this->formatLanguages($profile->getLanguages())}

                    <h2>References</h2>
                    {$this->formatReferences($profile->getReferences())}
                </body>
            </html>
        HTML;

        $this->response = $output;
    }

    public function render()
    {
        header('Content-Type: text/html');
        return $this->response;
    }

    private function formatAddress($address)
    {
        return implode(", ", $address);
    }

    private function formatList($items)
    {
        $output = '<ul>';
        foreach ($items as $item) {
            $output .= "<li>{$item}</li>";
        }
        return $output . '</ul>';
    }

    private function formatJobs($jobs)
    {
        $output = '<ul>';
        foreach ($jobs as $job) {
            $output .= "<li>{$job['job_title']} at {$job['company']} ({$job['start_date']} to {$job['end_date']})</li>";
        }
        return $output . '</ul>';
    }

    private function formatCertifications($certifications)
    {
        $output = '<ul>';
        foreach ($certifications as $cert) {
            $output .= "<li>{$cert['name']} ({$cert['date_earned']})</li>";
        }
        return $output . '</ul>';
    }

    private function formatActivities($activities)
    {
        $output = '<ul>';
        foreach ($activities as $activity) {
            $output .= <<<HTML
                <li>
                    <strong>Role:</strong> {$activity['role']} at {$activity['organization']} ({$activity['start_date']} to {$activity['end_date']})<br>
                    <strong>Description:</strong> {$activity['description']}
                </li>
            HTML;
        }
        return $output . '</ul>';
    }

    private function formatLanguages($languages)
    {
        $output = '<ul>';
        foreach ($languages as $lang) {
            $output .= "<li>{$lang['language']} ({$lang['proficiency']})</li>";
        }
        return $output . '</ul>';
    }

    private function formatReferences($references)
    {
        $output = '<ul>';
        foreach ($references as $ref) {
            $output .= <<<HTML
                <li>
                    <strong>Name:</strong> {$ref['name']}<br>
                    <strong>Position:</strong> {$ref['position']}<br>
                    <strong>Company:</strong> {$ref['company']}<br>
                    <strong>Email:</strong> {$ref['email']}<br>
                    <strong>Phone:</strong> {$ref['phone_number']}
                </li>
            HTML;
        }
        return $output . '</ul>';
    }
}
