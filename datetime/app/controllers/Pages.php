<?php

  class Pages extends Controller {
    public function __construct(){
      $this->postModel = $this->model('Post');
    }
    
    public function index(){
      $posts = $this->postModel->GetPosts();
      $time_EasternStandard=dateAndTime_EasternStandardTime();
      $time_Coordinated_Universal_Time=dateAndTime_Coordinated_Universal_Time();
      $user_Location=userLocation();
      $dayOfWeek=userLocationDateAndTime();
      $dateOfTheYear=userLocationDateAndTime();
      $data = [
        'title' => 'Welcome',
          'time_EasternStandard'=>$time_EasternStandard,
           'time_Coordinated_Universal_Time'=>$time_Coordinated_Universal_Time,
            'user_location_country'=> $user_Location["country"],
             'user_location_city'=> $user_Location["city"],
              'dayOfWeek'=> $dayOfWeek["dayOfWeek"],
                'date'=> $dateOfTheYear['date'],


      ];      
     


     
      $this->view('pages/index', $data);
    }

    public function aboutus(){
      $data = [
        'title' => 'About Us',
        'desc' => 'this is a website designed to help find usefull data for your daily activities , make sure to bookmark it  ! ',
      ];

      $this->view('pages/aboutus', $data);
    }

    public function currencyconverotr(){
      $posts = $this->postModel->GetPosts();
      $data=[
        'title'=>'Currency Convertor',
      ];
  
      $this->view('pages/currencyconverotr', $data);

    }

    


  }