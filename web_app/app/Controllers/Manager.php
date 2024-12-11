<?php

namespace App\Controllers;

use App\Models\UserModel;
use App\Models\ProfessionalsModel;
use App\Models\ProfessionsModel;
use App\Models\ServicesModel;
use App\Models\ProvidersModel;
use App\Models\ProfessionalEngagementsModel;
use App\Models\ProviderEngagementsModel;
use App\Models\ProviderRatingsModel;
use App\Models\ProfessionalRatingsModel;
use Config\Services;



class Manager extends BaseController
{
  public function __construct()
    {
        helper(['url', 'form']);
    }  
  
  public function managerHome()
    {
      return redirect()->to('manager-dashboard');
    }

    public function managerProfile()
    {
        return view('manager-dashboards/manage-profile');
    }

    public function enlistServices()
    {
        return view('manager-dashboards/enlist-services');
    }

    public function    enlistProfessionals()
    {
        return view('manager-dashboards/enlist-professionals');
    }

    public function viewTeam()
    {
        return view('manager-dashboards/view-team');
    }

    public function searchProfessionals()
    {
        $profession_id = $this->request->getPost('profession_id');

        $professionalsModel = new ProfessionalsModel();
        $userModel = new UserModel();
        $professionsModel = new ProfessionsModel();
        $professionalEngagementsModel = new ProfessionalEngagementsModel();

        $professionals = $professionalsModel->where('profession_id', $profession_id)->findAll();

        $professionalsData = [];
        foreach ($professionals as $professional) {
            $user_id = $professional['user_id'];
            $user = $userModel->find($user_id);

            if ($user !== null) {
                $profession_id = $professional['profession_id'];
                $profession = $professionsModel->find($profession_id);

                // Query ProfessionalEngagementsModel for active_engagement
                $professionalEngagement = $professionalEngagementsModel
                    ->where('professional_id', $user_id)
                    ->where('active_engagement', 1)
                    ->first();

                // Exclude data with matching user_id from professionalsData
                if ($professionalEngagement === null) {
                    $professionalsData[] = [
                        'name' => $user['name'],
                        'email' => $user['email'],
                        'phone_number' => $user['phone_number'],
                        'average_rating' => $professional['average_rating'],
                        'profession_name' => ($profession !== null) ? $profession['profession_name'] : null,
                    ];
                }
            }
        }

        $data = [
            'profession_name' => ($profession !== null) ? $profession['profession_name'] : null,
            'professionalsData' => $professionalsData,
        ];

        return view('manager-dashboards/professionals-search', $data);
    }


    
    // public function searchServices()
    // {
    //     $service_id = $this->request->getPost('service_id');

    //     $providersModel = new ProvidersModel();
    //     $userModel = new UserModel();
    //     $servicesModel = new ServicesModel();

    //     $providers = $providersModel->where('service_id', $service_id)->findAll();

    //     $providersData = [];
    //     $service_name = null; // Initialize the variable outside the loop
    //     foreach ($providers as $provider) {
    //         $user_id = $provider['user_id'];
    //         $user = $userModel->find($user_id);

    //         if ($user !== null) {
    //             $service_id = $provider['service_id'];
    //             $service = $servicesModel->find($service_id);

    //             $service_name = ($service !== null) ? $service['service_name'] : null; // Move inside the loop

    //             $providersData[] = [
    //                 'name' => $user['name'],
    //                 'email' => $user['email'],
    //                 'phone_number' => $user['phone_number'],
    //                 'service_name' => ($service !== null) ? $service['service_name'] : null,
    //                 'company' => ($provider !== null) ? $provider['company'] : null,
    //                 'average_rating' => $provider['average_rating'],
    //             ];
    //         }
    //     }

    //     $data = [
    //         'service_name' => $service_name,
    //         'providersData' => $providersData,
    //     ];

    //     return view('manager-dashboards/services-search', $data);
    // } 

