<?php
namespace common\models;

use Yii;
use yii\base\NotSupportedException;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;
use yii\web\IdentityInterface;
use yii\base\Event;
use dektrium\user\controllers\RegistrationController;


/**
 * User model
 *
 * @property integer $id
 * @property string $username
 * @property string $email
 * @property string $password_hash
 * @property string $auth_key
 * @property integer $confirmed_at
 * @property string $unconfirmed_email
 * @property integer $blocked_at
 * @property string $registration_ip
 * @property integer $created_at
 * @property integer $updated_at
 * @property integer $flags
 * @property integer $last_login_at
 * @property string $first_name
 * @property string $last_name
 */
class User extends \dektrium\user\models\User
{
//    const STATUS_DELETED = 0;
//    const STATUS_ACTIVE = 10;


    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%user}}';
    }

    /**
     * @inheritdoc
     */
/*    public function behaviors()
    {
        return [
            TimestampBehavior::className(),
        ];
    }*/

    /**
     * @inheritdoc
     */
    public function scenarios()
    {
        $scenarios = parent::scenarios();

        $scenarios['create'][]   = 'first_name';
        $scenarios['create'][]   = 'last_name';

        $scenarios['update'][]   = 'first_name';
        $scenarios['update'][]   = 'last_name';

        $scenarios['register'][] = 'first_name';
        $scenarios['register'][] = 'last_name';

        return $scenarios;
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        $rules = parent::rules();

        $rules['nameLength'] = [['first_name', 'last_name'], 'string', 'max' => 30];

        return $rules;
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'username' => 'Username',
            'email' => 'Email',
            'password_hash' => 'Password Hash',
            'auth_key' => 'Auth Key',
            'confirmed_at' => 'Confirmed At',
            'unconfirmed_email' => 'Unconfirmed Email',
            'blocked_at' => 'Blocked At',
            'registration_ip' => 'Registration Ip',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'flags' => 'Flags',
            'last_login_at' => 'Last Login At',
            'first_name' => 'First Name',
            'last_name' => 'Last Name',
        ];
    }

    public function init()
    {
        Event::on(
            RegistrationController::className(),
            RegistrationController::EVENT_AFTER_REGISTER,
            function () {
                Yii::$app->response->redirect(array('/user/security/login'))->send();
                Yii::$app->end();
            }
        );
    }

    /**
     * @inheritdoc
     */
    public static function findIdentity($id)
    {
        return User::find()->where(['id' => $id])->one();
    }

    /**
     * @inheritdoc
     */
/*    public static function findIdentityByAccessToken($token, $type = null)
    {
        throw new NotSupportedException('"findIdentityByAccessToken" is not implemented.');
    }*/

    /**
     * Finds user by username
     *
     * @param string $username
     * @return static|null
     */
/*    public static function findByUsername($username)
    {
        return static::findOne(['username' => $username, 'status' => self::STATUS_ACTIVE]);
    }*/

    /**
     * Finds user by password reset token
     *
     * @param string $token password reset token
     * @return static|null
     */
/*    public static function findByPasswordResetToken($token)
    {
        if (!static::isPasswordResetTokenValid($token)) {
            return null;
        }

        return static::findOne([
            'password_reset_token' => $token,
            'status' => self::STATUS_ACTIVE,
        ]);
    }*/

    /**
     * Finds out if password reset token is valid
     *
     * @param string $token password reset token
     * @return bool
     */
/*    public static function isPasswordResetTokenValid($token)
    {
        if (empty($token)) {
            return false;
        }

        $timestamp = (int) substr($token, strrpos($token, '_') + 1);
        $expire = Yii::$app->params['user.passwordResetTokenExpire'];
        return $timestamp + $expire >= time();
    }*/

    /**
     * @inheritdoc
     */
/*    public function getId()
    {
        return $this->getPrimaryKey();
    }*/

    /**
     * @inheritdoc
     */
/*    public function getAuthKey()
    {
        return $this->auth_key;
    }*/

    /**
     * @inheritdoc
     */
/*    public function validateAuthKey($authKey)
    {
        return $this->getAuthKey() === $authKey;
    }*/

    /**
     * Validates password
     *
     * @param string $password password to validate
     * @return bool if password provided is valid for current user
     */
/*    public function validatePassword($password)
    {
        return Yii::$app->security->validatePassword($password, $this->password_hash);
    }*/

    /**
     * Generates password hash from password and sets it to the model
     *
     * @param string $password
     */
/*    public function setPassword($password)
    {
        $this->password_hash = Yii::$app->security->generatePasswordHash($password);
    }*/

    /**
     * Generates "remember me" authentication key
     */
/*    public function generateAuthKey()
    {
        $this->auth_key = Yii::$app->security->generateRandomString();
    }*/

    /**
     * Generates new password reset token
     */
/*    public function generatePasswordResetToken()
    {
        $this->password_reset_token = Yii::$app->security->generateRandomString() . '_' . time();
    }*/

    /**
     * Removes password reset token
     */
/*    public function removePasswordResetToken()
    {
        $this->password_reset_token = null;
    }*/

    /**
     * @return string representation of user's name - last name first - comma separated
     */
    public function getFullName()
    {
        return $this->first_name . ' ' . $this->last_name;
    }

}
