<?php

namespace App\Core;

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

class Email
{
    private $senderName;
    private $senderEmail;
    private $password;
    private $SMTPhost;

    public function __construct()
    {
        $this->senderName = EMAIL_NAMA;
        $this->senderEmail = EMAIL_ADR;
        $this->password = EMAIL_PASS;
        $this->SMTPhost = SMTP_HOST;
    }

    public function sendMail($receiver, $subject = "Test subject", $body = "Test body")
    {
        return $this->send($receiver, $subject, $body);
    }

    public function sendMailWithAttachment($receiver, $subject, $body, $attachments = [])
    {
        return $this->send($receiver, $subject, $body, $attachments);
    }

    public function sendMailWithTemplate($receiver, $subject, $templatePath, $templateData = [])
    {
        if (!file_exists($templatePath)) {
            throw new Exception("Template file not found: " . $templatePath);
        }

        // Load template content
        $body = file_get_contents($templatePath);

        // Replace placeholders with actual data
        foreach ($templateData as $key => $value) {
            $body = str_replace('{{' . $key . '}}', $value, $body);
        }

        return $this->send($receiver, $subject, $body);
    }

    private function send($receiver, $subject, $body, $attachments = [])
    {
        $mail = new PHPMailer(true);
        try {
            // Server settings
            $mail->SMTPDebug = 0; // Disable verbose debug output
            $mail->isSMTP(); // Set mailer to use SMTP
            $mail->Host = $this->SMTPhost; // Specify main and backup SMTP servers
            $mail->SMTPAuth = true; // Enable SMTP authentication
            $mail->Username = $this->senderEmail; // SMTP username
            $mail->Password = $this->password; // SMTP password
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS; // Enable TLS encryption, `ssl` also accepted
            $mail->Port = 587; // TCP port to connect to (587 for TLS, 465 for SSL)

            // Validate email addresses
            if (!filter_var($this->senderEmail, FILTER_VALIDATE_EMAIL)) {
                throw new Exception('Invalid sender email address');
            }

            if (!filter_var($receiver, FILTER_VALIDATE_EMAIL)) {
                throw new Exception('Invalid receiver email address');
            }

            // Recipients
            $mail->setFrom($this->senderEmail, $this->senderName);
            $mail->addAddress($receiver); // Add a recipient
            $mail->addReplyTo($this->senderEmail);

            // Attachments
            foreach ($attachments as $attachment) {
                if (filter_var($attachment, FILTER_VALIDATE_URL)) {
                    $mail->addAttachment($attachment);
                } else {
                    throw new Exception("Invalid attachment URL: " . $attachment);
                }
            }

            // Content
            $mail->isHTML(true); // Set email format to HTML
            $mail->Subject = $subject;
            $mail->Body = $body;
            $mail->AltBody = strip_tags($body);

            $mail->send();
            return true;
        } catch (Exception $e) {
            echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}\n";
            return false;
        }
    }
}
