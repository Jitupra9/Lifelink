<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />

  <link rel="stylesheet" href="style.css?v=<?= time(); ?> " />
  <title>Sign in & Sign up Form</title>
  <style>
    .input[type="email"] {
      width: 100%;
    }
  </style>
</head>

<body>
  <div class="container ">
    <div class="forms-container">
      <div class="message-box" id="signupMessage"></div>
      <div class="signin-signup">
        <form action="" class="sign-up-form" id="signupForm">
          <h2 class="title">Sign up</h2>
          <div class="input-field">

            <input type="text" placeholder="Username" name="username" required />
          </div>
          <div class="input-field">
            <input type="email" placeholder="Email" name="email" required />
          </div>
          <div class="input-field">

            <input type="password" placeholder="Password" name="password" required />
          </div>
          <select name="register_type" id="signup_register_type" class="select_register_type">
            <option value="User">USER</option>
            <option value="HOSPITAL">HOSPITAL</option>
          </select>
          <div class="input-field licence-field" style="display: none;">

            <input type="text" placeholder="Licence Number" name="Lincence_number" />
          </div>
          <input type="submit" class="btn" value="Sign up" />
        </form>

        <!-- SIGN-IN FORM -->
        <form class="sign-in-form" id="loginForm">
          <h2 class="title">Sign in</h2>
          <div class="input-field">

            <input type="text" name="email" placeholder="Enter the email" required />
          </div>
          <div class="input-field">

            <input type="password" name="password" placeholder="Enter the password" required />
          </div>
          <select name="register_type" id="signin_register_type" class="select_register_type">
            <option value="User">USER</option>
            <option value="HOSPITAL">HOSPITAL</option>
          </select>
          <input type="submit" value="Login" class="btn solid" />
        </form>


      </div>
    </div>

    <div class="panels-container">
      <div class="panel left-panel">
        <div class="content">
          <h3>New here ?</h3>
          <p>
            Don't have an account yet ? Sign up and get access to all our services.
          </p>
          <button class="btn transparent" id="sign-up-btn">
            Sign up
          </button>
        </div>
        <img src="img/log.svg" class="image" alt="" />
      </div>
      <div class="panel right-panel">
        <div class="content">
          <h3>One of us ?</h3>
          <p>
            Already made an account here? Sign in and get access to all our services.
          </p>
          <button class="btn transparent" id="sign-in-btn">
            Login
          </button>

        </div>
        <img src="img/register.svg" class="image" alt="" />
      </div>
    </div>
  </div>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"
    integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g=="
    crossorigin="anonymous" referrerpolicy="no-referrer"></script>

  <script src="app.js"></script>
  <script>
    $(document).ready(function () {
      $('#signupForm').on('submit', function (e) {
        e.preventDefault();
        console.log('Form submitted!');
        const formData = $(this).serialize();

        $.ajax({
          url: '../../../backend/signup.php',
          type: 'POST',
          data: formData,
          success: function (response) {
            console.log('AJAX success:', response);
            const messageBox = $('#signupMessage').removeClass('message-success message-error message-warning');
            let jsonResponse;
            try {
              jsonResponse = typeof response === 'string' ? JSON.parse(response) : response;
            } catch (e) {
              console.error('Response is not valid JSON:', response);
              console.log(err)
              showMessage('error', 'Something went wrong');
              console.log(e);
              return;
            }
            if (jsonResponse.success) {
              showMessage('success', jsonResponse.message || 'Sign-up successful!');
              $('#signupForm')[ 0 ].reset();
              setTimeout(() => {
                window.location.href = "http://localhost/Lifelink/";
              }, 3000);
            } else {
              console.warn('Backend error:', jsonResponse.message);
              showMessage('error', jsonResponse.message || 'Something went wrong');
            }
          },
          error: function (xhr, status, error) {
            console.error('AJAX error:', xhr.responseText || error);
            showMessage('error', 'Something went wrong');
          }
        });
      });
      $('#loginForm').on('submit', function (e) {
        e.preventDefault();
        const formData = $(this).serialize();
        $.ajax({
          url: '../../../backend/login.php',
          type: 'POST',
          data: formData,
          dataType: 'json',
          success: function (response) {
            if (response.success) {
              showMessage('success', response.message);
              setTimeout(() => {
                window.location.href = response.redirect || "http://localhost/Lifelink/";
              }, 2000);
            } else {
              showMessage('error', response.message);
            }
          },
          error: function (xhr, status, error) {
            showMessage('error', "server not respond");
          }
        });
      });
      $('#signup_register_type').on('change', function () {
        const selected = $(this).val();
        if (selected === 'HOSPITAL') {
          $('.licence-field').show();
          $('.licence-field input').prop('required', true);
        } else {
          $('.licence-field').hide();
          $('.licence-field input').prop('required', false);
        }
      }).trigger('change');
    });
    $("#sign-up-btn").click(function () {
      $(".container").addClass("sign-up-mode");
    });

    $("#sign-in-btn").click(function () {
      $(".container").removeClass("sign-up-mode");
      $(".container").addClass("sign-in-mode");
    });
    function showMessage(type, text) {
      const $messageBox = $(".message-box");
      $messageBox.removeClass("message-success message-error message-warning");

      if (type === "success") {
        $messageBox.addClass("message-success");
      } else if (type === "error") {
        $messageBox.addClass("message-error");
      } else if (type === "warning") {
        $messageBox.addClass("message-warning");
      }

      $messageBox.text(text).fadeIn();
      setTimeout(function () {
        $messageBox.fadeOut();
      }, 3000);
    }
  </script>
</body>

</html>