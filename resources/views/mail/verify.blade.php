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
               <h1 style="color:#DDCCAA; font-weight: 500">MOVIE QUOTES</h1>
           </div>
           <p style="top: 25px">Hola! </p>
           <p style="margin-bottom: 32px">Thanks for joining Movie quotes! We really appreciate it. Please click the button below to verify your account:</p>
           <a href="{{ $url }}"
               style=" padding:7px 10px; text-align:center; max-width: 128px; color:white;background:#E31221;text-decoration: none;font-weight: 400; border-radius:5px">Verify account</a>
           <p >If clicking doesn't work, you can try copying and pasting it to
               your browser:</p>
           <a href="{{ $url }}"
               style="margin-bottom: 20px;color:#DDCCAA;text-decoration: none;cursor: pointer">
               {{$url }}</a>
           <p>If you have any problems, please contact us: support@moviequotes.ge</p>
           <p>MovieQuotes Crew</p>
       </div>
      
   </body>


</html>
