<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "fx_user".
 *
 * @property int $uid UID
 * @property string $name 名称
 * @property string $password 密码
 * @property int $start_time 注册时间
 * @property int $end_time 最后一次登录时间
 * @property int $member 是否会员
 * @property int $status 1:非会员  2:会员  3:超级会员 4:禁用
 * @property int $phone 电话
 * @property string $email 邮箱
 * @property string $orange_key 推荐识别码
 * @property string $ip IP地址
 */
class FxUser extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'fx_user';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['start_time', 'end_time', 'member', 'status', 'phone'], 'integer'],
            [['name', 'password', 'email', 'orange_key'], 'string', 'max' => 255],
            [['ip'], 'string', 'max' => 50],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'uid' => 'Uid',
            'name' => 'Name',
            'password' => 'Password',
            'start_time' => 'Start Time',
            'end_time' => 'End Time',
            'member' => 'Member',
            'status' => 'Status',
            'phone' => 'Phone',
            'email' => 'Email',
            'orange_key' => 'Orange Key',
            'ip' => 'Ip',
        ];
    }
}
