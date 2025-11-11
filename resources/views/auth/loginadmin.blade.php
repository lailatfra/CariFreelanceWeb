<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login Admin</title>
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
  <style>
    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
    }

    body {
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
      background: linear-gradient(135deg, #2c7dafff 0%, #1d75acff 50%, #1780c2 100%);
      min-height: 100vh;
      display: flex;
      align-items: center;
      justify-content: center;
      padding: 20px;
    }

    .login-container {
      background: rgba(255, 255, 255, 0.95);
      backdrop-filter: blur(10px);
      border-radius: 15px;
      box-shadow: 0 20px 40px rgba(44, 125, 175, 0.25);
      padding: 40px;
      width: 100%;
      max-width: 450px;
      border: 1px solid rgba(29, 117, 172, 0.2);
    }

    .logo-container {
      text-align: center;
      margin-bottom: 30px;
    }

    .logo-placeholder {
      width: 200px;
      height: 80px;
      background: rgba(255, 255, 255, 0.08);
      border-radius: 10px;
      margin: 0 auto;
      display: flex;
      align-items: center;
      justify-content: center;
      border: 1px solid rgba(255, 255, 255, 0.12);
      position: relative;
      overflow: hidden;
      transition: all 0.3s ease;
    }

    .logo-placeholder:hover {
      background: rgba(255, 255, 255, 0.12);
      border-color: rgba(255, 255, 255, 0.2);
      transform: translateY(-1px);
    }

    .logo-text {
      color: white;
      font-weight: bold;
      font-size: 18px;
      text-shadow: 1px 1px 2px rgba(0,0,0,0.3);
      z-index: 1;
      position: relative;
    }

    .login-header {
      text-align: center;
      margin-bottom: 35px;
    }

    .login-title {
      color: #2c7dafff;
      font-size: 28px;
      font-weight: 700;
      margin-bottom: 8px;
    }

    .login-subtitle {
      color: #64748b;
      font-size: 16px;
      font-weight: 400;
    }

    .form-group {
      margin-bottom: 25px;
      position: relative;
    }

    .form-control {
      width: 100%;
      padding: 12px 20px;
      padding-left: 50px;
      border: 2px solid #e2e8f0;
      border-radius: 8px;
      font-size: 14px;
      transition: all 0.25s ease;
      background: rgba(255, 255, 255, 0.9);
      color: #334155;
      font-weight: 500;
    }

    .form-control:focus {
      outline: none;
      border-color: #2c7dafff;
      box-shadow: 0 0 0 3px rgba(44, 125, 175, 0.1);
      background: white;
    }

    .form-control::placeholder {
      color: #94a3b8;
    }

    .input-icon {
      position: absolute;
      left: 18px;
      top: 50%;
      transform: translateY(-50%);
      color: #2c7dafff;
      font-size: 16px;
    }

    .btn-login {
      width: 100%;
      padding: 14px;
      background: linear-gradient(135deg, #2c7dafff, #1d75acff);
      color: white;
      border: none;
      border-radius: 8px;
      font-size: 16px;
      font-weight: 600;
      cursor: pointer;
      transition: all 0.25s ease;
      position: relative;
      overflow: hidden;
      border-left: 3px solid transparent;
    }

    .btn-login:hover {
      transform: translateY(-1px);
      box-shadow: 0 8px 20px rgba(44, 125, 175, 0.3);
      border-left-color: rgba(255, 255, 255, 0.6);
    }

    .btn-login:active {
      transform: translateY(0);
    }

    .divider {
      height: 1px;
      background: linear-gradient(90deg, transparent, #e2e8f0, transparent);
      margin: 30px 0;
    }

    .forgot-password {
      text-align: center;
    }

    .forgot-password a {
      color: #2c7dafff;
      text-decoration: none;
      font-size: 14px;
      font-weight: 500;
      transition: color 0.3s ease;
    }

    .forgot-password a:hover {
      color: #1d75acff;
      text-decoration: underline;
    }

    @media (max-width: 768px) {
      .login-container {
        padding: 30px 25px;
        margin: 10px;
      }
      
      .logo-placeholder {
        width: 160px;
        height: 65px;
      }
      
      .logo-text {
        font-size: 14px;
      }
      
      .login-title {
        font-size: 24px;
      }
    }

    .floating-elements {
      position: fixed;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      pointer-events: none;
      z-index: -1;
    }

    .floating-element {
      position: absolute;
      background: rgba(44, 125, 175, 0.1);
      border-radius: 50%;
      animation: float 6s ease-in-out infinite;
    }

    .floating-element:nth-child(1) {
      width: 80px;
      height: 80px;
      top: 20%;
      left: 10%;
      animation-delay: 0s;
    }

    .floating-element:nth-child(2) {
      width: 120px;
      height: 120px;
      top: 60%;
      right: 15%;
      animation-delay: 2s;
    }

    .floating-element:nth-child(3) {
      width: 60px;
      height: 60px;
      bottom: 20%;
      left: 20%;
      animation-delay: 4s;
    }

    @keyframes float {
      0%, 100% { transform: translateY(0px) rotate(0deg); }
      50% { transform: translateY(-20px) rotate(180deg); }
    }
  </style>
</head>
<body>
  <div class="floating-elements">
    <div class="floating-element"></div>
    <div class="floating-element"></div>
    <div class="floating-element"></div>
  </div>

  <div class="login-container">
    <div class="logo-container">
      <div class="logo-placeholder">
        <img src="{{ asset('images/logoutama.png') }}" alt="Logo" style="max-width: 100%; max-height: 100%; object-fit: contain;">
      </div>
    </div>

    <div class="login-header">
      <h1 class="login-title">Login Admin</h1>
      <p class="login-subtitle">Masukkan kredensial Anda untuk mengakses dashboard</p>
    </div>

    <form action="{{ route('login.admin.submit') }}" method="POST">
      @csrf
      <div class="form-group">
        <i class="fas fa-envelope input-icon"></i>
        <input type="email" name="email" class="form-control" placeholder="Masukkan Email..." required>
      </div>
      
      <div class="form-group">
        <i class="fas fa-lock input-icon"></i>
        <input type="password" name="password" class="form-control" placeholder="Masukkan Password..." required>
      </div>
      
      <button type="submit" class="btn-login">
        <i class="fas fa-sign-in-alt" style="margin-right: 8px;"></i>
        Login
      </button>
    </form>

    <div class="divider"></div>
    
    <div class="forgot-password">
      <a href="#">Lupa Password?</a>
    </div>
  </div>

  <script>
    // Add some interactive effects
    document.querySelectorAll('.form-control').forEach(input => {
      input.addEventListener('focus', function() {
        this.parentElement.querySelector('.input-icon').style.color = '#2c7dafff';
      });
      
      input.addEventListener('blur', function() {
        if (!this.value) {
          this.parentElement.querySelector('.input-icon').style.color = '#94a3b8';
        }
      });
    });

    // Login button click effect
    document.querySelector('.btn-login').addEventListener('click', function(e) {
      let ripple = document.createElement('span');
      let rect = this.getBoundingClientRect();
      let size = Math.max(rect.width, rect.height);
      let x = e.clientX - rect.left - size / 2;
      let y = e.clientY - rect.top - size / 2;
      
      ripple.style.cssText = `
        position: absolute;
        left: ${x}px;
        top: ${y}px;
        width: ${size}px;
        height: ${size}px;
        background: rgba(255,255,255,0.3);
        border-radius: 50%;
        transform: scale(0);
        animation: ripple 0.6s ease-out;
        pointer-events: none;
      `;
      
      this.appendChild(ripple);
      setTimeout(() => ripple.remove(), 600);
    });

    // Add ripple animation
    const style = document.createElement('style');
    style.textContent = `
      @keyframes ripple {
        to { transform: scale(2); opacity: 0; }
      }
    `;
    document.head.appendChild(style);
  </script>
</body>
</html>