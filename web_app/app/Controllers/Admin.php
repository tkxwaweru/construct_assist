<?php

namespace App\Controllers;

use App\Libraries\Hash;
use App\Models\UserModel;
use App\Models\ProfessionalsModel;
use App\Models\ProvidersModel;
use App\Models\ProfessionalEngagementsModel;
use App\Models\ProfessionalRatingsModel;
use App\Models\ProviderEngagementsModel;
use App\Models\ProviderRatingsModel;


class Admin extends BaseController
{
  public function __construct()
    {
        helper(['url', 'form']);
    }  
  
  public function adminHome()
    {
      return redirect()->to('admin-dashboard');
    }

    public function adminProfile()
    {
        return view('admin-dashboards/manage-profile');
    }
    
    public function registerAdmin()
    {
        return view('admin-dashboards/register-admin');
    }

    public function viewProfessionalRatings()
    {
        $professionalModel = new ProfessionalRatingsModel();
        $data['professional_ratings'] = $professionalModel->findAll(); // Retrieve all user records
        
        return view('admin-dashboards/view-professional-ratings', $data);
    }

    public function viewProviderRatings()
    {
        $providerModel = new ProviderRatingsModel();
        $data['provider_ratings'] = $providerModel->findAll(); // Retrieve all user records

        return view('admin-dashboards/view-provider-ratings', $data);
    }

    public function viewUsers()
    {
        $userModel = new UserModel();
        $data['users'] = $userModel->findAll(); // Retrieve all user records

        return view('admin-dashboards/view-users', $data);
    }


    public function adminPasswordRequest(){
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
    
    public function adminAccountDelete()
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

    public function adminRegister()
    {
        $validation = $this->validate([
            'name' => [
                'rules'  => 'required',
                'errors' => [
                    'required' => 'Your full name is required.',
                ],
            ],
            'email' => [
                'rules'  => 'required|valid_email|is_unique[tbl_users.email]',
                'errors' => [
                    'required'    => 'Your email address is required.',
                    'valid_email' => 'Kindly enter a valid email address e.g email@example.com',
                    'is_unique'   => 'This email address is already taken.',
                ],
            ],
            'phone_number' => [
                'rules'  => 'required|min_length[10]|max_length[10]',
                'errors' => [
                    'required'   => 'You must enter a phone number.',
                    'min_length' => 'A Kenyan phone number only has 10 digits eg. 0712345678.',
                    'max_length' => 'A Kenyan phone number only has 10 digits eg. 0712345678.',
                ],
            ],
            'password' => [
                'rules'  => 'required|min_length[5]|max_length[20]',
                'errors' => [
                    'required'   => 'You must enter a password.',
                    'min_length' => 'Your password must have at least 5 characters.',
                    'max_length' => 'Your password should not exceed 20 characters.',
                ],
            ],
        ]);

        if (!$validation) {
            return view('admin-dashboards/register-admin', ['validation' => $this->validator]);
        } else {
            $name = $this->request->getPost('name');
            $email = $this->request->getPost('email');
            $phone_number = $this->request->getPost('phone_number');
            $role_id = $this->request->getPost('role_id');
            $password = $this->request->getPost('password');
            $account = 1;

            $values = [
                'name'     => $name,
                'email'    => $email,
                'phone_number'    =>  $phone_number,
                'role_id'    => $role_id,
                'password' => Hash::make($password),
                'account_status' => $account
            ];

            $userModel = new UserModel();
            $query = $userModel->insert($values);

            if (!$query) {
                return redirect()->to('registerAdmin')->with('fail', 'Something went wrong, please try again.');
            } else { 
                return redirect()->to('registerAdmin')->with('success', 'Administrator registered successfully.');
            }
    }
    }

    public function userAccountModification()
    {
        // Get the posted email and account status from the form
        $email = $this->request->getPost('email');
        $accountStatus = $this->request->getPost('account_status');

        // Query the UserModel for a record where the email matches
        $userModel = new UserModel();
        $user = $userModel->where('email', $email)->first();

        // Update the account status in the retrieved record
        if ($user) {
            $user['account_status'] = $accountStatus;
            $userModel->save($user);

            // Optionally, you can add a success message or perform other actions
            // to indicate that the account status has been updated successfully.
        }

        return redirect()->to('viewUsers');
    }

  
}
