<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>ToList - Landing Page</title>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
  <style>
    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
    }

    body {
      font-family: 'Poppins', sans-serif;
      background: linear-gradient(135deg, #ffe0e0, #ffc2c2);
      color: #333;
      overflow-x: hidden;
      position: relative;
    }

    .container {
      display: flex;
      align-items: center;
      justify-content: space-between;
      padding: 60px 80px;
      min-height: 100vh;
      position: relative;
      z-index: 2;
    }

    .left {
      max-width: 50%;
    }

    .left h1 {
      font-size: 60px;
      font-weight: 700;
      color: #ff5b5b;
      margin-bottom: 20px;
      text-shadow: 2px 2px 6px rgba(255, 0, 0, 0.1);
    }

    .left p {
      font-size: 22px;
      line-height: 1.7;
      margin-bottom: 40px;
      color: #444;
    }

    .left .btn {
      background-color: #ff6f6f;
      color: white;
      padding: 18px 40px;
      border: none;
      border-radius: 50px;
      font-size: 18px;
      font-weight: bold;
      box-shadow: 0 6px 12px rgba(0, 0, 0, 0.2);
      cursor: pointer;
      transition: all 0.3s ease;
      text-decoration: none;
    }

    .left .btn:hover {
      background-color: #e75050;
      transform: translateY(-2px);
    }

    .right img {
      max-width: 550px;
      animation: float 4s ease-in-out infinite;
    }

    @keyframes float {
      0%, 100% {
        transform: translateY(0);
      }
      50% {
        transform: translateY(-10px);
      }
    }

   
    .bg-shapes {
      position: absolute;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      overflow: hidden;
      z-index: 1;
    }

    .bg-shapes svg {
      position: absolute;
      opacity: 0.3;
    }

    .shape1 {
      top: -50px;
      left: -50px;
      width: 300px;
    }

    .shape2 {
      bottom: -60px;
      right: -60px;
      width: 250px;
    }

    .shape3 {
      top: 20%;
      right: 20%;
      width: 100px;
    }

    @media (max-width: 768px) {
      .container {
        flex-direction: column-reverse;
        padding: 40px 20px;
        text-align: center;
      }

      .left, .right {
        max-width: 100%;
      }

      .left h1 {
        font-size: 40px;
      }

      .left p {
        font-size: 18px;
      }

      .right img {
        width: 80%;
      }
    }
    
  </style>
</head>
<body>


<div class="bg-shapes">

  
  <svg class="shape1" viewBox="0 0 200 200" xmlns="http://www.w3.org/2000/svg">
    <path fill="#FFB6B6" d="M39.4,-60.5C50.7,-52.3,59.6,-42.6,65.5,-31.4C71.3,-20.2,74.1,-7.5,71.4,3.8C68.7,15.1,60.5,24.9,52.6,35.1C44.6,45.4,36.8,56.1,26.1,61.2C15.4,66.4,1.7,65.9,-11.7,62.5C-25,59.1,-37.9,52.7,-48.4,43.4C-59,34.1,-67.1,22,-68.6,9.3C-70.2,-3.4,-65.2,-16.7,-57.4,-28.2C-49.6,-39.6,-38.9,-49.1,-27,-57C-15.1,-64.9,-2,-71.3,10.6,-75.4C23.1,-79.5,46.2,-81.6,39.4,-60.5Z" transform="translate(100 100)" />
  </svg>

  <svg class="shape2" viewBox="0 0 200 200" xmlns="http://www.w3.org/2000/svg">
    <path fill="#FFD3D3" d="M40.5,-59.3C53.2,-52.3,65.8,-42.7,71.6,-30.1C77.4,-17.4,76.4,-1.7,72.8,12.3C69.1,26.3,62.7,38.6,52.6,48.5C42.4,58.4,28.6,66,14.5,67.9C0.4,69.9,-13.9,66.2,-27.4,60C-40.9,53.7,-53.6,44.8,-61.2,32.7C-68.7,20.5,-71.1,5.1,-68.2,-9.4C-65.3,-23.9,-57.1,-37.4,-45.8,-46.5C-34.5,-55.5,-20.3,-60.1,-5.3,-56.6C9.7,-53.1,19.3,-41.6,40.5,-59.3Z" transform="translate(100 100)" />
  </svg>


  <svg class="shape3" xmlns="http://www.w3.org/2000/svg" fill="#ff8e8e" viewBox="0 0 24 24">
    <circle cx="12" cy="12" r="10"/>
    <polyline points="9 12 11 14 15 10" fill="none" stroke="white" stroke-width="2"/>
  </svg>

  <svg class="shape4" xmlns="http://www.w3.org/2000/svg" fill="#ffa5a5" viewBox="0 0 24 24">
    <path d="M4 20v-3l11-11 3 3-11 11H4z"/>
    <path d="M14.5 6.5l3 3"/>
  </svg>

  <svg class="shape5" xmlns="http://www.w3.org/2000/svg" fill="#ffcaca" viewBox="0 0 24 24">
    <circle cx="12" cy="12" r="10"/>
    <line x1="12" y1="6" x2="12" y2="12" stroke="white" stroke-width="2"/>
    <line x1="12" y1="12" x2="16" y2="14" stroke="white" stroke-width="2"/>
  </svg>

  <svg class="dots1" width="120" height="120" viewBox="0 0 100 100" fill="none">
    <circle cx="10" cy="10" r="2" fill="#ffb3b3"/>
    <circle cx="30" cy="10" r="2" fill="#ffb3b3"/>
    <circle cx="50" cy="10" r="2" fill="#ffb3b3"/>
    <circle cx="10" cy="30" r="2" fill="#ffb3b3"/>
    <circle cx="30" cy="30" r="2" fill="#ffb3b3"/>
    <circle cx="50" cy="30" r="2" fill="#ffb3b3"/>
  </svg>

</div>



  <div class="container">
    <div class="left">
      <h1>ToList! </h1>
      <p>Ubah Ide Menjadi Aksi! ✍🏼<br>
         Buat, atur, dan selesaikan to-do list kamu dengan mudah.<br>
          Dengan ToList, kamu bisa mengelola tugas harianmu dengan lebih baik dan efisien. <br> 
        </p>
      <a href="/login" class="btn">Get Started 🚀</a>
    </div>

    <div class="right">
      <img src="{{ asset('assets/10.png') }}" alt="To-do Illustration" class="todo-img">
    </div>
  </div>

</body>
</html>
