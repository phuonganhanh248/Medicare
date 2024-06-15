<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
   $name = strip_tags(trim($_POST["name"]));
   $email = filter_var(trim($_POST["email"]), FILTER_SANITIZE_EMAIL);
   $subject = strip_tags(trim($_POST["subject"]));
   $message = trim($_POST["message"]);

   // Kiểm tra dữ liệu nhập vào
   if (empty($name) OR empty($message) OR !filter_var($email, FILTER_VALIDATE_EMAIL)) {
      // Đặt một mã lỗi 400 (bad request) và thoát.
      http_response_code(400);
      echo "Vui lòng hoàn thành form và gửi lại.";
      exit;
   }

   // Thiết lập nơi nhận mail
   $recipient = "chatgpt3010@gmail.com";

   // Thiết lập tiêu đề mail
   $subject = "New contact from $name";

   // Xây dựng nội dung email
   $email_content = "Name: $name\n";
   $email_content .= "Email: $email\n\n";
   $email_content .= "Subject: $subject\n";
   $email_content .= "Message:\n$message\n";

   // Xây dựng header của email
   $email_headers = "From: $name <$email>";

   // Gửi email
   if (mail($recipient, $subject, $email_content, $email_headers)) {
      // Đặt mã phản hồi thành 200 (OK)
      http_response_code(200);
      echo "Tin nhắn của bạn đã được gửi. Cảm ơn bạn!";
   } else {
      // Đặt mã phản hồi thành 500 (internal server error)
      http_response_code(500);
      echo "Rất tiếc, có điều gì đó không ổn và chúng tôi không thể gửi tin nhắn của bạn.";
   }

} else {
   // Không phải là phương thức POST
   http_response_code(403);
   echo "Có một vấn đề với yêu cầu của bạn, vui lòng thử lại.";
}
?>