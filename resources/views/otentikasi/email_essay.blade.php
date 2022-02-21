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
                <div class="card-header">Your essay has just been checked by your checker</div>
                <div class="card-body">
                  <table>
                    <tr>
                      <td valign="top">1.</td>
                      <td align="left" style="text-align: justify; text-justify:inter-word;">
                        You got {{ $score_essay }} on your essay`s score.
                      </td>
                    </tr>
                    <tr>
                      <td valign="top">2.</td>
                      <td align="left" style="text-align: justify; text-justify:inter-word;">
                        If there are 2 (two) varians on your question, you may continue your next question`s varian
                        and score which is mentioned above is your temporary score.
                      </td>
                    </tr>
                    <tr>
                      <td valign="top">3.</td>
                      <td align="left" style="text-align: justify; text-justify:inter-word;">
                        If there is only 1 (one) varian on your question, score which is mentioned above is your final score.
                      </td>
                    </tr>
                    <tr>
                      <td colspan="2">
                        Best regards,<br/>Admin
                      </td>
                    </tr>
                  </table>
                </div>
           </div>
       </div>
    </div>
  </div>
</body>
<script src="{{ asset('stisla/assets/js/bootstrap-4.3.1.min.js') }}" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</html>