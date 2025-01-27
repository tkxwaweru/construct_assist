<?php

namespace App\Controllers;

use App\Models\UserModel;
use App\Models\ProvidersModel;
use App\Models\ProviderRatingsModel;

class Provider extends BaseController
{
    public function __construct()
    {
        helper(['url', 'form']);
    }

    public function providerHome()
    {
        return redirect()->to('provider-dashboard');
    }

    public function providerProfile()
    {
        return view('provider-dashboards/manage-prov-profile');
    }

    public function providerRatings()
    {
        // Get the session email
        $sessionEmail = session('email');

        // Use session email to query the UserModel for user_id
        $userModel = new UserModel();
        $user = $userModel->where('email', $sessionEmail)->first();

        if (!$user) {
            return redirect()->to('/login')->with('error', 'User not found.');
        }

        // Use user_id to query ProfessionalsModel for reliability status
        $providersModel = new ProvidersModel();
        $result = $providersModel->where('user_id', $user['user_id'])->get()->getRow();

        if($result){
        $reliability = $result->reliable == 1 ? 'Reliable' : 'Unreliable';
        $reliable_reviews = $result->reliable_reviews ?? 0;
        $unreliable_reviews = $result->unreliable_reviews ?? 0;
        } else {
            $reliability = null; // Indicates no data available
            $reliable_reviews = null;
            $unreliable_reviews = null;
        }

        // Prepare the data to pass to the view
        $data = [
            'reliability' => $reliability,
            'reliable_reviews' => $reliable_reviews,
            'unreliable_reviews' => $unreliable_reviews
        ];

        return view('provider-dashboards/view-provider-ratings', $data);
    }

    public function providerPasswordRequest()
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

    public function providerAccountDelete()
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

    public function providerUpdate()
    {
        // Get the session email
        $sessionEmail = session('email');
        $serviceId = $this->request->getPost('service_id');
        $certificationFile = $this->request->getFile('certification_file');
        $company = $this->request->getPost('company');
        $county = $this->request->getPost('county');

        // Use session email to query the UserModel for user_id
        $userModel = new UserModel();
        $user = $userModel->where('email', $sessionEmail)->first();

        if ($certificationFile && $certificationFile->isValid()) {
            // Read the file contents
            $fileContents = file_get_contents($certificationFile->getTempName());

            // Prepare the data for insertion
            $data = [
                'user_id' => $user['user_id'],
                'service_id' => $serviceId,
                'company' => $company,
                'certification_file' => $fileContents,
                'county' => $county
            ];

            // Store the data into ProfessionalsModel
            $providersModel = new ProvidersModel();
            $providersModel->insert($data);
        } else {
            return redirect()->to('providerProfile')->with('fail', 'Update failed, please try again.');
        }
        return redirect()->to('providerProfile')->with('success', 'Account updated successfully.');
    }
}
