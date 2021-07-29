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
include_once $_SERVER['DOCUMENT_ROOT'] . '/extension/users/inc.php';
include_once $_SERVER['DOCUMENT_ROOT'] . '/extension/config/inc.php';

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
            //$this->getSelectArray("SELECT * FROM zay_smtp_emails WHERE ", $queryValues)
            // `email_body_file`='?',
            $query = "UPDATE `zay_smtp_emails` SET `email_subject`='?', `email_descr`='?', `email_reply_to`='?',`email_send`='?' "
                    . "WHERE `id`='?' ";
            return $this->query($query, array($email_subject, $email_descr, $email_reply_to, $email_send, $id), 0);
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
        $body_str = "<html><body>{$body}</body></html>";
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
        $replase_array = array('<html>', '</html>', '<body>', '</body>', '<head>', '</head>');
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

        $config = new \project\config();
        $site_title = $config->getConfigParam('site_title');
        $link_ed_mailto = $config->getConfigParam('link_ed_mailto');

        $body_str = '';
        $body_str = fileGet($file_url);
        // вставки системные http://getcourse.ru/notifications/unsubscribe/message/id/7461154924/h/93951
        $replaces = array(
            'site' => "{$_SERVER['HTTP_HOST']}",
            'site_url' => "{$_SERVER['REQUEST_SCHEME']}://{$_SERVER['HTTP_HOST']}",
            'link_site_url' => "<a href=\"{$_SERVER['REQUEST_SCHEME']}://{$_SERVER['HTTP_HOST']}\" target=\"_blank\">{$site_title}</a>",
            'site_title' => $site_title,
            'link_ed_mailto' => $link_ed_mailto,
            'site_ps' => '<div style=\"text-align: center;\">PS. Вы можете задать любой вопрос менеджеру, просто ответив на это письмо.</div>',
            'site_footer' => "<div style=\"text-align: center;background-color: #eee;padding: 10px;font-size: 0.7rem;margin-top: 20px;\">Вы получили это письмо, потому что регистрировались на сайте «{{link_site_url}}» </div>"
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
     * https://myaccount.google.com/u/0/lesssecureapps?pli=1&rapt=AEjHL4Ol_vs_Lq-qGdvCJbpcRTzlQK3LakI2iYSfeQSwNF_LoigTs-1-OAnTQiBdCXZ5cQYzgn_mpTXCIZXSpp7v7tybhg_wlw <br>
     * https://accounts.google.com/DisplayUnlockCaptcha <br/>
     * @param type $email_id тело сообщения
     * @param type $to_email кому отправить
     * @param type $params данные для замены
     * @return boolean
     */
    public function send($email_code, $to_email, $params = array()) {
        if (strlen($email_code) > 0 && strlen($to_email) > 0) {

            // Информиция по клиенту
            $p_user = new \project\user();
            $user_info = $p_user->user_info($to_email);
            $user_hello_text = '';
            if (isset($user_info['first_name']) && strlen($user_info['first_name']) > 0) {
                //$user_hello_text = "<p>Добрый день, <strong>{$user_info['first_name']}</strong>!</p>";
                $params['user_first_name'] = $user_info['first_name'];
            }

            if (strlen($params['user_first_name']) == 0) {
                $params['user_first_name'] = $user_info['email'];
            }

            if (strlen($params['user_fio']) > 0) {
                $params['user_first_name'] = $params['user_fio'];
            }

            if (strlen($user_info['email']) > 0) {
                $params['user_email'] = $user_info['email'];
            }

            if (!isset($params['user_password']) || strlen($params['user_password']) == 0) {
                $params['user_password'] = '*****';
            }

            //echo "email_code: {$email_code} to_email: {$to_email} <br/>\n";
            $mail = new PHPMailer(false);
            $smtp_user_info = $this->get_smtp_user_info();
            $email_info = $this->get_email($email_code);

            if (strlen($user_info['email']) > 0) {
                $email_info['email_reply_to'] = $user_info['email'];
            }
            //echo "user_info: {$smtp_user_info}<br/>\n";
            //echo "send_email: {$email_info['email_send']} <br/>\n";
            if ($email_info['email_send'] > 0) {
                // $email_info['email_body_file'] ;
                //echo 'user_email: ' . $params['user_email'] . "\n";
                $body = $this->file_get_html($email_info['email_body_file'], $params); //echo $body;
                //echo "body: {$body}<br/>\n";

                $body = $body;
                try {
                    //mail('koman1706@gmail.com','Тема','Сообщение 1');
                    // Для отправки HTML-письма должен быть установлен заголовок Content-type
//                    $headers = 'MIME-Version: 1.0' . "\r\n";
//                    $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
//
//                    // Дополнительные заголовки
//                    //$headers .= "To: <{$to_email}>\r\n";
//                    $headers .= "From: <{$email_info['email_reply_to']}>\r\n";
//                    echo "to: {$to_email} email_body_file: {$email_info['email_body_file']} subject: {$email_info['email_subject']} <br/>\n";
//                    // Отправляем
//                    $return = mail($to_email, $email_info['email_subject'], $body, $headers);
//                    var_dump($return);
//                  -----------------------------------------------------------------------------------  
                    // Server settings Не работает
                    $mail->SMTPDebug = SMTP::DEBUG_OFF; //DEBUG_SERVER; // for detailed debug output
                    $mail->isSMTP();
                    $mail->CharSet = "UTF-8";
                    //$mail->Host = 'smtp.gmail.com';

                    $mail->SMTPAuth = true;
                    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
                    //$mail->Port = 587; // google
                    $mail->SMTPDebug = 0;
                    $mail->SMTPSecure = 'tls';
                    //$mail->Port = 465;
                    //echo "u: {$smtp_user_info['user_email']} p: {$smtp_user_info['user_password']} \n";
                    $mail->Username = $smtp_user_info['user_email'];    // YOUR gmail email
                    $mail->Password = $smtp_user_info['user_password']; // YOUR gmail password    
                    // Sender and recipient settings
                    //if (strlen($params['user_email']) > 0) {
                    //    $mail->setFrom($params['user_email'], $params['user_first_name']); // от кого (email и имя)
                    //} else {
                        $mail->setFrom($smtp_user_info['user_email'], $email_info['email_subject']); // от кого (email и имя)
                    //}
                    $mail->addAddress($to_email, $email_info['email_subject']);
                    $mail->addReplyTo($email_info['email_reply_to'], $email_info['email_subject']); // to set the reply to
                    // Setting the email content L2f6lernBsFZ
                    // Отправка с нашего сервере    
                    $mail->Host = 'mail.edgardzaycev.com';
                    $mail->Port = 587;
                    $mail->SMTPOptions = array('ssl' => array('verify_peer' => false, 'verify_peer_name' => false, 'allow_self_signed' => true));

                    $mail->IsHTML(true);
                    // Если передали новую тему
                    if (isset($params['subject']) && strlen($params['subject']) > 0) {
                        $mail->Subject = $params['subject'];
                    } else {
                        $mail->Subject = $email_info['email_subject'];
                    }
                    $mail->Body = $body;
                    //$mail->AltBody = 'Plain text message body for non-HTML email client. Gmail SMTP email body.';
                    $return = $mail->send();
                    if (!$return) {
                        $_SESSION['errors'][] = $mail->ErrorInfo;
                        //echo "{$mail->ErrorInfo} <br/>\n";
                    }
                    return $return;
                    //echo "Email message sent. <br/>\n";
                    //return true;
                } catch (Exception $e) {
                    echo "Error in sending email. Mailer Error";
                    //$_SESSION['errors'][] = "Error in sending email. Mailer Error: {$mail->ErrorInfo}";
                }
            } else {
                $_SESSION['errors'][] = 'Нет настроек для отправки сообщений';
                return false;
            }
        } else {
            $_SESSION['errors'][] = 'Данные не заданы email_id или to_email - кому отправить';
        }
        return false;
    }

}
