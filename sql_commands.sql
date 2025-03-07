CREATE TABLE roles (
    role_id INT AUTO_INCREMENT PRIMARY KEY,
    role_name VARCHAR(50) NOT NULL UNIQUE
);

CREATE TABLE users (
    user_id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) NOT NULL UNIQUE,
    email VARCHAR(100) NOT NULL UNIQUE,
    password_hash VARCHAR(255) NOT NULL,
    role_id INT NOT NULL DEFAULT 2, -- Default to "User"
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (role_id) REFERENCES roles(role_id) ON DELETE CASCADE
);

INSERT INTO roles (role_name) VALUES ('Admin');

INSERT INTO roles (role_name) VALUES ('User');


CREATE TABLE assets (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    asset_name VARCHAR(255) NOT NULL,
    ip_address VARCHAR(45) NULL,
    asset_type ENUM('server', 'database', 'website') NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(user_id) ON DELETE CASCADE
);

CREATE TABLE vulnerabilities (
    id INT AUTO_INCREMENT PRIMARY KEY,
    asset_id INT NOT NULL,
    vulnerability_name VARCHAR(255) NOT NULL,
    risk_level ENUM('Low', 'Medium', 'High', 'Critical') NOT NULL,
    description TEXT,
    mitigation TEXT,
    found_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (asset_id) REFERENCES assets(id) ON DELETE CASCADE
);

CREATE TABLE risk_assessment (
    id INT AUTO_INCREMENT PRIMARY KEY,
    asset_id INT NOT NULL,
    risk_score INT NOT NULL,
    impact ENUM('Low', 'Moderate', 'Severe', 'Catastrophic') NOT NULL,
    likelihood ENUM('Low', 'Medium', 'High', 'Critical') NOT NULL,
    recommendations TEXT,
    assessed_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (asset_id) REFERENCES assets(id) ON DELETE CASCADE
);

CREATE TABLE scan_results (
    ->     id INT AUTO_INCREMENT PRIMARY KEY,
    ->     asset_id INT,
    ->     user_id INT,
    ->     risk_level ENUM('Low', 'Medium', 'High'),
    ->     vulnerabilities TEXT,
    ->     scan_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    ->     FOREIGN KEY (asset_id) REFERENCES assets(id) ON DELETE CASCADE,
    ->     FOREIGN KEY (user_id) REFERENCES users(user_id) ON DELETE CASCADE
    -> );

