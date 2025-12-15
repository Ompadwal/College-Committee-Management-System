-- ===============================
-- Database Creation
-- ===============================
CREATE DATABASE IF NOT EXISTS college_committee_db;
USE college_committee_db;


-- ===============================
-- Committees
-- ===============================
CREATE TABLE committees (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL
)


-- ===============================
-- Committee Members (Login / Approval)
-- ===============================
CREATE TABLE committee_members (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    email VARCHAR(255) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    mobile_no VARCHAR(15) NOT NULL,
    committee_id INT NOT NULL,
    is_approved TINYINT(1) DEFAULT 0,
    FOREIGN KEY (committee_id)
        REFERENCES committees(id)
        ON DELETE CASCADE
)


-- ===============================
-- Documents (PDF / DOC / Images)
-- ===============================
CREATE TABLE documents (
    id INT AUTO_INCREMENT PRIMARY KEY,
    committee_id INT NOT NULL,
    file_name VARCHAR(255) NOT NULL,
    file_path VARCHAR(255) NOT NULL,
    FOREIGN KEY (committee_id)
        REFERENCES committees(id)
        ON DELETE CASCADE
)


-- ===============================
-- Committee Members List (Display Only)
-- ===============================
CREATE TABLE members (
    id INT AUTO_INCREMENT PRIMARY KEY,
    committee_id INT NOT NULL,
    member_name VARCHAR(255) NOT NULL,
    designation VARCHAR(255) NOT NULL,
    FOREIGN KEY (committee_id)
        REFERENCES committees(id)
        ON DELETE CASCADE
)


-- ===============================
-- Events
-- ===============================
CREATE TABLE events (
    id INT AUTO_INCREMENT PRIMARY KEY,
    committee_id INT NOT NULL,
    event_name VARCHAR(255) NOT NULL,
    file_path VARCHAR(255) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (committee_id)
        REFERENCES committees(id)
        ON DELETE CASCADE
)


-- ===============================
-- Contact Messages
-- ===============================
CREATE TABLE contact_messages (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    email VARCHAR(100) NOT NULL,
    subject VARCHAR(200) NOT NULL,
    message TEXT NOT NULL,
    submission_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP
)


-- ===============================
-- Feedback
-- ===============================
CREATE TABLE feedback (
    id INT AUTO_INCREMENT PRIMARY KEY,
    category VARCHAR(255) NOT NULL,
    message TEXT NOT NULL,
    email VARCHAR(255) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
)


-- ===============================
-- Password Reset Tokens
-- ===============================
CREATE TABLE password_resets (
    id INT AUTO_INCREMENT PRIMARY KEY,
    committee_member_id INT NOT NULL,
    token VARCHAR(255) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (committee_member_id)
        REFERENCES committee_members(id)
        ON DELETE CASCADE
)

