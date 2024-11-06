<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "order".
 *
 * @property int $id
 * @property int $product_id
 * @property string $date
 * @property string $time
 * @property int $type_pay_id
 * @property string $address
 * @property int $outpost_id
 * @property string|null $comment
 * @property int $status_id
 * @property int $user_id
 * @property string|null $comment_admin
 * @property string $created_at
 *
 * @property Outpost $outpost
 * @property Product $product
 * @property Status $status
 * @property TypePay $typePay
 * @property User $user
 */
class Order extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'order';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['product_id', 'date', 'time', 'type_pay_id', 'address', 'outpost_id', 'status_id', 'user_id'], 'required'],
            [['product_id', 'type_pay_id', 'outpost_id', 'status_id', 'user_id'], 'integer'],
            [['date', 'time', 'created_at'], 'safe'],
            [['address', 'comment', 'comment_admin'], 'string', 'max' => 255],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::class, 'targetAttribute' => ['user_id' => 'id']],
            [['status_id'], 'exist', 'skipOnError' => true, 'targetClass' => Status::class, 'targetAttribute' => ['status_id' => 'id']],
            [['product_id'], 'exist', 'skipOnError' => true, 'targetClass' => Product::class, 'targetAttribute' => ['product_id' => 'id']],
            [['type_pay_id'], 'exist', 'skipOnError' => true, 'targetClass' => TypePay::class, 'targetAttribute' => ['type_pay_id' => 'id']],
            [['outpost_id'], 'exist', 'skipOnError' => true, 'targetClass' => Outpost::class, 'targetAttribute' => ['outpost_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'product_id' => 'Product ID',
            'date' => 'Date',
            'time' => 'Time',
            'type_pay_id' => 'Type Pay ID',
            'address' => 'Address',
            'outpost_id' => 'Outpost ID',
            'comment' => 'Comment',
            'status_id' => 'Status ID',
            'user_id' => 'User ID',
            'comment_admin' => 'Comment Admin',
            'created_at' => 'Created At',
        ];
    }

    /**
     * Gets query for [[Outpost]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getOutpost()
    {
        return $this->hasOne(Outpost::class, ['id' => 'outpost_id']);
    }

    /**
     * Gets query for [[Product]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getProduct()
    {
        return $this->hasOne(Product::class, ['id' => 'product_id']);
    }

    /**
     * Gets query for [[Status]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getStatus()
    {
        return $this->hasOne(Status::class, ['id' => 'status_id']);
    }

    /**
     * Gets query for [[TypePay]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getTypePay()
    {
        return $this->hasOne(TypePay::class, ['id' => 'type_pay_id']);
    }

    /**
     * Gets query for [[User]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::class, ['id' => 'user_id']);
    }
}
