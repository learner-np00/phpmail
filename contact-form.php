<?php
// here create a contact form and when user submit the form, save the data in database and send the email to admin
if (isset($_POST['submit'])) {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $message = $_POST['message'];

    //validate form data
    $nameErr = $emailErr = $messageErr = "";
    if (empty($name)) {
        $nameErr = "Name is required";
    }
    if (empty($email)) {
        $emailErr = "Email is required";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $emailErr = "Invalid email format";
    }
    if (empty($message)) {
        $messageErr = "Message is required";
    }

    // Check if all fields are valid
    if (empty($nameErr) && empty($emailErr) && empty($messageErr)) {

        // Save data in database
        // $query = "INSERT INTO contact (name, email, message) VALUES ('$name', '$email', '$message')";
        // $result = mysqli_query($conn, $query);

        // if($result){
        // Send email to admin
        $to = $email;
        $subject = "Contact form submitted";
        $mailContent = "Hello Admin,
        \n\nYou have received a new message from the contact form on your website.
        \n\nDetails:\nName: $name\nEmail: $email\nMessage: $message.
        \n\nThank you!
        \n\nBest Regards,
        \n PHP BuiltIn Mail";
        // Send email
        if (mail($to, $subject, $mailContent)) {
            echo "<script>alert('Mail sent successfully.')</script>";
        } else {
            echo "<script>alert('Mail not sent.')</script>";
        }
        // }


    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Contact Form</title>

    <link rel="stylesheet" href="bootstrap/css/bootstrap.css">
</head>

<body>
    <div class="container d-flex justify-content-center">
        <form method="post" class="row g-3">
            <h3 class="text-center mt-5">Contact Form</h3>
            <div class="col-sm-12">
                <label class="form-label" for="name">Name</label>
                <input type="text" class="form-control" id="name" name="name" placeholder="Your name..">
                <span class="text-danger"><?php echo $nameErr ?? '' ?></span>
            </div>


            <div class="col-sm-12">
                <label class="form-label" for="email">Email</label>
                <input type="text" class="form-control" id="email" name="email" placeholder="Your email..">
                <span class="text-danger"><?php echo $emailErr ?? '' ?></span>
            </div>
            <div class="col-sm-12">
                <label class="form-label" for="message">Message</label>
                <textarea id="message" class="form-control" name="message" placeholder="Write something.." rows="5"></textarea>
                <span class="text-danger"><?php echo $messageErr ?? '' ?></span>
            </div>
            <div class="col-sm-12">
                <input class="btn btn-outline-success" type="submit" name="submit" value="Submit">
            </div>

        </form>
    </div>
</body>

</html>