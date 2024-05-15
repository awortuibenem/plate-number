<?php
include "config.php";
include "mail.php";
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Plate Number Registration</title>
<link rel="stylesheet" href="css/style.css">
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
</head>

<body>

    <div class="container">
        <h2>Plate Number Registration</h2>
        <form method="post">
            <label for="fullname">Full Name:</label>
            <input type="text" id="fullname" name="fullname" required><br>

            <label for="email">Email:</label>
            <input type="email" id="email" name="email" required><br>

            <label for="address">Address:</label>
            <input type="text" id="address" name="address" required><br>

            <label for="dob">Date of Birth:</label>
            <input type="date" id="dob" name="dob" required><br>

            <label for="state">State:</label>
            <select id="state" name="state" required>
                <option value="">Select State</option>
                <option value="Abia">Abia</option>
                <option value="Adamawa">Adamawa</option>
                <option value="Akwa Ibom">Akwa Ibom</option>
                <option value="Anambra">Anambra</option>
                <option value="Bauchi">Bauchi</option>
                <option value="Bayelsa">Bayelsa</option>
                <option value="Benue">Benue</option>
                <option value="Borno">Borno</option>
                <option value="Cross River">Cross River</option>
                <option value="Delta">Delta</option>
                <option value="Ebonyi">Ebonyi</option>
                <option value="Edo">Edo</option>
                <option value="Ekiti">Ekiti</option>
                <option value="Enugu">Enugu</option>
                <option value="FCT">FCT</option>
                <option value="Gombe">Gombe</option>
                <option value="Imo">Imo</option>
                <option value="Jigawa">Jigawa</option>
                <option value="Kaduna">Kaduna</option>
                <option value="Kano">Kano</option>
                <option value="Katsina">Katsina</option>
                <option value="Kebbi">Kebbi</option>
                <option value="Kogi">Kogi</option>
                <option value="Kwara">Kwara</option>
                <option value="Lagos">Lagos</option>
                <option value="Nasarawa">Nasarawa</option>
                <option value="Niger">Niger</option>
                <option value="Ogun">Ogun</option>
                <option value="Ondo">Ondo</option>
                <option value="Osun">Osun</option>
                <option value="Oyo">Oyo</option>
                <option value="Plateau">Plateau</option>
                <option value="Rivers">Rivers</option>
                <option value="Sokoto">Sokoto</option>
                <option value="Taraba">Taraba</option>
                <option value="Yobe">Yobe</option>
                <option value="Zamfara">Zamfara</option>
            </select>


            <br>

            <input type="submit" value="Register">
        </form>
    </div>

</body>

</html>
<?php
include "config.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $fullname = $_POST['fullname'];
    $email = $_POST['email'];
    $address = $_POST['address'];
    $dob = $_POST['dob'];
    $state = $_POST['state'];

    $license_number = generate_license_number();

    $sql = "INSERT INTO users (fullname, email, address, dob, state, license_number) 
            VALUES ('$fullname', '$email', '$address', '$dob', '$state', '$license_number')";

    if ($conn->query($sql) === TRUE) {
        $subject = "Your Driver's License Information";
        $message = "<html><body>";
        $message .= "<p>Dear $fullname,</p>";
        $message .= "<p>Thank you for registering for your driver's license.</p>";
        $message .= "<p>Here is your license number: $license_number</p>";
        $message .= "<p>Please keep this information safe.</p>";
        $message .= "<p>Regards,<br>The Driver's License Registration Team</p>";
        $message .= "</body></html>";
        $headers = "MIME-Version: 1.0" . "\r\n";
        $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
        $headers .= "From: your_email@example.com" . "\r\n";

        if (sendmail($email, $subject, $message, $headers)) {
            echo "<script>
                    Swal.fire({
                        icon: 'success',
                        title: 'Registration successful!',
                        text: 'License number sent to your email.',
                        showConfirmButton: false,
                        timer: 3000
                    }).then(function() {
                        window.location.href = 'index';
                    });
                  </script>";
        } else {
            echo "<script>
                    Swal.fire({
                        icon: 'error',
                        title: 'Failed to send email',
                        text: 'Please try again later.',
                        showConfirmButton: false,
                        timer: 3000
                    }).then(function() {
                        window.location.href = 'index';
                    });
                  </script>";
        }
    } else {
        echo "<script>
                Swal.fire({
                    icon: 'error',
                    title: 'Registration failed',
                    text: 'Please try again later.',
                    showConfirmButton: false,
                    timer: 3000
                }).then(function() {
                    window.location.href = 'index';
                });
              </script>";
    }

    $conn->close();
}

function generate_license_number() {
    $letters = range('A', 'Z');
    $numbers = range(0, 9);
    shuffle($letters);
    shuffle($numbers);
    $random_letters = array_slice($letters, 0, 3);
    $random_numbers = array_slice($numbers, 0, 3);
    $random_letters_two = array_slice($letters, 0, 2);
    $license_array = array_merge($random_letters, $random_numbers, $random_letters_two);
    shuffle($license_array);
    return implode("", $license_array);
}
?>
