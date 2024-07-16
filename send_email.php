<?php
// Collect form data
$name = $_POST['name'];
$phone = $_POST['phone'];
$email = $_POST['email'];
$message = $_POST['message'];

// Set recipient email address
$to = 'divyatharani1911@gmail.com';

// Set email subject
$subject = 'New Contact Form Submission';

// Compose email message
$message_body = "Name: $name\n";
$message_body .= "Phone: $phone\n";
$message_body .= "Email: $email\n\n";
$message_body .= "Message:\n$message";

// Set headers
$headers = "From: $email\r\n";
$headers .= "Reply-To: $email\r\n";

// Send email
if (mail($to, $subject, $message_body, $headers)) {
    echo '<p>Your message has been sent successfully. We will contact you shortly.</p>';
} else {
    echo '<p>Sorry, there was an error sending your message. Please try again later.</p>';
}
?>
