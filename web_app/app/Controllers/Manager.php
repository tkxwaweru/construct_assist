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

    public function enlistProfessionals()
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
        $county = $this->request->getPost('county');  // Get the county filter from the form

        $professionalsModel = new ProfessionalsModel();
        $userModel = new UserModel();
        $professionsModel = new ProfessionsModel();
        $professionalEngagementsModel = new ProfessionalEngagementsModel();

        // Build the query to filter by both profession_id and county
        $professionals = $professionalsModel->where('profession_id', $profession_id);

        if (!empty($county)) {
            $professionals = $professionals->where('county', $county);  // Add county filter
        }

        $professionals = $professionals->findAll();

        $professionalsData = [];
        $profession = null; // Initialize $profession variable

        foreach ($professionals as $professional) {
            $user_id = $professional['user_id'];
            $user = $userModel->find($user_id);

            if ($user !== null) {
                // Use already fetched professional data instead of fetching again
                $profession_id = $professional['profession_id'];
                $profession = $professionsModel->find($profession_id); // Get profession details

                // Query ProfessionalEngagementsModel for active engagement
                $professionalEngagement = $professionalEngagementsModel
                    ->where('professionals_user_id', $user_id)
                    ->where('active_engagement', 1)
                    ->first();

                // Exclude data with active engagement and include reliable professionals
                if ($professionalEngagement === null && $professional['reliable'] == 1) {
                    $professionalsData[] = [
                        'name' => $user['name'],
                        'email' => $user['email'],
                        'phone_number' => $user['phone_number'],
                        'county' => $professional['county'],
                        'profession_name' => ($profession !== null) ? $profession['profession_name'] : null,
                        'company' => $professional['company'],
                        'reliable' => $professional['reliable'],
                    ];
                }
            }
        }

        // Handle case where no professionals were found
        $data = [
            'profession_name' => ($profession !== null) ? $profession['profession_name'] : 'No profession found',
            'professionalsData' => $professionalsData,
            'county' => !empty($professionalsData) ? $professionalsData[0]['county'] : 'No county specified'
        ];

        return view('manager-dashboards/professionals-search', $data);
    }



    public function searchServices()
    {
        $service_id = $this->request->getPost('service_id');
        $county = $this->request->getPost('county');  // Get the county filter from the form

        $providersModel = new ProvidersModel();
        $userModel = new UserModel();
        $servicesModel = new ServicesModel();
        $providerEngagementsModel = new ProviderEngagementsModel();

        // Build the query to filter by both profession_id and county
        $providers = $providersModel->where('service_id', $service_id);

        if (!empty($county)) {
            $providers = $providers->where('county', $county);  // Add county filter
        }

        $providers = $providersModel->findAll();

        $providersData = [];
        $service_name = null; // Initialize the variable outside the loop

        foreach ($providers as $provider) {
            $user_id = $provider['user_id'];
            $user = $userModel->find($user_id);

            if ($user !== null) {
                $service_id = $provider['service_id'];
                $service_name = $servicesModel->find($service_id);

                //$service_name = ($service !== null) ? $service['service_name'] : null; // Move inside the loop

                // Query ProviderEngagementsModel for active_engagement
                $providerEngagement = $providerEngagementsModel
                    ->where('providers_user_id', $user_id)
                    ->where('active_engagement', 1)
                    ->first();

                // Exclude data with matching user_id from providersData
                if ($providerEngagement === null && $provider['reliable'] == 1) {
                    $providersData[] = [
                        'name' => $user['name'],
                        'email' => $user['email'],
                        'phone_number' => $user['phone_number'],
                        'county' => $provider['county'],
                        'service_name' => ($service_name !== null) ? $service_name['service_name'] : null,
                        'company' => $provider['company'],
                        'reliable' => $provider['reliable'],
                    ];
                }
            }
        }

        // Handle case where no service providers were found
        $data = [
            'service_name' => ($service_name !== null) ? $service_name['service_name'] : 'No service found',
            'providersData' => $providersData,
            'county' => !empty($providersData) ? $providersData[0]['county'] : 'No county specified'
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
                    'professionals_user_id' => $professionalId,
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
        $email->setMessage('Good day!' . '<br><br>' . 'You have been recruited by ' . $sessionEmail . ' to collaborate on a 
        construction project.<br><br> 
        This project manager shall contact you with more details. Upon job completion your services shall be reviewed. You shall receive an email with details on this after you have been reviewed.<br><br>
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
                    'providers_user_id' => $providerId,
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
        $email->setMessage('Good day!' . '<br><br>' . 'You have been recruited by ' . $sessionEmail . ' to collaborate on a 
                construction project.<br><br> 
                This project manager shall contact you with more details. Upon job completion your services shall be reviewed. You shall receive an email with details on this after you have been reviewed.<br><br>
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
        $name = $this->request->getPost('name');
        $comment = $this->request->getPost('comment');

        // Send comment to API for sentiment analysis
        $apiUrl = "http://127.0.0.1:8000/predict";
        $apiData = json_encode(['text' => $comment]);
        $ch = curl_init($apiUrl);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, ['Content-Type: application/json']);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $apiData);

        $apiResponse = curl_exec($ch);
        curl_close($ch);

        if (!$apiResponse) {
            return redirect()->back()->withInput()->with('error', 'Failed to analyze sentiment.');
        }

        $sentimentData = json_decode($apiResponse, true);
        $reviewSentiment = $sentimentData['sentiment'] ?? null;

        if (!$reviewSentiment) {
            return redirect()->back()->withInput()->with('error', 'Failed to analyze sentiment.');
        }

        $reviewSentimentBoolean = $reviewSentiment === 'positive' ? 1 : 0;

        $userModel = new UserModel();
        $user = $userModel->where('email', $postEmail)->first();
        if (!$user) {
            return redirect()->back()->withInput()->with('error', 'User not found.');
        }

        $user_id = $user['user_id'];
        $role_id = $user['role_id'];

        if ($role_id == 3) {
            $professionalRatingsModel = new ProfessionalRatingsModel();
            $professionalRatingsModel->insert([
                'professionals_user_id' => $user_id,
                'review_text' => $comment,
                'review_sentiment' => $reviewSentimentBoolean
            ]);

            $professionalsModel = new ProfessionalsModel();
            $columnToUpdate = $reviewSentimentBoolean ? 'reliable_reviews' : 'unreliable_reviews';
            $professionalsModel->set($columnToUpdate, "{$columnToUpdate} + 1", false)
                ->where('user_id', $user_id)
                ->update();

            $professionalEngagementsModel = new ProfessionalEngagementsModel();
            $professionalEngagement = $professionalEngagementsModel->where('professionals_user_id', $user_id)
                ->where('active_engagement', 1)
                ->first();
            if ($professionalEngagement) {
                $professionalEngagementsModel->update($professionalEngagement['engagement_id'], [
                    'active_engagement' => 0,
                    'conclusion_date' => date('Y-m-d')
                ]);
            }
        } elseif ($role_id == 4) {
            $providerRatingsModel = new ProviderRatingsModel();
            $providerRatingsModel->insert([
                'providers_user_id' => $user_id,
                'review_text' => $comment,
                'review_sentiment' => $reviewSentimentBoolean
            ]);

            $providersModel = new ProvidersModel();
            $columnToUpdate = $reviewSentimentBoolean ? 'reliable_reviews' : 'unreliable_reviews';
            $providersModel->set($columnToUpdate, "{$columnToUpdate} + 1", false)
                ->where('user_id', $user_id)
                ->update();

            $providerEngagementsModel = new ProviderEngagementsModel();
            $providerEngagement = $providerEngagementsModel->where('providers_user_id', $user_id)
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
        $email->setMessage('Good day!' . '<br><br>' . 'Your Services have been reviewed by ' . $sessionEmail . '<br><br> 
                Log in to your account to view more details.' . ' ' .
            "<a href='" . base_url('login') . "'> Click here</a>" . '<br><br>' .
            'Thank you for using Construct-Assist');

        $email->send();

        // Store the message and sentiment in flashdata
        $session = session();
        $session->setFlashdata('apiResponseMessage', "Our AI has classified your review as \"" . $reviewSentiment . "\"");
        $session->setFlashdata('apiResponseSentiment', $reviewSentiment);
        $session->setFlashdata('name', $name);
        $session->setFlashdata('email', $postEmail);

        // Redirect back with input to repopulate the form on error or display flash messages
        return redirect()->back()->withInput();
    }
 
    public function rateProceed()
    {
        return view('manager-dashboards/view-team');
    }

    public function rateAppeal() {}

    public function managerPasswordRequest()
    {
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
