<?php

namespace project;

defined('__CMS__') or die;

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

include_once $_SERVER['DOCUMENT_ROOT'] . '/system/extension/inc.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/system/PHPMailer/Exception.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/system/PHPMailer/PHPMailer.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/system/PHPMailer/SMTP.php';

class send_emails extends \project\extension {

    public function __construct() {
        parent::__construct();
    }

    /**
     * Создать изменить
     * @param type $id
     * @param type $email_subject
     * @param type $email_body_file
     * @param type $email_reply_to
     * @param type $email_send
     * @return type
     */
    public function edit_email_smtp($id, $email_subject, $email_descr, $email_body_file, $email_reply_to, $email_send) {
        if ($id > 0) {
            $query = "UPDATE `zay_smtp_emails` SET `email_subject`='?', `email_descr`='?', `email_body_file`='?',`email_reply_to`='?',`email_send`='?' "
                    . "WHERE `id`='?' ";
            return $this->query($query, array($email_subject, $email_descr, $email_body_file, $email_reply_to, $email_send, $id));
        } else {
            $query = "INSERT INTO `zay_smtp_emails`(`email_subject`, `email_descr`, `email_body_file`, `email_reply_to`, `email_send`) "
                    . "VALUES ('?','?','?','?','?')";
            return $this->query($query, array($email_subject, $email_descr, $email_body_file, $email_reply_to, $email_send));
        }
    }

    /**
     * Сохранить фаил
     * @param type $file_name
     * @param type $body
     * @return type
     */
    public function file_set($file_name, $body) {
        include_once $_SERVER['DOCUMENT_ROOT'] . '/class/functions.php';
        $file_url = __DIR__ . '/emails_tmpl/' . $file_name . '.php';
        $body_str = "<html><body>";
        $body_str .= $body . "\n";
        $body_str .= "</body></html>";
        return fileSet($file_url, $body_str);
    }

    /**
     * Получить фаил
     * @param type $file_name
     * @return type
     */
    public function file_get($file_name) {
        include_once $_SERVER['DOCUMENT_ROOT'] . '/class/functions.php';
        $file_url = __DIR__ . '/emails_tmpl/' . $file_name . '.php';
        $body_str = fileGet($file_url);
        $replase_array = array('<html>', '</html>', '<body>', '</body>', '<head>', '</head>',
            '<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">'
        );
        foreach ($replase_array as $value) {
            $body_str = str_replace($value, '', $body_str);
        }
        return $body_str;
    }

    /**
     * Получить фаил html
     * @param type $file_name
     * @param type $params
     * @return type
     */
    public function file_get_html($file_name, $params = array()) {
        include_once $_SERVER['DOCUMENT_ROOT'] . '/class/functions.php';
        $file_url = __DIR__ . '/emails_tmpl/' . $file_name . '.php';
        $body_str = fileGet($file_url);
        // вставки системные http://getcourse.ru/notifications/unsubscribe/message/id/7461154924/h/93951
        $replaces = array(
            'link_site_url' => "<a href=\"{$_SERVER['REQUEST_SCHEME']}://{$_SERVER['HTTP_HOST']}\" target=\"_blank\">{$_SESSION['site_title']}</a>",
            'site_ps' => '<div style=\"text-align: center;\">PS. Вы можете задать любой вопрос менеджеру, просто ответив на это письмо.</div>',
            'site_footer' => "<div style=\"text-align: center;background-color: #eee;padding: 10px;font-size: 0.7rem;margin-top: 20px;\">Вы получили это письмо, потому что регистрировались в проекте «{{link_site_url}}» </div>",
            'site_unsubscribe' => "<div style=\"text-align: center;font-size: 0.7rem;margin-top: 10px;margin-bottom: 20px;\">Если вы не хотите получать письма от нас, вы можете отписаться</div>",
        );
        foreach ($replaces as $key => $value) {
            $body_str = str_replace('{{' . $key . '}}', $value, $body_str);
        }
        foreach ($replaces as $key => $value) {
            $body_str = str_replace('{{' . $key . '}}', $value, $body_str);
        }

        // вставки переданные $params
        if (count($params) > 0) {
            foreach ($params as $key => $value) {
                $body_str = str_replace('{{' . $key . '}}', $value, $body_str);
            }
        }
        return $body_str;
    }

    /**
     * Получить настройку логин и пароль 
     * @return array
     */
    public function get_smtp_user_info() {
        $querySelect = "SELECT * FROM `zay_smtp_user`";
        return $this->getSelectArray($querySelect, array())[0];
    }

