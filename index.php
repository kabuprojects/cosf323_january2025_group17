<!DOCTYPE html>
<html lang="en"><head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
  
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Risk Assessment Portal</title>
  <link rel="stylesheet" href="styles.css">
</head>
<body>
<?php include 'navbar.php'; ?>

  <main>
    <section id="assessment">
      <h2>Risk Assessment Form</h2>
      <form id="riskForm">
        <label for="riskTitle">Risk Title:</label>
        <input type="text" id="riskTitle" name="riskTitle" placeholder="Enter risk title" required="">

        <label for="riskDesc">Description:</label>
        <textarea id="riskDesc" name="riskDesc" placeholder="Describe the risk" rows="4" required=""></textarea>

        <label for="likelihood">Likelihood:</label>
        <select id="likelihood" name="likelihood" required="">
          <option value="">Select Likelihood</option>
          <option value="1">Low</option>
          <option value="2">Medium</option>
          <option value="3">High</option>
        </select>

        <label for="impact">Impact:</label>
        <select id="impact" name="impact" required="">
          <option value="">Select Impact</option>
          <option value="1">Low</option>
          <option value="2">Medium</option>
          <option value="3">High</option>
        </select>

        <button type="submit">Submit Assessment</button>
      </form>
    </section>

    <section id="results">
      <h2>Assessment Results</h2>
      <div id="resultDisplay">
      <h3>Risk Assessment Report: data breach</h3>
      <p><strong>Description:</strong> loss of files</p>
      <p><strong>Risk Score:</strong> 1</p>
      <p><strong>Risk Level:</strong> Low</p>
      <p><strong>Recommendations:</strong> This risk is assessed as Low. It is recommended to monitor the situation periodically and ensure that basic security measures remain in place.</p>
    </div>
    </section>
  </main>

  <footer>
    <p>© 2025 Risk Assessment Portal</p>
  </footer>

  <script src="./Risk Assessment Portal_files/script.js"></script>


</body></html>
