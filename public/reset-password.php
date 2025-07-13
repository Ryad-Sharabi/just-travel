<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Reset Password</title>
  <style>
    body {
      background: linear-gradient(to right, #3f51b5, #1a237e);
      font-family: 'Segoe UI', sans-serif;
      color: #fff;
      display: flex;
      align-items: center;
      justify-content: center;
      height: 100vh;
      margin: 0;
    }
    .card {
      background-color: rgba(255,255,255,0.08);
      padding: 30px;
      border-radius: 12px;
      width: 90%;
      max-width: 400px;
      box-shadow: 0 0 10px rgba(0,0,0,0.4);
    }
    h2 {
      text-align: center;
      margin-bottom: 25px;
    }
    input {
      width: 100%;
      padding: 12px;
      margin-bottom: 15px;
      border: none;
      border-radius: 6px;
    }
    button {
      width: 100%;
      padding: 12px;
      background-color: #3f51b5;
      border: none;
      border-radius: 6px;
      font-weight: bold;
      color: white;
      cursor: pointer;
    }
  </style>
</head>
<body>
  <div class="card">
    <h2>🔒 Reset Password</h2>
    <form method="POST" action="https://admin.justtravel.pro/api/reset-password">
      <input type="hidden" name="token" value="{token}">
      <input type="email" name="email" placeholder="Email" required />
      <input type="password" name="password" placeholder="New Password" required />
      <input type="password" name="password_confirmation" placeholder="Confirm Password" required />
      <button type="submit">Reset</button>
    </form>
  </div>
</body>
</html>
