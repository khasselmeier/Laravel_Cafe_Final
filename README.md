This project is a website built with Laravel and MySQL that simulates a cafe ordering system. Users can register, browse a menu, place orders, and process payments through a test environment. The system is designed to demonstrate the differences between secure and vulnerable implementations within Laravel.

The project will include two versions of the backend:

A secure version that properly protects sensitive data, uses cryptographic techniques to ensure integrity, and prevents most common attacks
A vulnerable version that exposes the weakness of having an exposed .env file. Exploits RCE vulnerability by using a known API_KEY (that is extracted from the .env file) to generate malicious payloads to write a backdoor to the server
