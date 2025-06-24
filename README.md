# SQL Injection Detection and Prevention on DVWA

## Overview
This project explores SQL Injection (SQLi) vulnerabilities using the Damn Vulnerable Web Application (DVWA). It demonstrates detection of SQLi attempts, exploitation using test payloads, and protection via prepared statements and input validation.

## Tools Used
- DVWA (Damn Vulnerable Web Application)
- PHP and MySQL (MariaDB)
- Python (requests, BeautifulSoup)

## Steps Taken
1. Analyzed vulnerable PHP code that directly uses user input in SQL queries.
2. Created a Python script to automate SQLi payload testing.
3. Improved the PHP backend by:
   - Validating and blocking suspicious inputs.
   - Using prepared statements to safely query the database.
   - Logging malicious attempts for auditing.

## How to Run
1. Set up DVWA locally using XAMPP or a similar environment.
2. Replace the vulnerable PHP file with `secure.php`.
3. Run the Python script `sqli_detector.py` to test SQL Injection payloads.

## Results
- Vulnerable code allowed SQL Injection, exposing sensitive data.
- Secure code blocked malicious inputs and prevented exploitation.
- Logged suspicious attempts for future monitoring.

## Files
- `vulnerable.php`: Original vulnerable PHP code.
- `secure.php`: Improved secure PHP code.
- `sqli_detector.py`: Python script to test SQL Injection payloads.

---

Feel free to clone and modify as needed!
