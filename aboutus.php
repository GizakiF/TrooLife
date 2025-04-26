<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="css/styles.css" />
  <link rel="stylesheet" href="css/global_styles.css" />
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.0/font/bootstrap-icons.css">
  <title>About Us | Your Company Name</title>
  <style>
    /* Hero Section */
    .hero {
      color: #fff;
      height: 100vh;
      display: flex;
      justify-content: center;
      align-items: center;
      text-align: center;
      flex-direction: column;
    }
    .hero h1 {
      font-size: 4rem;
      font-weight: 600;
      margin-bottom: 20px;
    }
    .hero p {
      font-size: 1.25rem;
      margin-bottom: 30px;
      max-width: 600px;
      margin-left: auto;
      margin-right: auto;
    }
    .btn-primary {
      background-color: #007377;
      border: none;
      font-weight: 600;
      padding: 15px 30px;
      font-size: 1rem;
      border-radius: 5px;
      transition: all 0.3s ease;
    }
    .btn-primary:hover {
      background-color: #007377;
      transform: scale(1.05);
    }
 
    .video-background {
        position: relative;
        width: 100%;
        height: 100vh; /* or whatever height you need */
        overflow: hidden;
    }
    .video-background video {
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        min-width: 100%;
        min-height: 100%;
        width: auto;
        height: auto;
        z-index: -1;
        object-fit: cover;
    }
    /* About Us Section */
    .about-us {
      padding: 80px 0;
      background-color: #fff;
      color: #333;
      box-shadow: 0 0 15px rgba(0, 0, 0, 0.1);
    }
    .about-us h2 {
      font-size: 2.5rem;
      text-align: center;
      color: #007377;
      font-weight: 600;
      margin-bottom: 30px;
    }
    .about-us p {
      font-size: 1.2rem;
      line-height: 1.8;
      text-align: center;
      color: #555;
      max-width: 800px;
      margin-left: auto;
      margin-right: auto;
    }
 
    /* Core Values Section */
    .core-values {
      background-color: #f8f9fa;
      padding: 60px 0;
      text-align: center;
    }
    .core-values .value-card {
      background-color: #fff;
      padding: 30px;
      border-radius: 10px;
      box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
      margin: 15px;
      transition: transform 0.3s ease, box-shadow 0.3s ease;
    }
    .core-values .value-card:hover {
      transform: translateY(-10px);
      box-shadow: 0 20px 40px rgba(0, 0, 0, 0.1);
    }
    .core-values h3 {
      font-size: 2rem;
      color: #007377;
      margin-bottom: 20px;
      font-weight: 600;
    }
    .core-values p {
      font-size: 1.1rem;
      color: #777;
    }
   
    /* Team Section */
    .team-section {
      padding: 80px 0;
      background-color: #fff;
    }
    .team-member {
      text-align: center;
      margin-bottom: 40px;
      transition: transform 0.3s ease, box-shadow 0.3s ease;
    }
    .team-member:hover {
      transform: translateY(-10px);
      box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
    }
    .team-member img {
      border-radius: 50%;
      width: 200px;
      height: 200px;
      object-fit: cover;
      border: 4px solid #fff;
      transition: transform 0.3s ease;
    }
    .team-member img:hover {
      transform: scale(1.1);
    }
    .team-member h5 {
      margin-top: 15px;
      font-size: 1.5rem;
      font-weight: 600;
      color: #333;
    }
    .team-member p {
      font-size: 1.125rem;
      color: #777;
    }
 
    /* Responsive */
    @media (max-width: 768px) {
      .hero h1 {
        font-size: 3rem;
      }
      .hero p {
        font-size: 1.1rem;
      }
    }
  </style>
</head>
<body>
  <!-- Header Section -->
  <?php include "header.php" ?>
  <div style="height: 40px;"></div>
 
 
  <!-- About Us Section -->
  <section id="about" class="about-us">
    <div class="container">
      <h2>Our Mission</h2>
      <p>Our mission is to provide high-quality products and services that not only meet but exceed customer expectations. We strive for excellence in every aspect of our work, aiming to make a positive impact in the lives of our customers.</p>
     
      <h2>Our Vision</h2>
      <p>We envision a future where our company leads the way in innovation and customer satisfaction, setting new industry standards and contributing positively to the global community.</p>
    </div>
  </section>
 
  <!-- Core Values Section -->
  <section class="core-values">
    <div class="container">
      <h2>Our Core Values</h2>
      <div class="row">
        <div class="col-md-4">
          <div class="value-card">
            <i class="bi bi-person-heart" style="font-size: 3rem; color: #007377;"></i>
            <h3>Customer-Centric</h3>
            <p>We put the needs and satisfaction of our customers at the forefront of everything we do.</p>
          </div>
        </div>
        <div class="col-md-4">
          <div class="value-card">
            <i class="bi bi-lightbulb" style="font-size: 3rem; color: #007377;"></i>
            <h3>Innovation</h3>
            <p>We embrace creativity and are constantly improving to bring new, cutting-edge solutions to our customers.</p>
          </div>
        </div>
        <div class="col-md-4">
          <div class="value-card">
            <i class="bi bi-recycle" style="font-size: 3rem; color: #007377;"></i>
            <h3>Sustainability</h3>
            <p>We are committed to protecting the environment and promoting sustainability in every decision we make.</p>
          </div>
        </div>
      </div>
    </div>
  </section>
 
  <!-- Team Section -->
  <section class="team-section">
    <div class="container">
      <h2 class="section-heading">Meet Our Team</h2>
      <div class="row">
        <div class="col-md-4 team-member">
          <img src="assets/images/gian.png" " alt="Team Member 1">
          <h5>Gian Frans Araneta</h5>
          <p>CEO & Founder</p>
        </div>
        <div class="col-md-4 team-member">
          <img src="assets/images/user.svg"  alt="Team Member 2">
          <h5>Nhiel Carlo Montellano</h5>
          <p>Head of Operations</p>
        </div>
        <div class="col-md-4 team-member">
          <img src="assets/images/brian.png" alt="Team Member 3">
          <h5>Brianmaine Orosa</h5>
          <p>Systems & Marketing Manager</p>
        </div>
      </div>
    </div>
  </section>
  <?php include "footer.php" ?>
  <!-- Scripts -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