    /**
     * Редактирование параметров
     * @param type $user_email
     * @param type $user_password
     * @return bool
     */
    public function edit_smtp_user_info($user_email, $user_password) {
        $query = "UPDATE `zay_smtp_user` SET `user_email`='?',`user_password`='?' WHERE `id`=1 ";
        return $this->query($query, array($user_email, $user_password));
    }

    /**
     * Информация по конкретной рассылке
     * @param type $email_id
     * @return type
     */
    public function get_email($email_code) {
        $querySelect = "SELECT * FROM `zay_smtp_emails` e WHERE e.email_body_file='?' ";
        return $this->getSelectArray($querySelect, array($email_code))[0];
    }

    /**
     * Список всех рассылок
     * @return type
     */
    public function get_emails() {
        $querySelect = "SELECT * FROM `zay_smtp_emails` e order by e.`email_subject` desc ";
        return $this->getSelectArray($querySelect, array());
    }

    /**
     * Отправка сообщения<br>
     * Настроить по иструкции<br>
     * https://www.hostinger.ru/rukovodstva/kak-ispolzovat-smtp-server#-SMTP-Google<br>
     * Дать разрешение<br>
     * https://myaccount.google.com/u/0/lesssecureapps?pli=1&rapt=AEjHL4Ol_vs_Lq-qGdvCJbpcRTzlQK3LakI2iYSfeQSwNF_LoigTs-1-OAnTQiBdCXZ5cQYzgn_mpTXCIZXSpp7v7tybhg_wlw<br>
     * @param type $email_id тело сообщения
     * @param type $to_email кому отправить
     * @param type $params данные для замены
     * @return boolean
     */
    public function send($email_code, $to_email, $params = array()) {
        if (strlen($email_code) > 0 && strlen($to_email) > 0) {
            //echo "email_code: {$email_code} to_email: {$to_email} <br/>\n";
            $mail = new PHPMailer(false);
            $user_info = $this->get_smtp_user_info();
            $email_info = $this->get_email($email_code);
            //echo "user_info: {$user_info}<br/>\n";
            //echo "send_email: {$email_info['email_send']} <br/>\n";
            if ($email_info['email_send'] > 0) {
                // $email_info['email_body_file'] ;
                $body = $this->file_get_html($email_info['email_body_file'], $params); //echo $body;
                //echo "body: {$body}<br/>\n";
                try {
                    // Server settings
                    $mail->SMTPDebug = SMTP::DEBUG_OFF; //DEBUG_SERVER; // for detailed debug output
                    //$mail->isSMTP();
                    $mail->CharSet = "UTF-8";
                    //$mail->Host = 'smtp.gmail.com';
                    //$mail->Host = 'smtp.edgardzaycev.com';
                    //$mail->SMTPAuth = true;
                    //$mail->SMTPDebug = 1;
                    //$mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
                    //$mail->Port = 587; // google
                    //$mail->Port = 993;

                    //$mail->Username = $user_info['user_email']; // YOUR gmail email
                    //$mail->Password = $user_info['user_password']; // YOUR gmail password
                    //$mail->SMTPSecure = 'tls';    
                    //$mail->Username = 'admin@agenstvnet.ru'; // YOUR gmail email
                    //$mail->Password = 'Kopass1987'; // YOUR gmail password
                    // Sender and recipient settings
                    $mail->setFrom($user_info['user_email'], $email_info['email_subject']); // samodinskaya1611@mail.ru
                    $mail->addAddress($to_email, $email_info['email_subject']);
                    $mail->addReplyTo($email_info['email_reply_to'], $email_info['email_subject']); // to set the reply to
                    // Setting the email content
                    $mail->IsHTML(true);
                    $mail->Subject = $email_info['email_subject'];
                    $mail->Body = $body;
                    //$mail->AltBody = 'Plain text message body for non-HTML email client. Gmail SMTP email body.';
                    $return = $mail->send();
                    if (!$return) {
                        $_SESSION['errors'][] = $mail->ErrorInfo;
                        echo "{$mail->ErrorInfo} <br/>\n";
                    }
                    return $return;
                    //echo "Email message sent. <br/>\n";
                    //return true;
                } catch (Exception $e) {
                    //echo "Error in sending email. Mailer Error: {$mail->ErrorInfo}";
                    $_SESSION['errors'][] = "Error in sending email. Mailer Error: {$mail->ErrorInfo}";
                }
            } else {
                return true;
            }
        } else {
            $_SESSION['errors'][] = 'Данные не заданы email_id или to_email - коми отправить';
        }
        return false;
    }

}
