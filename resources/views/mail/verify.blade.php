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
           <img src="{{ asset('images/notification.png') }}" alt="notification" style="width: 22px; margin: 0 auto">
           <div style=" margin-bottom: 65px text-align: center; font-size: 12px; margin:auto">
               <h1 style="color:#DDCCAA; font-weight: 500">{{ __('mail.movie_qutes') }}</h1>
           </div>
           <p style="top: 25px">{{ __('mail.hola') }} ! </p>
           <p style="margin-bottom: 32px">{{ __('mail.verify_welcome_text') }}</p>
           <a href="{{ $url }}"
               style=" padding:7px 10px; text-align:center; max-width: 200px; color:white;background:#E31221;text-decoration: none;font-weight: 400; border-radius:5px">{{ __('mail.verify_account') }}</a>
           <p >{{ __('mail.if_doesnot_work') }}</p>
           <a href="{{ $url }}"
               style="margin-bottom: 20px;color:#DDCCAA;text-decoration: none;cursor: pointer">
               {{$url }}</a>
           <p>{{ __('mail.if_any_problems') }}</p>
           <p>{{ __('mail.movie_quotes_crew') }}</p>
       </div>
      
   </body>


</html>
