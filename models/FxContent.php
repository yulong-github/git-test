<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "fx_content".
 *
 * @property int $id
 * @property int $u_id 用户id
 * @property string $u_name 用户名称
 * @property string $content 内容
 * @property int $add_time 发表时间
 * @property int $status 是否展示
 */
class FxContent extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'fx_content';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['u_id', 'add_time', 'status'], 'integer'],
            [['content'], 'string'],
            [['u_name'], 'string', 'max' => 100],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'u_id' => 'U ID',
            'u_name' => 'U Name',
            'content' => 'Content',
            'add_time' => 'Add Time',
            'status' => 'Status',
        ];
    }
}
