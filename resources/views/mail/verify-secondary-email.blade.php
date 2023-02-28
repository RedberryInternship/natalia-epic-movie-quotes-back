<html>
   <style>
       @media only screen and (max-width: 500px) {
           *{
               font-size: 10px;
           }
       }
   </style>
   <body style="background: #181624; color:white;font-family: 'Montserrat', sans-serif; word-wrap: break-word; ">
    <div style="padding:3% 9%">
        <div style="text-align: center;font-size: 12px;margin-bottom: 75px">
            
            <h1 style="color:#DDCCAA; font-weight: 500">{{ __('mail.movie_qutes') }}</h1>
        </div>
        <p style="margin-bottom: 26px">{{ __('mail.hola') }} {{ $user->name }} ! </p>
        <p style="margin-bottom: 34px">{{ __('mail.verify_welcome_text') }}
        </p>
        <a href={{  config('app.frontend_url'). '/'. $local.'/profile?token='.$email->token.'&email='.$email->email }}
            style="max-width: 200px; padding:7px 13px;color:white;background:#E31221;text-decoration: none;font-weight: 400;
            border-radius:4px">{{ __('mail.verify_account') }}</a>
        <p style="margin-bottom: 24px;margin-top:40px">{{ __('mail.if_doesnot_work') }}</p>
        <a href={{  config('app.frontend_url'). '/'. $local.'/profile?token='.$email->token.'&email='.$email->email }}
            style="margin-bottom: 40px;color:#DDCCAA;text-decoration: none;cursor: pointer">
            {{  config('app.frontend_url'). '/'. $local.'/profile?token='.$email->token.'&email='.$email->email }}</a>
            <p style="margin-bottom: 24px">{{ __('mail.if_any_problems') }}</p>
           <p>{{ __('mail.movie_quotes_crew') }}</p>
    </div>
    </body>
</html>