<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Login | Sistem Akreditasi JTI</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
  <style>
    body, html {
      height: 100%;
      margin: 0;
      font-family: 'Segoe UI', sans-serif;
    }

    .split-screen {
      display: flex;
      height: 100vh;
    }

    .left {
      flex: 1;
      background: url("{{ asset('images/as.jpg') }}") no-repeat center center / cover;
      color: white;
      display: flex;
      justify-content: center;
      align-items: center;
      text-align: left;
      padding: 40px;
      font-weight: 700;
      font-size: 2rem;
      background-blend-mode: overlay;
      background-color: rgba(0,0,0,0.4);
    }

    .right {
      flex: 1;
      display: flex;
      justify-content: center;
      align-items: center;
      background: linear-gradient(to bottom right, #d5d7ff, #e0e3f6);
    }

    .login-box {
      background: white;
      border-radius: 20px;
      padding: 40px;
      width: 100%;
      max-width: 400px;
      box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
      text-align: center;
    }

    .login-box img {
      height: 80px;
      margin-bottom: 10px;
    }

    .login-box h5 {
      margin-bottom: 30px;
      font-weight: 600;
    }

    .form-control, .form-select {
      border-radius: 10px;
    }

    .btn-login {
      border-radius: 10px;
      background-color: #4639ff;
      color: white;
      font-weight: bold;
    }

    .btn-login:hover {
      background-color: #352bc4;
    }

    .link-login {
      font-size: 0.9rem;
    }

    @media (max-width: 768px) {
      .split-screen {
        flex-direction: column;
      }

      .left {
        display: none;
      }
    }
  </style>
</head>
<body>

<div class="split-screen">
  <div class="left">
    <div>SELAMAT DATANG<br>SISTEM AKREDITASI JTI</div>
  </div>
  <div class="right">
    <div class="login-box">
      <img src="{{ asset('images/logoPolinema.png') }}" alt="Logo Polinema">
      <h5>SIGN IN</h5>
      @if ($errors->has('login_error'))
    <div class="alert alert-danger">
        {{ $errors->first('login_error') }}
    </div>
@endif
      <form method="POST" action="{{ route('login.post') }}">
        @csrf
        <div class="mb-3 text-start">
          <label for="username" class="form-label">Username :</label>
          <input type="text" class="form-control" id="username" name="username" required>
        </div>
        <div class="mb-3 text-start">
          <label for="role" class="form-label">Role :</label>
          <select class="form-select" id="role" name="role" required>
            <option selected disabled>Pilih Role</option>
            <option value="anggota">Anggota</option>
            <option value="validator">Validator</option>
          </select>
        </div>
        <div class="mb-4 text-start">
          <label for="password" class="form-label">Password :</label>
          <input type="password" class="form-control" id="password" name="password" required>
        </div>
        <button type="submit" class="btn btn-login w-100">Sign In</button>
      </form>
    </div>
  </div>
</div>

</body>
</html>