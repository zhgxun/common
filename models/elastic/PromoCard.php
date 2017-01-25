<?php

namespace common\models\elastic;

use yii\elasticsearch\ActiveRecord;

/**
 * Class PromoCard
 *
 * @property string $card_no
 * @property float $effect_params
 * @property string $status
 * @property integer $enable_time
 * @property integer $expire_time
 * @property string $retrieval_source
 * @property integer $issue_time
 * @property string $date
 * @package common\models\elastic
 */
class PromoCard extends ActiveRecord
{
    public static function getDb()
    {
        return \Yii::$app->get('elasticsearch');
    }

    public static function index()
    {
        return 'promo_card_2016';
    }

    public static function type()
    {
        return 'promo_card';
    }

    public static function mapping()
    {
        return [
            static::type() => [
                'properties' => [
                    'card_no' => ['type' => 'string'],
                    'effect_params' => ['type' => 'string'],
                    'status' => ['type' => 'string'],
                    'enable_time' => ['type' => 'integer'],
                    'expire_time' => ['type' => 'integer'],
                    'retrieval_source' => ['type' => 'string'],
                    'issue_time' => ['type' => 'integer'],
                    'date' => ['type' => 'string']
                ]
            ],
        ];
    }

    public function rules()
    {
        return [
            [['enable_time', 'expire_time', 'issue_time'], 'integer'],
            [['card_no', 'effect_params', 'status', 'retrieval_source', 'date'], 'string']
        ];
    }

    public function attributeLabels()
    {
        return [
            'card_no' => '现金券卡号',
            'effect_params' => '现金券面额',
            'status' => '状态',
            'enable_time' => '生效时间',
            'expire_time' => '过期时间',
            'retrieval_source' => '来源',
            'issue_time' => '生成时间',
            'date' => '日期'
        ];
    }

    public function attributes()
    {
        return [
            'card_no', 'effect_params', 'status', 'enable_time', 'expire_time', 'retrieval_source', 'issue_time', 'date'
        ];
    }

    /**
     * 创建索引
     */
    public static function createIndex()
    {
        $db = static::getDb();
        $command = $db->createCommand();
        $command->createIndex(static::index(), [
            //'settings' => [ /* ... */ ],
            'mappings' => static::mapping(),
            //'warmers' => [ /* ... */ ],
            //'aliases' => [ /* ... */ ],
            //'creation_date' => '...'
        ]);
    }

    /**
     * 更新索引
     */
    public static function updateMapping()
    {
        $db = static::getDb();
        $command = $db->createCommand();
        $command->setMapping(static::index(), static::type(), static::mapping());
    }

    /**
     * 删除索引
     */
    public static function deleteIndex()
    {
        $db = static::getDb();
        $command = $db->createCommand();
        $command->deleteIndex(static::index());
    }
}