    public function searchServices()
    {
        $service_id = $this->request->getPost('service_id');

        $providersModel = new ProvidersModel();
        $userModel = new UserModel();
        $servicesModel = new ServicesModel();
        $providerEngagementsModel = new ProviderEngagementsModel();

        $providers = $providersModel->where('service_id', $service_id)->findAll();

        $providersData = [];
        $service_name = null; // Initialize the variable outside the loop
        foreach ($providers as $provider) {
            $user_id = $provider['user_id'];
            $user = $userModel->find($user_id);

            if ($user !== null) {
                $service_id = $provider['service_id'];
                $service = $servicesModel->find($service_id);

                $service_name = ($service !== null) ? $service['service_name'] : null; // Move inside the loop

                // Query ProviderEngagementsModel for active_engagement
                $providerEngagement = $providerEngagementsModel
                    ->where('provider_id', $user_id)
                    ->where('active_engagement', 1)
                    ->first();

                // Exclude data with matching user_id from providersData
                if ($providerEngagement === null) {
                    $providersData[] = [
                        'name' => $user['name'],
                        'email' => $user['email'],
                        'phone_number' => $user['phone_number'],
                        'service_name' => ($service !== null) ? $service['service_name'] : null,
                        'company' => ($provider !== null) ? $provider['company'] : null,
                        'average_rating' => $provider['average_rating'],
                    ];
                }
            }
        }

        $data = [
            'service_name' => $service_name,
            'providersData' => $providersData,
        ];

        return view('manager-dashboards/services-search', $data);
    }



