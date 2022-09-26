<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\User;
use App\Setting;
use App\AppSetting;
use Intervention\Image\Facades\Image; 
use Session;
use Input;
use Config;
class SettingController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');

    }

    public function settings(Request $request)
    {
        $auth_user = authSession();
        $pageTitle = 'Setting';
        $page = $request->page;

        if($page == ''){
            $page = 'profile_form';
        }

        return view('setting.index',compact('page', 'pageTitle' ,'auth_user'));
    }


     /*ajax show layout data*/

     public function layoutPage(Request $request){

        $page = $request->page;
        $auth_user = authSession();
        $user_id = $auth_user->id;
        $settings = AppSetting::first();
        $user_data = User::find($user_id);
        // $envSettting = $envSettting_value =[];
        // if ($page == 'mail-setting'){
        //     $envSettting = Config::get('constant.MAIL_SETTING');
        // }elseif ($page == 'configuration'){
        //     $envSettting = Config::get('constant.CONFIGURATION');
        // }elseif($page == 'social'){
        //     $envSettting = Config::get('constant.SOCIAL');
        // }
        // if(count($envSettting) > 0 ){
        //     $envSettting_value = Setting::whereIn('key',array_keys($envSettting))->get();
        // }
        if($settings == null){
            $settings = new AppSetting;
        }elseif($user_data == null){
            $user_data = new User;
        }
        switch ($page) {
            case 'password_form':
                $data  = view('user.profile.'.$page, compact('settings','user_data','page'))->render();
                break;
            case 'profile_form':
                $data  = view('user.profile.'.$page, compact('settings','user_data','page'))->render();
                break;
            case 'mail-setting':
                $data  = view('setting.'.$page, compact('settings','page','envSettting','envSettting_value'))->render();
                break;
            default:
                $data  = view('setting.'.$page, compact('settings','page','envSettting'))->render();
                break;
        }
        return response()->json($data);
    }

}
