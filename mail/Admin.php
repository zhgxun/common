<?php

namespace common\mail;

class Admin
{
    public static $instance;
    public static function getInstance()
    {
        if (empty(self::$instance)) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    /**
     * 邮件发送
     * @param $template
     * @param array $params
     * @param string $to
     * @param array $cc
     * @param string $file
     * @param string $subject
     * @return bool
     */
    public function send($template, $params = [], $to = '', $cc = [], $file = '', $subject = '')
    {
        $mail = \Yii::$app->mailer->compose($template, $params)
            ->setFrom(['zhgxun1989@163.com' => 'Do Not Reply'])
            ->setTo($to);
        if ($cc) {
            $mail->setCc($cc);
        }
        if ($file && file_exists($file)) {
            $mail->attach($file);
        }
        $mail->setSubject($subject ? : '测试邮件,请勿回复');
        return $mail->send();
    }
}
