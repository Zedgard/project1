<?php

session_start();

defined('__CMS__') or die;

include_once 'inc.php';
$sign_up_consultation = new \project\sign_up_consultation();


if (isset($_POST['consultation_s_save'])) {
    $_SESSION['consultation']['first_name'] = $_POST['first_name'];
    $_SESSION['consultation']['user_phone'] = $_POST['user_phone'];
    $_SESSION['consultation']['user_email'] = $_POST['user_email'];
    $_SESSION['consultation']['your_master'] = $_POST['your_master'];
    $_SESSION['consultation']['your_master_text'] = $_POST['your_master_text'];
    $_SESSION['consultation']['datepicker_data'] = $_POST['datepicker_data'];
    $_SESSION['consultation']['timepicker_data'] = $_POST['timepicker_data'];
}

/**
 * Получение данные по событиям
 */
if (isset($_POST['get_allevents'])) {
    include_once $_SERVER['DOCUMENT_ROOT'] . '/system/google-api-php-client-master/allevents.php';
    if (count($errors) == 0 && is_array($data)) {
        $result = array('success' => 1, 'success_text' => '', 'data' => $data);
    } else {
        $result = array('success' => 0, 'success_text' => $errors[0], 'data' => $data);
    }
}

/**
 * Получение данные по внутренним событиям
 */
if (isset($_POST['get_allevents_local'])) {
    $master_id = $_SESSION['consultation_id'];
    $data = $sign_up_consultation->get_master_consultations_full($master_id);
    if (is_array($data)) {
        $result = array('success' => 1, 'success_text' => '', 'data' => $data);
    } else {
        $result = array('success' => 0, 'success_text' => $errors[0], 'data' => $data);
    }
}

/**
 * Редактирование события
 */
if (isset($_POST['edit_events']) && strlen($_POST['event_id']) > 0) {
    $errors = array();
    include_once $_SERVER['DOCUMENT_ROOT'] . '/system/google-api-php-client-master/editevent.php';

    if (count($errors) == 0) {
        $result = array('success' => 1, 'success_text' => '', 'data' => $data);
    } else {
        $result = array('success' => 0, 'success_text' => $errors[0], 'data' => $data);
    }
}

/*
 * Список людей которые проводят консультации
 */
if (isset($_POST['get_consultation_master'])) {
    $data = $sign_up_consultation->get_consultation_master();
    $result = array('success' => 1, 'success_text' => '', 'data' => $data);
}
/**
 * Редактирование консультанта
 */
if (isset($_POST['master_edit'])) {
    $id = ($_POST['master_edit'] > 0) ? $_POST['master_edit'] : 0;
    $master_name = (strlen($_POST['master_name']) > 0) ? $_POST['master_name'] : '';
    $token_file_name = (strlen($_POST['token_file_name']) > 0) ? $_POST['token_file_name'] : '';
    $credentials_file_name = (strlen($_POST['credentials_file_name']) > 0) ? $_POST['credentials_file_name'] : '';
    $list_times = (count($_POST['list_times']) > 0) ? implode(',', $_POST['list_times']) : '';

    if (strlen($master_name) > 2) {
        if ($sign_up_consultation->edit_consultation_master($id, $master_name, $token_file_name, $credentials_file_name, $list_times)) {
            $result = array('success' => 1, 'success_text' => '');
        } else {
            $result = array('success' => 0, 'success_text' => 'Ошибка!');
        }
    } else {
        $result = array('success' => 0, 'success_text' => 'Ошибка! ФИО слишком короткое');
    }
}
/**
 * Удаление консультанта
 */
if (isset($_POST['master_delete'])) {
    $id = ($_POST['master_delete'] > 0) ? $_POST['master_delete'] : 0;
    if ($sign_up_consultation->delete_consultation_master($id)) {
        $result = array('success' => 1, 'success_text' => '');
    } else {
        $result = array('success' => 0, 'success_text' => 'Ошибка!');
    }
}

/**
 * Получим периоды для консультанта
 */
if (isset($_POST['get_master_consultation_periods'])) {
    $master_id = $_POST['master_id'];
    if ($master_id > 0) {
        $data = $sign_up_consultation->get_master_consultation_periods($master_id);
    } else {
        $data = array();
    }
    $result = array('success' => 1, 'success_text' => '', 'data' => $data);
}
/*
 * Добавление периода
 */
