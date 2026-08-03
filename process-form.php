<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $to = "connorkeekees@gmail.com"; // Your email address

    $name    = htmlspecialchars(trim($_POST['name']));
    $email   = filter_var(trim($_POST['email']), FILTER_SANITIZE_EMAIL);
    $subject = htmlspecialchars(trim($_POST['subject']));
    $message = htmlspecialchars(trim($_POST['message']));

    if (!empty($name) && !empty($email) && !empty($message)) {
        $headers  = "From: " . $name . " <" . $email . ">\r\n";
        $headers .= "Reply-To: " . $email . "\r\n";

        $body = "Name: $name\nEmail: $email\n\nMessage:\n$message";

        if (mail($to, $subject, $body, $headers)) {
            // Redirect back to HTML page with success message
            header("Location: contact.html?status=success");
            exit();
        }
    }
    
    header("Location: contact.html?status=error");
    exit();
}
?>
