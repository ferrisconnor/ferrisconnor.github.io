<?php
$statusMsg = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // 1. SET YOUR RECIPIENT EMAIL HERE
    $to = "your-email@example.com"; 

    // Sanitize input fields
    $name    = htmlspecialchars(trim($_POST['name']));
    $email   = filter_var(trim($_POST['email']), FILTER_SANITIZE_EMAIL);
    $subject = htmlspecialchars(trim($_POST['subject']));
    $message = htmlspecialchars(trim($_POST['message']));

    if (!empty($name) && !empty($email) && !empty($message)) {
        if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
            
            // Email Headers
            $headers  = "From: " . $name . " <" . $email . ">\r\n";
            $headers .= "Reply-To: " . $email . "\r\n";
            $headers .= "Content-Type: text/plain; charset=UTF-8\r\n";

            // Email Body
            $body  = "Name: $name\n";
            $body .= "Email: $email\n\n";
            $body .= "Message:\n$message\n";

            // Send Mail
            if (mail($to, $subject, $body, $headers)) {
                $statusMsg = "<p class='status-success'>Thank you! Your message has been sent.</p>";
            } else {
                $statusMsg = "<p class='status-error'>Oops! Something went wrong, please try again.</p>";
            }
        } else {
            $statusMsg = "<p class='status-error'>Please enter a valid email address.</p>";
        }
    } else {
        $statusMsg = "<p class='status-error'>Please fill in all required fields.</p>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Contact Us</title>
  <link rel="stylesheet" href="style.css">
</head>
<body>

  <div class="form-container">
    <h2>Contact Us</h2>
    
    <!-- Status message after sending -->
    <?php if (!empty($statusMsg)) { echo $statusMsg; } ?>

    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
      
      <div class="input-group">
        <label for="name">Full Name *</label>
        <input type="text" id="name" name="name" required placeholder="John Doe">
      </div>

      <div class="input-group">
        <label for="email">Email Address *</label>
        <input type="email" id="email" name="email" required placeholder="john@example.com">
      </div>

      <div class="input-group">
        <label for="subject">Subject</label>
        <input type="text" id="subject" name="subject" placeholder="How can we help?">
      </div>

      <div class="input-group">
        <label for="message">Message *</label>
        <textarea id="message" name="message" rows="5" required placeholder="Write your message here..."></textarea>
      </div>

      <button type="submit" class="submit-btn">Send Message</button>
      
    </form>
  </div>

</body>
</html>