if (isset($_POST['add_master_consultation_period'])) {
    $master_id = $_POST['master_id'];
    if ($master_id > 0) {
        if ($sign_up_consultation->edit_consultation_period('0', $master_id, '1', '1', '100')) {
            $result = array('success' => 1, 'success_text' => '', 'data' => $data);
        }
    } else {
        $result = array('success' => 0, 'success_text' => '', 'data' => $data);
    }
}
/*
 * редактирование периода
 */
if (isset($_POST['edit_master_consultation_period'])) {
    $consultation_period = $_POST['consultation_period'];
    $master_id = $_POST['master_id'];
    $period_hour = $_POST['period_hour'];
    $periods_minute = $_POST['periods_minute'];
    $period_price = $_POST['period_price'];
    if ($master_id > 0) {
        if ($sign_up_consultation->edit_consultation_period($consultation_period, $master_id, $period_hour, $periods_minute, $period_price)) {
            $result = array('success' => 1, 'success_text' => '', 'data' => $data);
        }
    } else {
        $result = array('success' => 0, 'success_text' => '', 'data' => $data);
    }
}
/*
 * Удаление периода
 */
if (isset($_POST['delete_master_consultation_period'])) {
    $consultation_period = $_POST['consultation_period'];

    if ($consultation_period > 0) {
        if ($sign_up_consultation->delete_consultation_period($consultation_period)) {
            $result = array('success' => 1, 'success_text' => '', 'data' => $data);
        }
    } else {
        $result = array('success' => 0, 'success_text' => '', 'data' => $data);
    }
}

/*
 * Выбор консультанта и настроек по нему для отправки данных на google сервис
 */
if (isset($_POST['set_consultation_config'])) {
    $master_id = $_POST['set_consultation_config'];
    if ($sign_up_consultation->set_consultation_config($master_id)) {
        $result = array('success' => 1, 'success_text' => '', 'data' => $data);
    } else {
        $result = array('success' => 0, 'success_text' => 'Не определен консультант', 'data' => $data);
    }
}

if (isset($_POST['send_fast_consultation'])) {
    $send_emails = new \project\send_emails();
    $config = new \project\config();

    $fio = (isset($_POST['fio'])) ? $_POST['fio'] : '';
    $email = (isset($_POST['email'])) ? $_POST['email'] : '';
    $phone = (isset($_POST['phone'])) ? $_POST['phone'] : '';
    $topic = (isset($_POST['topic'])) ? $_POST['topic'] : '';

    $send_fast_consultation = $config->getConfigParam('send_fast_consultation');

    if (strlen($fio) > 0 && strlen($email) > 0 && strlen($phone) > 0 && strlen($topic) > 0) {
        // Письмо пользователю
        if ($send_emails->send('send_fast_consultation', $email, array(
                    'site' => 'https://www.' . $_SERVER['SERVER_NAME'],
                    'fio' => $fio, 'email' => $email, 'phone' => $phone, 'topic' => $topic))) {
            // Письмо менеджерам
            $send_emails->send('send_fast_consultation', $send_fast_consultation, array(
                'site' => 'https://www.' . $_SERVER['SERVER_NAME'],
                'fio' => $fio, 'email' => $email, 'phone' => $phone, 'topic' => $topic));

            $result = array('success' => 1, 'success_text' => '', 'data' => $data);
        } else {
            $result = array('success' => 0, 'success_text' => 'Ошибка отправки запроса на консультацию!', 'data' => $data);
        }
    } else {
        $result = array('success' => 0, 'success_text' => 'Необходимо заполнить все поля!', 'data' => $data);
    }
}

// Получить список купленных консультаций
if (isset($_POST['get_master_consultants'])) {
    $master_id = $_POST['master_id'];
    $data = $sign_up_consultation->get_master_consultations($master_id);
    $result = array('success' => 1, 'success_text' => '', 'data' => $data);
}
if (isset($_POST['get_consultations_id'])) {
    $data = $sign_up_consultation->get_consultations_id($_POST['event_id']);
    $result = array('success' => 1, 'success_text' => '', 'data' => $data);
}
