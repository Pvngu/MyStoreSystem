<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="icon" href="assets/images/mgr-logo.png">
  <link rel="stylesheet" href="{{asset('css/login.css')}}">
  <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>

  <!-- google font -->
  
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@200;300;400;500&display=swap" rel="stylesheet">
  <title>Log into MyStore System</title>
</head>
<body>
  <div class="container">
    <div class="information">
      <h1>MyStore System</h1>
      <span>Inventory Management System</span>
      <span id="bottomText">System made only for educational purposes</span>
    </div>
    <div class="login-form">
      <form action="/login" method="post">
        @csrf
        <h1 class="loginText">Login</h1>
        <div class="input-box">
          <input name="email" type="email" placeholder="Email">
        </div>
        <div class="input-box">
          <input name="password" type="password" placeholder="Password">
        </div>
        <input id="loginButton" type="submit" value="Login">
        <div class="forgot open-button">Forgot Password?</div>
      </form>
      <dialog class="modal" id="modal">
        <i class='bx bx-x close-button'></i>
        <h1>Forgot password?</h1>
        <div class="modalContent">
          <p>Lorem ipsum, dolor sit amet consectetur adipisicing elit. Rerum hic dolor ex. Sequi, modi necessitatibus. Illum quam earum non dolorum, ratione totam neque unde officia.</p>
        </div>
      </dialog>
    </div>
  </div>
  <script>
    const modal = document.querySelector("#modal");
    const openModal = document.querySelector(".open-button");
    const closeModal = document.querySelector(".close-button");

    openModal.addEventListener("click", () => {
    modal.showModal();
    });

    closeModal.addEventListener("click", () => {
    modal.close();
    });
</script>
</body>
</html>