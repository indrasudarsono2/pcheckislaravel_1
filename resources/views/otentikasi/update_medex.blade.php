<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <link rel="stylesheet" href="{{ asset('stisla/assets/css/bootstrap.min.css') }}" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

  <title>email</title>
</head>
<body>
  <div class="container">
     <div class="row justify-content-center">
      <img src="{{ asset('Login/images/logo2.png') }}" alt="logo" width="120" style="display: block; margin-left: auto; margin-right: auto;">
    </div>
    <div class="row justify-content-center mt-4">
        <div class="col">
            <div class="card">
                <div class="card-header">
                  <p style="text-align: justify; text-justify:inter-word;">
                    Dear, {{$medex->user->name}}<br><br>

                    Regarding Excemption letter from DGCA number: AU.308/6/13/DRJU.DNP-2022, 
                    your age and expiration date of MEDEX are meeting requirements.
                    Now your MEDEX expiration data becomes 4 years from the release date ({{ $medex->expired->format('d F Y') }}).
                    We kindly advise you to always keep your body fit during this Excemption.
                    By the time you suffer unfit condition, you will have had the next MEDEX Test,
                    so advise to your Junior Manager immediately about your condition.
                    The last, don`t forget to update your MEDEX expiration data in E-Chain.<br><br>
                    
                    Sincerely yours,<br>Admin
                  </p>
              </div>
            </div>
       </div>
    </div>
  </div>
</body>
<script src="{{ asset('stisla/assets/js/bootstrap-4.3.1.min.js') }}" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</html>