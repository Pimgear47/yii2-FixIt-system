<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "job".
 *
 * @property int $id
 * @property string $content
 * @property string $location
 * @property int $request_by
 * @property int $request_at
 * @property string $request_tel
 * @property int $receive_by
 * @property int $receive_at
 * @property int $repair_by
 * @property int $repair_at
 * @property string $repair_detail
 * @property int $feedback
 * @property string $remark
 * @property int $job_stutus_id
 *
 * @property JobStutus $jobStutus
 * @property User $requestBy
 * @property User $receiveBy
 * @property User $repairBy
 */
class Job extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'job';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'content', 'location', 'request_by', 'request_at', 'request_tel', 'job_stutus_id'], 'required'],
            [['id', 'request_by', 'request_at', 'receive_by', 'receive_at', 'repair_by', 'repair_at', 'feedback', 'job_stutus_id'], 'integer'],
            [['content', 'repair_detail', 'remark'], 'string'],
            [['location'], 'string', 'max' => 100],
            [['request_tel'], 'string', 'max' => 45],
            [['id'], 'unique'],
            [['job_stutus_id'], 'exist', 'skipOnError' => true, 'targetClass' => JobStutus::className(), 'targetAttribute' => ['job_stutus_id' => 'id']],
            [['request_by'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['request_by' => 'id']],
            [['receive_by'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['receive_by' => 'id']],
            [['repair_by'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['repair_by' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'content' => 'Content',
            'location' => 'Location',
            'request_by' => 'Request By',
            'request_at' => 'Request At',
            'request_tel' => 'Request Tel',
            'receive_by' => 'Receive By',
            'receive_at' => 'Receive At',
            'repair_by' => 'Repair By',
            'repair_at' => 'Repair At',
            'repair_detail' => 'Repair Detail',
            'feedback' => 'Feedback',
            'remark' => 'Remark',
            'job_stutus_id' => 'Job Stutus ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getJobStutus()
    {
        return $this->hasOne(JobStutus::className(), ['id' => 'job_stutus_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRequestBy()
    {
        return $this->hasOne(User::className(), ['id' => 'request_by']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getReceiveBy()
    {
        return $this->hasOne(User::className(), ['id' => 'receive_by']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRepairBy()
    {
        return $this->hasOne(User::className(), ['id' => 'repair_by']);
    }
}
