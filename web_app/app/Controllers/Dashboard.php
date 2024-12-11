<?php

namespace App\Controllers;

use App\Models\UserModel;
use App\Controllers\Auth;

class Dashboard extends BaseController
{
    public function index()
    {

      $userModel = new \App\Models\UserModel();
      $loggedUserID = session()->get('loggedUser');
      $userInfo = $userModel->find($loggedUserID);
      $data = ['userInfo'=>$userInfo];
      return view('auth/dashboard', $data);
    }

    public function admin()
    {
      $userModel = new \App\Models\UserModel();
      $loggedUserID = session()->get('loggedUser');
      $userInfo = $userModel->find($loggedUserID);
      $data = ['userInfo'=>$userInfo];
      return view('auth/admin-dashboard', $data);
    }
    

    public function manager()
    {
      $userModel = new \App\Models\UserModel();
      $loggedUserID = session()->get('loggedUser');
      $userInfo = $userModel->find($loggedUserID);
      $data = ['userInfo'=>$userInfo];
      return view('auth/manager-dashboard', $data);
    }

    public function professional()
    {
      $userModel = new \App\Models\UserModel();
      $loggedUserID = session()->get('loggedUser');
      $userInfo = $userModel->find($loggedUserID);
      $data = ['userInfo'=>$userInfo];
      return view('auth/professional-dashboard', $data);
    }

    public function provider()
    {
      $userModel = new \App\Models\UserModel();
      $loggedUserID = session()->get('loggedUser');
      $userInfo = $userModel->find($loggedUserID);
      $data = ['userInfo'=>$userInfo];
      return view('auth/provider-dashboard', $data);
    }
}
