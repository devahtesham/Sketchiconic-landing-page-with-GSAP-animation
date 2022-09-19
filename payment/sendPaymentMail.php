
<?php
require_once 'config.php'; 

        use PHPMailer\PHPMailer\PHPMailer;
        use PHPMailer\PHPMailer\SMTP;
        use PHPMailer\PHPMailer\Exception;
        use PHPMailer\PHPMailer\OAuth;
        use PHPMailer\PHPMailer\POP3;



        require 'PHPMailer/src/Exception.php';
        require 'PHPMailer/src/PHPMailer.php';
        require 'PHPMailer/src/SMTP.php';
        require 'PHPMailer/src/OAuth.php';
        require 'PHPMailer/src/POP3.php';

        $mail = new PHPMailer();
        $to = 'sales@sketchiconic.com';
        $sale_mail="billing@sketchiconic.com";
        $from = ('All Aboout Animations');
        $mail->IsSMTP($from, $to);
        $mail->CharSet="UTF-8";
        $mail->SMTPSecure = 'ssl';
        $mail->Host = 'mail.sketchiconic.com';
        $mail->Port = 465;
        $mail->Username = 'billing@sketchiconic.com';
        $mail->Password = '5.Qu9+U2f*Xc';
        $mail->SMTPAuth = true;

        $mail->IsHTML(true);
        $mail->setFrom ($email, $from, $to);
        $mail->AddAddress($to);
        if ($sale_mail != '') {
        $mail->addcc($sale_mail); 
        }
        $mail->addcc($email); 
        $mail->Subject = "New Payment Recieved!";
        // $mail->Body = $message;




        $mail->Body = '<html><style>table, th, td {
			 
			  border-collapse: collapse;
			}
			th {
			    font-size: 14px;
			    padding:5px 10px 5px 2px;
			}
			td{
			    padding:5px 10px 5px 2px;
			}
			</style><body><div><img src="https://sketchiconic.com/assets/images/logo.png" class="mb-4" style="width: 200px;"></div>';
        //$mail->Body .= '<h1>Invoice Billing</h1>';

        $mail->Body .= '<p>Thank you for choosing <a href="https://sketchiconic.com/">Sketch Iconic</a>. We have successfully charged your card and below is a summary of your transaction.</p>';
        $mail->Body .= '<table style="text-align:left;"><thead><tr><th style="border:none"><h2>Payment Detail</h2></th></tr></thead>';

        $mail->Body .= '<tbody><tr><th style="font-size: 14px; padding:5px 10px 5px 2px; border: 1px solid black; border-collapse: collapse;">Transaction ID:</th><td style="padding:5px 10px 5px 2px; border: 1px solid black; border-collapse: collapse;"> '.$transactionID.'</td></tr>';
        $mail->Body .= '<tr><th style="font-size: 14px; padding:5px 10px 5px 2px; border: 1px solid black; border-collapse: collapse;">Paid Amount:</th><td style="padding:5px 10px 5px 2px; border: 1px solid black; border-collapse: collapse;"> '.$total_paid . $paid_amount_currency.'</td></tr>';
        $mail->Body .= '<tr><th style="font-size: 14px; padding:5px 10px 5px 2px; border: 1px solid black; border-collapse: collapse;">Payment Status:</th><td style="padding:5px 10px 5px 2px; border: 1px solid black; border-collapse: collapse;"> '.$payment_status.'</td></tr>';

        $mail->Body .= '<tr style="border:none"><th colspan="2" style="border:none"><h3 style="padding-top: 20px; text-align:left;">Project Details</th></td></tr>';

        $mail->Body .= '<tr><th style="font-size: 14px; padding:5px 10px 5px 2px; border: 1px solid black; border-collapse: collapse;">Clients Name:</th><td style="padding:5px 10px 5px 2px; border: 1px solid black; border-collapse: collapse;"> '.$name.'</td></tr>';
        $mail->Body .= '<tr><th style="font-size: 14px; padding:5px 10px 5px 2px; border: 1px solid black; border-collapse: collapse;">Desc:</th><td style="padding:5px 10px 5px 2px; border: 1px solid black; border-collapse: collapse;"> '.$description.'</td></tr>';
        $mail->Body .= '<tr><th style="font-size: 14px; padding:5px 10px 5px 2px; border: 1px solid black; border-collapse: collapse;">Service:</th><td style="padding:5px 10px 5px 2px; border: 1px solid black; border-collapse: collapse;"> '.$packages.'</td></tr>';
        $mail->Body .= '<tr><th style="font-size: 14px; padding:5px 10px 5px 2px; border: 1px solid black; border-collapse: collapse;">Email:</th><td style="padding:5px 10px 5px 2px; border: 1px solid black; border-collapse: collapse;"> '.$email.'</td></tr>';
        $mail->Body .= '<tr><th style="font-size: 14px; padding:5px 10px 5px 2px; border: 1px solid black; border-collapse: collapse;">Phone:</th><td style="padding:5px 10px 5px 2px; border: 1px solid black; border-collapse: collapse;"> '.$phone.'</td></tr>';

        $mail->Body .= '<tr style="border:none"><th colspan="2" style="border:none"><h3 style="padding-top: 20px; text-align:left;">Billing Details</th></td></tr>';

        $mail->Body .= '<tr><th style="padding:5px 10px 5px 2px; border: 1px solid black; border-collapse: collapse;">Name:</th><td style="padding:5px 10px 5px 2px; border: 1px solid black; border-collapse: collapse;"> '.$fname. ' '.$lname.'</td></tr>';
        $mail->Body .= '<tr><th style="font-size: 14px; padding:5px 10px 5px 2px; border: 1px solid black; border-collapse: collapse;">Address:</th><td style="padding:5px 10px 5px 2px; border: 1px solid black; border-collapse: collapse;"> '.$address.'</td></tr>';
        $mail->Body .= '<tr><th style="font-size: 14px; padding:5px 10px 5px 2px; border: 1px solid black; border-collapse: collapse;">Address2:</th><td style="padding:5px 10px 5px 2px; border: 1px solid black; border-collapse: collapse;"> '.$address2.'</td></tr>';
        $mail->Body .= '<tr><th style="font-size: 14px; padding:5px 10px 5px 2px; border: 1px solid black; border-collapse: collapse;">City:</th><td style="padding:5px 10px 5px 2px; border: 1px solid black; border-collapse: collapse;"> '.$city.'</td></tr>';
        $mail->Body .= '<tr><th style="font-size: 14px; padding:5px 10px 5px 2px; border: 1px solid black; border-collapse: collapse;">State:</th><td style="padding:5px 10px 5px 2px; border: 1px solid black; border-collapse: collapse;"> '.$state.'</td></tr>';
        $mail->Body .= '<tr><th style="font-size: 14px; padding:5px 10px 5px 2px; border: 1px solid black; border-collapse: collapse;">Zip:</th><td style="padding:5px 10px 5px 2px; border: 1px solid black; border-collapse: collapse;"> '.$zip.'</td></tr>';
        $mail->Body .= '<tr><th style="font-size: 14px; padding:5px 10px 5px 2px; border: 1px solid black; border-collapse: collapse;">Country:</th><td style="padding:5px 10px 5px 2px; border: 1px solid black; border-collapse: collapse;"> '.$country.'</td></tr>';
        $mail->Body .= '</tbody></table><br>';
		$mail->Body .= '<p>Please feel free to send us an email at billing@sketchiconic.com or call us at +1-(855) 212-9239 for billing related queries.</p>';
		$mail->Body .= '<p>Thank you for choosing <a href="https://sketchiconic.com/"> Sketch Iconic</a>.</p>';




        //echo $mail->Body;exit();

        if(!$mail->Send())
        {
            echo "Mailer Error: " . $mail->ErrorInfo;
            echo "email is not send";

        }
 

