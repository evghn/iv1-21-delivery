<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "type_pay".
 *
 * @property int $id
 * @property string $title
 *
 * @property Order[] $orders
 */
class TypePay extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'type_pay';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['title'], 'required'],
            [['title'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title' => 'Title',
        ];
    }

    /**
     * Gets query for [[Orders]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getOrders()
    {
        return $this->hasMany(Order::class, ['type_pay_id' => 'id']);
    }

    public static function getTypePay()
    {
        return self::find()
                        ->select('title')
                        ->indexBy('id') //object AR
                        ->column() //array                        
                        ;

    }
}
