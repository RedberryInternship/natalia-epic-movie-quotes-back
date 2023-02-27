<html>
   <style>
       @media only screen and (max-width: 500px) {
           *{
               font-size: 10px;
           }
       }
   </style>


   <body style="background: #181624; color:white;font-family: 'Montserrat', sans-serif; word-wrap: break-word;">
       <div style="display: flex; flex-direction:column; gap: 2px;   justify-content: center; padding:3% 10% ">
           <div style="width:100%; text-align:center; padding-bottom:50px">
                <img src="{{ asset('images/notification.png') }}" alt="notification">
                <h1 style="font-size:18px;color:#DDCCAA; padding-top:9px">{{ __('mail.movie_qutes') }}</h1>
            </div>
           <p style="top: 30px">{{ __('mail.hola') }} ! </p>
           <p style="margin-bottom: 38px">{{ __('mail.verify_welcome_text') }}</p>
           <a href="{{ $url }}"
               style=" padding:7px 10px; text-align:center; max-width: 200px; color:white;background:#E31221;text-decoration: none;font-weight: 400; border-radius:5px">{{ __('mail.verify_account') }}</a>
           <p style="margin-bottom: 20px" >{{ __('mail.if_doesnot_work') }}</p>
           <a href="{{ $url }}"
               style="margin-bottom: 20px;color:#DDCCAA;text-decoration: none;cursor: pointer">
               {{$url }}</a>
           <p>{{ __('mail.if_any_problems') }}</p>
           <p>{{ __('mail.movie_quotes_crew') }}</p>
       </div>
      
   </body>


</html>
