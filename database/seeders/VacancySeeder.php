<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Vacancy;
use Carbon\Carbon;

class VacancySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $vacancies = [
            // Admin and Finance Officer
            [
                'title' => 'Admin and Finance Officer',
                'position' => 'Admin and Finance Officer',
                'location' => 'Udayapur, Nepal',
                'employment_type' => 'Full Time',
                'number_of_positions' => 1,
                'experience_required' => '3 years',
                'education_level' => 'Bachelor Degree in Business Administration, Business Studies or equivalent',
                'salary_range' => 'As per organization rules',
                'description' => 'Jalpa Integrated Development Society (JIDS) Udayapur is a non-political and non-profitable NGO established in 1994 by a group of Udayapur marginalized group\'s activists. Since then, JIDS Udayapur is fully dedicated to work in humanitarian assistance, community development, livelihood, child well-being, and environmental protection mainly in the Hilly region of Nepal through the humanitarian and long-term development projects.

In partnership with World Vision International Nepal, JIDS Udayapur have been working on "Sponsorship Operation Program (SOP) and Core Project Models of CVA, CP core, Protect" in two Municipalities Triyuga and Katari, and four Rural Municipalities Rautamai, Limchungbung, Udayapurgadhi and Tapli.',
                'responsibilities' => '• Financial reporting and supply chain management
• Procurement, admin and store management
• Supply chain reporting as per Donor requirements
• Manage day-to-day administrative and financial operations',
                'requirements' => '• Bachelor Degree in Business Administration, Business Studies or equivalent
• 3 years of experience in financial reporting, supply chain, logistic, procurement, admin and store management
• Able to do financial reporting and supply chain reporting as per required by Donor
• Ability to speak and write English clearly',
                'skills' => 'MS-Excel, MS-Word, PowerPoint, Email-Internet, Dedicated project software, Financial reporting, Supply chain management, Procurement',
                'benefits' => 'Competitive salary and benefits as per organization rules',
                'how_to_apply' => 'Interested candidates who meet these criteria should apply online via email or submit hard copy to our office.

**Application Procedure:**
Send your Cover Letter, Updated CV including at least recent two references and scan copy of Nepali Citizenship and relevant certificates and documents.

**Email:** vacancy.jidsudayapur@gmail.com

**Or submit hard copy to:** JIDS Udayapur Office

**Note:** Women, Marginalized and Differently Able are highly encouraged to apply for the position. Only the short-listed candidates will be called for written test and an interview. No telephone calls will be entertained.',
                'application_email' => 'vacancy.jidsudayapur@gmail.com',
                'application_phone' => null,
                'deadline' => Carbon::parse('2026-01-14'),
                'published_date' => Carbon::parse('2026-01-07'),
                'is_active' => true,
                'is_urgent' => true,
                'is_featured' => true,
                'department' => 'Administration',
                'category' => 'Management',
            ],
            
            // Sponsorship Mobiliser (SOP)
            [
                'title' => 'Sponsorship Mobiliser (SOP)',
                'position' => 'Sponsorship Mobiliser',
                'location' => 'Udayapur, Nepal (Field-based)',
                'employment_type' => 'Full Time',
                'number_of_positions' => 1,
                'experience_required' => '2 years',
                'education_level' => 'Intermediate (+2) in Management/Commerce, Humanities, Educations or equivalent',
                'salary_range' => 'As per organization rules',
                'description' => 'Jalpa Integrated Development Society (JIDS) Udayapur is a non-political and non-profitable NGO established in 1994 by a group of Udayapur marginalized group\'s activists. Since then, JIDS Udayapur is fully dedicated to work in humanitarian assistance, community development, livelihood, child well-being, and environmental protection mainly in the Hilly region of Nepal through the humanitarian and long-term development projects.

In partnership with World Vision International Nepal, JIDS Udayapur have been working on "Sponsorship Operation Program (SOP) and Core Project Models of CVA, CP core, Protect" in two Municipalities Triyuga and Katari, and four Rural Municipalities Rautamai, Limchungbung, Udayapurgadhi and Tapli.',
                'responsibilities' => '• Behave properly with project beneficiaries and stakeholders
• Community mobilization, coordination and collaboration with local government
• Conduct program with local level children and youth groups
• Prepare event reports and documentation
• Support sponsorship program implementation
• Work closely with communities on child protection and community-based programs',
                'requirements' => '• Intermediate (+2) in Management/Commerce, Humanities, Educations or equivalent
• 2 years of experience in child protection and community-based programs
• Skills of community mobilization
• Coordination and collaboration skills with local government
• Ability to conduct programs with children and youth groups',
                'skills' => 'MS-Excel, MS-Word, PowerPoint, Email-Internet, Community mobilization, Report writing, Child protection knowledge, Local government coordination',
                'benefits' => 'Competitive salary and benefits as per organization rules',
                'how_to_apply' => 'Interested candidates who meet these criteria should apply online via email or submit hard copy to our office.

**Application Procedure:**
Send your Cover Letter, Updated CV including at least recent two references and scan copy of Nepali Citizenship and relevant certificates and documents.

**Email:** vacancy.jidsudayapur@gmail.com

**Or submit hard copy to:** JIDS Udayapur Office

**Note:** Women, Marginalized and Differently Able are highly encouraged to apply for the position. Only the short-listed candidates will be called for written test and an interview. No telephone calls will be entertained.',
                'application_email' => 'vacancy.jidsudayapur@gmail.com',
                'application_phone' => null,
                'deadline' => Carbon::parse('2026-01-14'),
                'published_date' => Carbon::parse('2026-01-07'),
                'is_active' => true,
                'is_urgent' => true,
                'is_featured' => true,
                'department' => 'Field Operations',
                'category' => 'Development',
            ],
        ];

        foreach ($vacancies as $vacancy) {
            Vacancy::updateOrCreate(
                [
                    'position' => $vacancy['position'],
                    'deadline' => $vacancy['deadline']
                ],
                $vacancy
            );
        }
    }
}