    public function selectProfessionalEngagement()
    {
        // Retrieve the posted professional email
        $postEmail = $this->request->getPost('professional');
        
        // Retrieve the active session email
        $sessionEmail = session('email');
        
        // Query the tbl_users table to find the manager's user ID where the email matches the session email
        $userModel = new UserModel();
        $manager = $userModel->where('email', $sessionEmail)->first();
        $managerId = ($manager !== null) ? $manager['user_id'] : null;
        
        // Query the tbl_users table to find the professional's user details where the email matches the posted email
        $professional = $userModel->where('email', $postEmail)->first();
        $professionalId = ($professional !== null) ? $professional['user_id'] : null;
        
        if ($managerId !== null && $professionalId !== null) {
            // Retrieve the additional details from tbl_users using professionalId
            $professionalDetails = $userModel->find($professionalId);
            
            if ($professionalDetails !== null) {
                $professionalName = $professionalDetails['name'];
                $professionalEmail = $professionalDetails['email'];
                $professionalPhoneNumber = $professionalDetails['phone_number'];
                $professionalRoleId = $professionalDetails['role_id'];
                
                // Store the manager's user ID, professional's user ID, and other details in the tbl_professional_engagements table
                $professionalEngagementsModel = new ProfessionalEngagementsModel();
                $professionalEngagementsModel->insert([
                    'manager_id' => $managerId,
                    'professional_id' => $professionalId,
                    'name' => $professionalName,
                    'email' => $professionalEmail,
                    'phone_number' => $professionalPhoneNumber,
                    'role_id' => $professionalRoleId,
                    'active_engagement' => 1
                ]);
            }
        }

        $email = \Config\Services::email();
        $email->setFrom('construct.assist.254@gmail.com', 'Construct-Assist');
        $email->setTo($postEmail);
        $email->setSubject('PROJECT RECRUITMENT');
        $email->setMessage('Good day!'.'<br><br>' . 'You have been recruited by '. $sessionEmail .' to collaborate on a 
        construction project.<br><br> 
        This project manager shall contact you with more details. Upon job completion your services shall be rated 
        (out of 5) by the project manager. You shall receive an email with details on this after you have been rated.<br><br>
            Thank you for using Construct-Assist');

        $email->send();
        
        // Redirect to a success page or perform any further actions
        return redirect()->to('managerEngagements');
    }
    

    
    public function selectProviderEngagement()
    {
             // Retrieve the posted professional email
             $postEmail = $this->request->getPost('provider');
        
             // Retrieve the active session email
             $sessionEmail = session('email');
             
             // Query the tbl_users table to find the manager's user ID where the email matches the session email
             $userModel = new UserModel();
             $manager = $userModel->where('email', $sessionEmail)->first();
             $managerId = ($manager !== null) ? $manager['user_id'] : null;
             
             // Query the tbl_users table to find the professional's user details where the email matches the posted email
             $provider = $userModel->where('email', $postEmail)->first();
             $providerId = ($provider !== null) ? $provider['user_id'] : null;
             
             if ($managerId !== null && $providerId !== null) {
                 // Retrieve the additional details from tbl_users using professionalId
                 $providerDetails = $userModel->find($providerId);
                 
                 if ($providerDetails !== null) {
                     $providerName = $providerDetails['name'];
                     $providerEmail = $providerDetails['email'];
                     $providerPhoneNumber = $providerDetails['phone_number'];
                     $providerRoleId = $providerDetails['role_id'];
                     
                     // Store the manager's user ID, professional's user ID, and other details in the tbl_professional_engagements table
                     $providerEngagementsModel = new ProviderEngagementsModel();
                     $providerEngagementsModel->insert([
                         'manager_id' => $managerId,
                         'provider_id' => $providerId,
                         'name' => $providerName,
                         'email' => $providerEmail,
                         'phone_number' => $providerPhoneNumber,
                         'role_id' => $providerRoleId,
                         'active_engagement' => 1
                     ]);
                 }
             }

                $email = \Config\Services::email();
                $email->setFrom('construct.assist.254@gmail.com', 'Construct-Assist');
                $email->setTo($postEmail);
                $email->setSubject('PROJECT RECRUITMENT');
                $email->setMessage('Good day!'.'<br><br>' . 'You have been recruited by '. $sessionEmail .' to collaborate on a 
                construction project.<br><br> 
                This project manager shall contact you with more details. Upon job completion your services shall be rated 
                (out of 5) by the project manager. You shall receive an email with details on this after you have been rated.<br><br>
                    Thank you for using Construct-Assist');
    
                $email->send();
             
             // Redirect to a success page or perform any further actions
             return redirect()->to('managerEngagements');
    }

    public function managerEngagements()
    {
        // Retrieve the active session email
        $sessionEmail = session('email');

        // Query the UserModel to find the manager's user ID where the email matches the session email
        $userModel = new UserModel();
        $manager = $userModel->where('email', $sessionEmail)->first();
        $managerId = ($manager !== null) ? $manager['user_id'] : null;

        if ($managerId !== null) {
            // Query the ProviderEngagementsModel and ProfessionalEngagementsModel with the managerId and active_engagement = 1
            $providerEngagementsModel = new ProviderEngagementsModel();
            $professionalEngagementsModel = new ProfessionalEngagementsModel();

            $providerEngagements = $providerEngagementsModel->where('manager_id', $managerId)
                                                            ->where('active_engagement', 1)
                                                            ->findAll();

            $professionalEngagements = $professionalEngagementsModel->where('manager_id', $managerId)
                                                                    ->where('active_engagement', 1)
                                                                    ->findAll();

            // Prepare the data array
            $data = [
                'providerEngagements' => $providerEngagements,
                'professionalEngagements' => $professionalEngagements
            ];

            // Pass the data array to the view
            return view('manager-dashboards/view-team', $data);
        }
    }

    
    public function rateSelect()
    {
        $email = $this->request->getPost('email'); // Get the posted email

        // Query the database using the UserModel to retrieve name and email
        $userModel = new \App\Models\UserModel();
        $user = $userModel->where('email', $email)->first();

        if ($user) {
            $data = [
                'name' => $user['name'],
                'email' => $user['email']
            ];
        } else {
            // Handle the case where no user is found for the given email
            $data = [
                'name' => '',
                'email' => $email
            ];
        }

        return view('manager-dashboards/manager-rating', $data);
    }


    public function rateService()
    {
        // Retrieve the posted data from the form
        $sessionEmail = session('email');
        $postEmail = $this->request->getPost('email');
        $score = $this->request->getPost('score');
        $comment = $this->request->getPost('comment');
    
        // Get user_id and role_id based on the posted email
        $userModel = new UserModel();
        $user = $userModel->where('email', $postEmail)->first();
        if (!$user) {
            // Handle case when user is not found
            // Redirect or display an error message
        }
    
        $user_id = $user['user_id'];
        $role_id = $user['role_id'];
    
        // Process based on role_id
        if ($role_id == 3) {
            // Insert into ProfessionalRatingsModel
            $professionalRatingsModel = new ProfessionalRatingsModel();
            $professionalRatingsModel->insert([
                'professional_id' => $user_id,
                'score' => $score,
                'comment' => $comment
            ]);
    
            // Update average_rating in ProfessionalsModel
            $professionalsModel = new ProfessionalsModel();
            $professional = $professionalsModel->where('user_id', $user_id)->first();
            $averageRating = ($professional['average_rating'] + $score) / 2;
            $professionalsModel->where('user_id', $user_id)->set(['average_rating' => $averageRating])->update();
    
    
            // Update ProfessionalEngagementsModel
            $professionalEngagementsModel = new ProfessionalEngagementsModel();
            $professionalEngagement = $professionalEngagementsModel->where('professional_id', $user_id)
                ->where('active_engagement', 1)
                ->first();
            if ($professionalEngagement) {
                $professionalEngagementsModel->update($professionalEngagement['engagement_id'], [
                    'active_engagement' => 0,
                    'conclusion_date' => date('Y-m-d')
                ]);
            }
        } elseif ($role_id == 4) {
            // Insert into ProviderRatingsModel
            $providerRatingsModel = new ProviderRatingsModel();
            $providerRatingsModel->insert([
                'provider_id' => $user_id,
                'score' => $score,
                'comment' => $comment
            ]);
    
            // Update average_rating in ProvidersModel
            $providersModel = new ProvidersModel();
            $provider = $providersModel->where('user_id', $user_id)->first();
            $averageRating = ($provider['average_rating'] + $score) / 2;
            $providersModel->where('user_id', $user_id)->set(['average_rating' => $averageRating])->update();
    
            // Update ProviderEngagementsModel
            $providerEngagementsModel = new ProviderEngagementsModel();
            $providerEngagement = $providerEngagementsModel->where('provider_id', $user_id)
                ->where('active_engagement', 1)
                ->first();
            if ($providerEngagement) {
                $providerEngagementsModel->update($providerEngagement['engagement_id'], [
                    'active_engagement' => 0,
                    'conclusion_date' => date('Y-m-d')
                ]);
            }
        }
    
        $email = \Config\Services::email();
        $email->setFrom('construct.assist.254@gmail.com', 'Construct-Assist');
        $email->setTo($postEmail);
        $email->setSubject('SERVICE RATING');
        $email->setMessage('Good day!'.'<br><br>' . 'Your Services have been rated a ' .$score. ' (out of 5) by '. $sessionEmail .'<br><br> 
                Log in to your account to view more details.' . ' ' .
                    "<a href='" . base_url('login'). "'> Click here</a>".'<br><br>'.
                    'Thank you for using Construct-Assist');
    
        $email->send();
        // Redirect or display success message
        return redirect()->to('managerEngagements');
    }
    

    public function managerPasswordRequest(){
        $email = session('email');

        $values = ['email' => $email];

        // Email sending component:
        $eMail = \Config\Services::email();

        $eMail->setFrom('construct.assist.254@gmail.com', 'Construct-Assist');
        $eMail->setTo($values['email']);
        $eMail->setSubject('Password Reset');
        $eMail->setMessage('Use this link to reset your password' . ' ' .
            "<a href='" . base_url() . "processReset/" . $values['email'] . "'> Click here</a>");

        // Send email
        if ($eMail->send()) {
            return view('redirects/reset.php');
        } else {
            return redirect()->to('reset')->with('fail', 'Something went wrong, please try again.')->withInput();
        }  
    }
    
    public function managerAccountDelete()
    {           
        $sessionEmail = session('email');

        $userModel = new UserModel();
        $user = $userModel->where('email', $sessionEmail)->first();

        // Check if a matching user is found
        if ($user) {
            // Update the account status to 0

        $email = \Config\Services::email();
        $email->setFrom('construct.assist.254@gmail.com', 'Construct-Assist');
        $email->setTo($sessionEmail);
        $email->setSubject('ACCOUNT DELETED');
        $email->setMessage('Good day!<br><br>It seems you have decided to delete your account. We are sorry to see you go.<br>
        Do not worry, you can always recover your account by sending us an email at construct.assist.254@gmail.com and we shall process your request within 24 hours.          
        <br><br>Thank you for using Construct-Assist');
    
        $email->send();

        $userModel->update($user['user_id'], ['account_status' => 0]);
        }
        return redirect()->to('login')->with('fail', 'Account deleted.');
    }
}
