<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <style>
    .ball {
      width: 500px;
      height: 500px;
      background-color: #3498db;
      border-radius: 50%;
      border: 20px white dashed;
      position: absolute;
      z-index: 1;
    }
    #succes {
      position: absolute;
      top: 25%;
      left: 30%;
      z-index: 2;
      font-size: 125px;
      font-weight: 800;
    }
  </style>
  <link rel="stylesheet" href="style.css">
  <title>Gotowe</title>
</head>
<body style='overflow: hidden;'>
  
  <div id="ball"></div>
  

  <?php

    include 'dbFunctions.php';

$birthdate_bad = $_POST['birthdate'];
    $format = new DateTime($birthdate_bad);
    $birthdate_good = $format->format("Y-m-d");

    $UserData = [
      'firstname' => $_POST['firstname'],
      'lastname' => $_POST['lastname'],
      'password' => $_POST['password'],
      'birthdate' => $birthdate_good
    ];

    $birthdate_bad = $_POST['birthdate'];
    $format = new DateTime($birthdate_bad);
    $birthdate_good = $format->format("Y-m-d");

    $conn = ConnectToDB($dbData);

    InsertDataInto($conn, 'users', $UserData);
    
    unset($_POST);
    unset($conn, $UserData, $birthdate_bad, $birthdate_good, $format);
  ?>

  
  <script>
    const numberOfBalls = 20;
    const balls = [];

    for (let i = 0; i < numberOfBalls; i++) {
      createBall();
    }

    function createBall() {
      const ball = document.createElement('div');
      ball.className = 'ball';
      document.body.appendChild(ball);

      const x = Math.random() * (window.innerWidth - ball.clientWidth);
      const y = Math.random() * (window.innerHeight - ball.clientHeight);

      ball.style.left = x + 'px';
      ball.style.top = y + 'px';
      ball.style.borderRadius = ((Math.random() * 50) + '%');
      ball.style.height = ((Math.random() * 800) + 'px');
      ball.style.width = ball.style.height;
      ball.style.height = ball.style.width;
      ball.style.borderWidth = ((Math.random() * 25) + 'px');

      const xSpeed = (Math.random() - 0.5) * 50; // random horizontal speed
      const ySpeed = (Math.random() - 0.5) * 50; // random vertical speed

      const randomColor = getRandomColor();
      ball.style.backgroundColor = randomColor;
      const randomColor2 = getRandomColor();
      ball.style.borderColor = randomColor2;

      balls.push({ element: ball, x, y, xSpeed, ySpeed });
    }

    function getRandomColor() {
      const letters = '0123456789ABCDEF';
      let color = '#';
      for (let i = 0; i < 6; i++) {
        color += letters[Math.floor(Math.random() * 16)];
      }
      return color;
    }

    function animate() {
      for (const ball of balls) {
        
        // Update the position
        ball.x += ball.xSpeed;
        ball.y += ball.ySpeed;

        // Check boundaries and change direction if needed
        if (ball.x + ball.element.clientWidth > window.innerWidth || ball.x < 0) {
          ball.xSpeed = -ball.xSpeed;
        }

        if (ball.y + ball.element.clientHeight > window.innerHeight || ball.y < 0) {
          ball.ySpeed = -ball.ySpeed;
        }

        // Apply the new position
        ball.element.style.left = ball.x + 'px';
        ball.element.style.top = ball.y + 'px';
      }

      // Repeat the animation
      requestAnimationFrame(animate);
    }

    // Start the animation
    animate();
  </script>


</body>
</html>
