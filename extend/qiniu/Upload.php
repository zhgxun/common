<?php

namespace common\extend\qiniu;

require __DIR__ . '/autoload.php';

use Qiniu\Auth;
use Qiniu\Storage\BucketManager;
use Qiniu\Storage\UploadManager;

class Upload
{
    private $accessKey;
    private $secretKey;
    private $bucket;
    private $auth;
    private $token;
    public static $instance;

    public static function getInstance()
    {
        if (empty(self::$instance)) {
            self::$instance = new self();
        }

        return self::$instance;
    }

    public function __construct()
    {
        $this->accessKey = \Yii::$app->params['qiniu']['ak'];
        $this->secretKey = \Yii::$app->params['qiniu']['sk'];
        $this->auth = new Auth($this->accessKey, $this->secretKey);
        $this->bucket = \Yii::$app->params['qiniu']['bucket'];
        $this->token = $this->auth->uploadToken($this->bucket);
    }

    /**
     * 上传图片
     * @param string $fileName 图片名
     * @param string $filePath 图片存放路径
     * @return mixed ['hash' => '', 'key' => ''] 成功后的文件名保存在key=>value中
     * @throws \Exception
     */
    public function uploadFile($fileName, $filePath = './')
    {
        list($ret, $error) = (new UploadManager())->putFile($this->token, $fileName, $filePath);
        if ($error !== null) {
            return $error;
        } else {
            return $ret;
        }
    }

    /**
     * 删除文件
     * @param string $fileName 文件名
     * @return mixed
     */
    public function delete($fileName)
    {
        return (new BucketManager($this->auth))->delete($this->bucket, $fileName);
    }
}
