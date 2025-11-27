<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <title>Toko Kupiwww</title>
    <style>
      /* * * * * General CSS * * * * */
      *,
      *::before,
      *::after {
        box-sizing: border-box;
      }

      body {
        margin: 0;
        font-family: Arial, Helvetica, sans-serif;
        font-size: 16px;
        font-weight: 400;
        color: #666666;
        background: #eaeff4;
      }

      .wrapper {
        margin: 0 auto;
        width: 100%;
        max-width: 1140px;
        min-height: 100vh;
        display: flex;
        align-items: center;
        justify-content: center;
        flex-direction: column;
      }

      .container {
        position: relative;
        width: 100%;
        max-width: 600px;
        height: auto;
        display: flex;
        background: #ffffff;
        box-shadow: 0 0 15px rgba(0, 0, 0, 0.1);
      }

      .credit {
        position: relative;
        margin: 25px auto 0 auto;
        width: 100%;
        text-align: center;
        color: #666666;
        font-size: 16px;
        font-weight: 400;
      }

      .credit a {
        color: #222222;
        font-size: 16px;
        font-weight: 600;
      }

      /* * * * * Login Form CSS * * * * */
      h2 {
        margin: 0 0 15px 0;
        font-size: 30px;
        font-weight: 700;
      }

      h2 img {
        width: 120px;
      }

      p {
        margin: 0 0 20px 0;
        font-size: 16px;
        font-weight: 500;
        line-height: 22px;
      }

      .btn {
        display: inline-block;
        padding: 7px 20px;
        font-size: 16px;
        letter-spacing: 1px;
        text-decoration: none;
        border-radius: 5px;
        color: #ffffff;
        outline: none;
        border: 1px solid #ffffff;
        transition: 0.3s;
        -webkit-transition: 0.3s;
      }

      .btn:hover {
        color: #4caf50;
        background: #ffffff;
      }

      .col-left,
      .col-right {
        width: 55%;
        padding: 45px 35px;
        display: flex;
      }

      .col-left {
        width: 45%;
        background: #4caf50;
        -webkit-clip-path: polygon(
          98% 17%,
          100% 34%,
          98% 51%,
          100% 68%,
          98% 84%,
          100% 100%,
          0 100%,
          0 0,
          100% 0
        );
        clip-path: polygon(
          98% 17%,
          100% 34%,
          98% 51%,
          100% 68%,
          98% 84%,
          100% 100%,
          0 100%,
          0 0,
          100% 0
        );
      }

      @media (max-width: 575.98px) {
        .container {
          flex-direction: column;
          box-shadow: none;
        }

        .col-left,
        .col-right {
          width: 100%;
          margin: 0;
          padding: 30px;
          -webkit-clip-path: none;
          clip-path: none;
        }
      }

      .login-text {
        position: relative;
        width: 100%;
        color: #ffffff;
        text-align: center;
      }

      .login-form {
        position: relative;
        width: 100%;
        color: #666666;
      }

      .login-form p:last-child {
        margin: 0;
      }

      .login-form p a {
        color: #4caf50;
        font-size: 14px;
        text-decoration: none;
      }

      .login-form p:last-child a:last-child {
        float: right;
      }

      .login-form label {
        display: block;
        width: 100%;
        margin-bottom: 2px;
        letter-spacing: 0.5px;
      }

      .login-form p:last-child label {
        width: 60%;
        float: left;
      }

      .login-form label span {
        color: #ff574e;
        padding-left: 2px;
      }

      .login-form input {
        display: block;
        width: 100%;
        height: 40px;
        padding: 0 10px;
        font-size: 16px;
        letter-spacing: 1px;
        outline: none;
        border: 1px solid #cccccc;
        border-radius: 5px;
      }

      .login-form input:focus {
        border-color: #ff574e;
      }

      .login-form input.btn {
        color: #ffffff;
        background: #4caf50;
        border-color: #4caf50;
        outline: none;
        cursor: pointer;
      }

      .login-form input.btn:hover {
        color: #4caf50;
        background: #ffffff;
      }
    </style>
  </head>
  <body>
    <div class="wrapper">
      <div class="container">
        <div class="col-left">
          <div class="login-text">
            <h2>Toko Kupiwww</h2>
          </div>
        </div>
        <div class="col-right">
          <div class="login-form">
            <h2>Login</h2>
            <form id="loginform">
                @csrf
              <p>
                <input type="text" placeholder="email" name="email" id="email" required />
              </p>
              <p>
                <input type="password" placeholder="Password" name="password" id="password" required />
              </p>
              <p>
                <button class="btn" id="loginsubmit">Log In</button>
              </p>
            </form>
          </div>
        </div>
      </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        $(document).ready(function (){
            $('#loginsubmit').on('click', function (e) {
                 e.preventDefault();

                let email = $('#email').val();
                let password = $('#password').val();

                $.ajax({
                    url: '/login',
                    method: 'POST',
                    data: {
                        _token: '{{ csrf_token() }}',
                        email: email,
                        password: password
                    },
                    success: function (res) {
                        Swal.fire({
                            icon: 'success',
                            title: 'Login berhasil!',
                            showConfirmButton: false,
                            timer: 1500
                        }).then(() => {
                            window.location.href = res.redirect
                        })
                    },
                    error: function (xhr) {
                        let message = 'Terjadi kesalahan.'

                        if (xhr.status === 422) {
                            message = Object.values(xhr.responseJSON.errors).join('<br>')
                        }else if (xhr.responseJSON && xhr.responseJSON.message){
                            message = xhr.responseJSON.message
                        }

                        Swal.fire({
                            icon: 'error',
                            title: 'Login gagal!',
                            html: message,
                        })
                    }
                })
            })
        })
    </script>
  </body>
</html>
