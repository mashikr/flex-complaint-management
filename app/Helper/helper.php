<?php
    function getSingleMedia($model, $collection = 'image_icon',$skip=true)
    {
        if (!\Auth::check() && $skip) {
            return asset('assets/img/icons/user/user.png');
        }
        if ($model !== null) {
            $media = $model->getFirstMedia($collection);
        }
    
        $imgurl= isset($media)?$media->getPath():'';
    
        if (file_exists($imgurl)) {
            return $media->getFullUrl();
        }
        else
        {
            switch ($collection) {
                case 'image_icon':
                    $media = asset('assets/img/icons/user/user.png');
                    break;
                case 'profile_image':
                    $media = asset('assets/images/user/1.jpg');
                    break;
                default:
                    $media = asset('assets/img/icons/common/add.png');
                    break;
            }
            return $media;
        }
    }

    function settingSession($type='get'){
        if(\Session::get('setting_data') == ''){
            $type='set';
        }
        switch ($type){
            case "set" : 
                $settings = \App\AppSetting::first();
                \Session::put('setting_data',$settings);
                break;
            default : 
                break;
        }
        return \Session::get('setting_data');
    }

    function authSession($force=false){
        $session = new \App\User;
        if($force){
            $user = \Auth::user()->getRoleNames();
            \Session::put('auth_user',$user);
            $session = \Session::get('auth_user');
            return $session;
        }
        if(\Session::has('auth_user')){
            $session = \Session::get('auth_user');
        }else{
            $user = \Auth::user();
            \Session::put('auth_user',$user);
            $session = \Session::get('auth_user');
        }
        return $session;
    }

    function message_body_template ($item) {
        if(auth()->user()->user_type == "user") {
            if($item->from == "user") {
                return message_template($item, "sender");
            } else {
                return message_template($item, "receiver");
            }
        } else {
            if($item->from == "admin") {
                return message_template($item, "sender");
            } else {
                return message_template($item, "receiver");
            }
        }
    }

    function message_template($item, $type) {
        if($item->message_type=="text") {
            return '<div class="d-flex my-2 '. ($type=="sender"?"justify-content-end":"justify-content-start") .'">
                        <span class="py-1 px-3 rounded '. ($type=="sender"?"bg-danger text-white":"bg-light") .'">
                            '. $item->message .'
                        </span>
                    </div>';
        } else if($item->message_type=="img") {
            return '<div class="d-flex my-2 '. ($type=="sender"?"justify-content-end":"justify-content-start") .'">
                        <span style="max-width: 75%" class="py-3 px-3 rounded '. ($type=="sender"?"bg-danger text-white":"bg-light") .'">
                            <img class="img-fluid" style="min-height: 100px" src="'. asset("assets/complain/files/$item->file_name") .'" alt="">
                        </span>
                    </div>';
        } else if($item->message_type=="pdf") {
            return '<div class="d-flex my-2 '. ($type=="sender"?"justify-content-end":"justify-content-start") .'">
                        <span style="max-width: 75%" class="py-1 px-3 rounded '. ($type=="sender"?"bg-danger text-white":"bg-light") .'">
                            <a href="'. asset("assets/complain/files/$item->file_name") .'" target="_blank" class="'. ($type=="sender"?"text-white":"") .'">
                                <i class="far fa-file-pdf text-warning"></i> '.$item->file_name.'
                            </a>
                        </span>
                    </div>';
        } else if($item->message_type=="doc") {
            return '<div class="d-flex my-2 '. ($type=="sender"?"justify-content-end":"justify-content-start") .'">
                        <span style="max-width: 75%" class="py-1 px-3 rounded '. ($type=="sender"?"bg-danger text-white":"bg-light") .'">
                            <a href="'. asset("assets/complain/files/$item->file_name") .'" target="_blank" class="'. ($type=="sender"?"text-white":"") .'">
                            <i class="far fa-file-word" style="color: blue"></i> '.$item->file_name.'
                            </a>
                        </span>
                    </div>';
        } else if($item->message_type=="txt") {
            return '<div class="d-flex my-2 '. ($type=="sender"?"justify-content-end":"justify-content-start") .'">
                        <span style="max-width: 75%" class="py-1 px-3 rounded '. ($type=="sender"?"bg-danger text-white":"bg-light") .'">
                            <a href="'. asset("assets/complain/files/$item->file_name") .'" target="_blank" class="'. ($type=="sender"?"text-white":"") .'">
                            <i class="far fa-file-alt"></i> '.$item->file_name.'
                            </a>
                        </span>
                    </div>';
        }
        
    }
?>