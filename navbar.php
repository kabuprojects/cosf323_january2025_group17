<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hazardhub</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="styles1.css">
    <style>
        body {
            background-color:rgb(26, 73, 228);
            color: black;
        }

        nav {
            color: black;
            background-color:rgb(3, 15, 122);
            border-bottom-right-radius: 5px;
            border-bottom-left-radius: 10px;
            height: 70px;
        }

        .hero {
    display: flex;
    flex-wrap: wrap;
    align-items: center;
    justify-content: space-between;
    padding: 3rem 2rem;
    background-color: #f9f9f9;
  }
  
  .hero-content {
    flex: 1 1 40rem;
    max-width: 600px;
    margin-right: 2rem;
  }
  
  .hero-content h1 {
    font-size: 3rem;
    margin-bottom: 1rem;
    color: #611f69;
  }
  
  .hero-content p {
    font-size: 1.1rem;
    margin-bottom: 1.5rem;
  }
  
  .hero-cta {
    display: inline-block;
    padding: 0.75rem 1.5rem;
    background-color: #611f69;
    color: #fff;
    border-radius: 4px;
    text-decoration: none;
    font-weight: 600;
    transition: background-color 0.3s;
  }
  
  .hero-cta:hover {
    background-color: #4e1754;
  }
  
  .hero-image {
    flex: 1 1 20rem;
    display: flex;
    justify-content: center;
    margin-top: 2rem;
  }
  
  .hero-image img {
    max-width: 150%;
    height: auto;
    border-radius: 10px;
  }


        .feature-item h3 {
        margin-bottom: 0.5rem;
        color: #611f69;
         }

    /* FEATURES SECTION */
    .features {
    padding: 2rem;
    text-align: center;
  }
  
  .features h2 {
    font-size: 2rem;
    margin-bottom: 2rem;
  }
  
  .feature-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(240px, 1fr));
    gap: 2rem;
    max-width: 1200px;
    margin: 0 auto;
  }
  
  .feature-item {
    color: black;
    background-color: #fff;
    border: 1px solid #eee;
    border-radius: 8px;
    padding: 1.5rem;
    text-align: center;
  }
  
  .feature-item img {
    image-rendering: auto;
    image-orientation: flip;
    image-resolution: 16x16;
    margin-bottom: 1rem;
    width: 100px;
    height: 100px;
  }
  
  .feature-item h3 {
    margin-bottom: 0.5rem;
    color: #611f69;
  }
  
  /* CTA SECTION */
  .cta-section {
    background-color:rgb(13, 32, 199);
    color: #fff;
    text-align: center;
    padding: 3rem 2rem;
  }
  
  .cta-section h2 {
    font-size: 2rem;
    margin-bottom: 1rem;
  }
  
  .cta-section p {
    font-size: 1.2rem;
    margin-bottom: 1.5rem;
  }
  
  .btn-cta {
    display: inline-block;
    padding: 0.75rem 1.5rem;
    background-color: #fff;
    color: #611f69;
    border-radius: 4px;
    text-decoration: none;
    font-weight: 600;
    transition: background-color 0.3s, color 0.3s;
  }
  
  .btn-cta:hover {
    background-color: #e7e0e7;
  }
    </style>
</head>

<body>

    <nav class="navbar navbar-expand-lg navbar-dark" style="color:black;">
        <a class="navbar-brand" href="#" style="font-size: 40px;color: red;">HAZARD<span style="color:rgba(0, 0, 0, 0.8);">HUB</span></a>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav ml-auto" style="color: black;">
                <li class="nav-item"><a class="nav-link" href="#">Home</a></li>
                <li class="nav-item"><a class="nav-link" href="/pages/reports.php">reports</a></li>
                <li class="nav-item"><a class="nav-link" href="/pages/settings.php">Settings</a></li>
                <li class="nav-item"><a class="nav-link btn-get-started" href="/authentication/logout.php">Log out</a></li>
            </ul>
        </div>
    </nav>

  <section class="features" id="features">
    <h2>Features we provide to organisations</h2>
    <div class="feature-grid">
      <div class="feature-item">
        <img src="/css/images/riskass.svg" alt="Feature Icon" />
        <h3>Risk Assessment</h3>
        <p>
            Gain a clear understanding of potential threats facing your organization. Our risk assessment tool helps you identify, evaluate, and prioritize vulnerabilities, empowering you to make informed decisions and safeguard critical assets.
        </p>
      </div>
      <div class="feature-item">
        <img src="/css/images/nw.svg" alt="Feature Icon" />
        <h3>Network Scanning</h3>
        <p>
            Quickly discover every device connected to your network and map out their details in one place. With our network scanning feature, you’ll have an up-to-date view of your infrastructure, enabling proactive monitoring and rapid issue detection.
        </p>
      </div>
      <div class="feature-item">
        <img src="/css/images/portscan.svg" alt="Feature Icon" />
        <h3>Port Scanning</h3>
        <p>
            Identify open, closed, or filtered ports across your systems with ease. By pinpointing potential entry points, our port scanning tool helps you tighten security and minimize the risk of unauthorized access.
        </p>
      </div>
    </div>
  </section>

  <section class="cta-section">
    <h2>Ready to Get Started?</h2>
    <p>
      Sign up now and bring your team into a single workspace for all your cyber risk asessment needs
    </p>
    <a href="#" class="btn-cta">Get Started now</a>
  </section>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.0.7/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>