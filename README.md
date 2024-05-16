# Driver's License Registration System

This project is a simple web application for registering and applying for Plate Number's. It allows users to fill out a form with their personal information, generates a random Plate Number, stores the information in a database, and sends an email confirmation to the user.

## Features

- User-friendly registration form
- Random license number generation
- Database storage of user information
- Email confirmation upon successful registration

## Technologies Used

- HTML
- CSS
- PHP
- MySQL

## Setup

1. Clone the repository to your local machine:

2. Import the SQL file (`pnumber.sql`) to set up the database structure.

3. Update the database connection details in the PHP files (`config.php` and any other files where the connection is established).

4. Ensure that your server environment supports sending emails using the `sendmail()` function.

5. Access the application through your web server.

## Usage

1. Fill out the registration form with your personal information.

2. Submit the form.

3. Check your email for the confirmation message containing your license number.

## License

This project is licensed under the [MIT License](LICENSE).
