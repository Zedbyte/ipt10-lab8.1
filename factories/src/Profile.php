<?php

namespace App;

class Profile
{
    private $name;
    private $contactInformation;
    private $education;
    private $skills = [];
    private $experience = [];
    private $certifications = [];
    private $extracurricularActivities = [];
    private $languages = [];
    private $references = [];

    public function __construct($data = null)
    {
        // Map the data to the class properties
        if (isset($data['personal_information'])) {
            $info = $data['personal_information'];

            $this->name = $info['name'];
            $this->contactInformation = $info['contact_information'];
            $this->education = $info['education'];
            $this->skills = $info['skills'];
            $this->experience = $info['experience'];
            $this->certifications = $info['certifications'];
            $this->extracurricularActivities = $info['extracurricular_activities'];
            $this->languages = $info['languages'];
            $this->references = $info['references'];
        }
    }

    public function getFullName()
    {
        return $this->name['first_name'] . ' ' . $this->name['middle_initial'] . '. ' . $this->name['last_name'];
    }

    public function getContactDetails()
    {
        return $this->contactInformation;
    }

    public function getEducation()
    {
        return $this->education;
    }

    public function getSkills()
    {
        return $this->skills;
    }

    public function getExperience()
    {
        return $this->experience;
    }

    public function getCertifications()
    {
        return $this->certifications;
    }

    public function getExtracurricularActivities()
    {
        return $this->extracurricularActivities;
    }

    public function getLanguages()
    {
        return $this->languages;
    }

    public function getReferences()
    {
        return $this->references;
    }
}
