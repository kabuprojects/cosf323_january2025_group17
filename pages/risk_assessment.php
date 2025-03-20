<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Risk Assessment</title>
    <link rel="stylesheet" href="styles.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            background-color: #f0f2f5;
            color: #333;
        }

        header {
            background-color: #007bff;
            color: white;
            padding: 10px 20px;
            text-align: center;
        }

        main {
            padding: 20px;
            max-width: 800px;
            margin: 0 auto;
            background: white;
            border-radius: 8px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        }

        h2 {
            color: #007bff;
            margin-bottom: 15px;
        }

        label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
        }

        input[type="text"],
        textarea,
        select {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #007bff;
            border-radius: 4px;
            box-sizing: border-box;
            transition: border-color 0.3s ease;
        }

        input[type="text"]:focus,
        textarea:focus,
        select:focus {
            border-color: #0056b3;
            outline: none;
        }

        button {
            background-color: #007bff;
            color: white;
            padding: 10px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            transition: background-color 0.3s ease;
            font-size: 16px;
            width: 100%;
        }

        button:hover {
            background-color: #0056b3;
        }

        footer {
            text-align: center;
            padding: 10px 0;
            background-color: #007bff;
            color: white;
            position: relative;
            bottom: 0;
            width: 100%;
        }

        @media (max-width: 600px) {
            main {
                padding: 15px;
            }
            button {
                padding: 8px;
            }
        }
    </style>
</head>
<body>
    <header>
        <h1>Risk Assessment Dashboard</h1>
    </header>

    <main>
        <section id="assessment">
            <h2>Risk Assessment Form</h2>
            <form id="riskForm">
                <label for="riskTitle">Risk Title:</label>
                <input type="text" id="riskTitle" name="riskTitle" placeholder="Enter risk title" required>

                <label for="riskDesc">Description:</label>
                <textarea id="riskDesc" name="riskDesc" placeholder="Describe the risk" rows="4" required></textarea>

                <label for="likelihood">Likelihood:</label>
                <select id="likelihood" name="likelihood" required>
                    <option value="">Select Likelihood</option>
                    <option value="1">Low</option>
                    <option value="2">Medium</option>
                    <option value="3">High</option>
                </select>

                <label for="impact">Impact:</label>
                <select id="impact" name="impact" required>
                    <option value="">Select Impact</option>
                    <option value="1">Low</option>
                    <option value="2">Medium</option>
                    <option value="3">High</option>
                </select>

                <button type="submit">Submit Assessment</button>
            </form>
        </section>
    </main>

    <footer>
        <p>© 2025 Risk Assessment Portal</p>
    </footer>

    <script src="./Risk Assessment Portal_files/script.js"></script>
</body>
</html>
