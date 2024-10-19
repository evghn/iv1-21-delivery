<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\helpers\VarDumper;


/**
 * RegisterForm is the model behind the register form.
 */
class RegisterForm extends Model
{
    public string $name = '';
    public string $surname = '';
    public string $patronymic = '';
    public string $login = '';
    public string $email = '';
    public string $phone = '';
    public string $password = '';
    public string $password_repeat = '';
    public bool $rules = false;

    /**
     * @return array the validation rules.
     */
    public function rules()
    {
        return [
            // name, email, subject and body are required
            [['name', 'surname', 'login', 'email', 'phone', 'password_repeat', 'password'], 'required'],
            [['name', 'surname', 'patronymic', 'login', 'email', 'phone', 'password_repeat', 'password'], 'string', 'max' => 255], 
            // ['name', 'string', 'min' => 3], 
            // [['name', 'surname', 'patronymic'], 'match', 'pattern' => '/^[А-Яа-яЁё\s\-]+$/u', 'message' => 'Только кириллица, пробел, тире'],          
            [['name', 'surname', 'patronymic'], 'match', 'pattern' => '/^[а-яё\s\-]+$/ui', 'message' => 'Только кириллица, пробел, тире'],
            // ['login', 'match', 'pattern' => '/^[a-z0-9\-]$/i', 'message' => 'Латиница, тире, цифры'],          
            ['login', 'match', 'pattern' => '/^[a-z\-\d]+$/i', 'message' => 'Латиница, тире, цифры'],
            [['login', 'email'], 'unique', 'targetClass' => User::class],
            // [['login', 'email'], 'unique', 'targetClass' => User::class],
           

            ['password', 'string', 'min' => 6],  
            ['password', 'match', 'pattern' => '/^[a-z\d]+$/i', 'message' => 'Латиница, тире, цифры'],
            ['password_repeat', 'compare', 'compareAttribute' => 'password'],


            // ['password', 'match', 'pattern' => '/^[a-z\d]{6,}}$/i', 'message' => 'Латиница, тире, цифры, минимум 6 символов'],       
            // +7(XXX)-XXX-XX-XX   
            // ['phone', 'match', 'pattern' => '/^\+7\([0-9]{3}\)\-[0-9]{3}\-[0-9]{2}\-[0-9]{2}$/', 'message' => 'формат: +7(XXX)-XXX-XX-XX'],
            ['phone', 'match', 'pattern' => '/^\+7\([\d]{3}\)\-[\d]{3}(\-[\d]{2}){2}$/'],
            // email has to be a valid email address
            ['email', 'email'],
            ['rules', 'required', 'requiredValue' => true, 'message' => 'Необходимо  отметить согласие с правилами регистрации'],
        ];
    }

    /**
     * @return array customized attribute labels
     */
    public function attributeLabels()
    {
        return [
            'name' => 'Имя',
            'surname' => 'Фамилия',
            'patronymic' => 'Отчество',
            'login' => 'Логин',
            'email' => 'Электронная почта',
            'phone' => 'Телефон',
            'password' => 'Пароль',
            'password_repeat' => 'Повтор пароля',
            'rules' => 'Согласие с правилами регистрации',
        ];
    }


    public function userRegister(): object|false
    {
        if ($this->validate()) {
         // data - ok   
          //VarDumper::dump('ok', 10, true); die;
            $user = new User();
            // $user->name = 'vasya';
            // $user->login = 'petya';
            // $data  = [
            //     'name' => 'vasya',
            //     'login' => 'petya'                
            // ];
            // $data = $this->attributes;
            // VarDumper::dump($data, 10, true);

            // // $user->name = $data['name'];
            // $user->load($data, '');
            //**** variant 1.2 */
            // $user->load($this->attributes, '');


            // ver 2.0
            $user->attributes = $this->attributes;
            $user->auth_key = Yii::$app->security->generateRandomString();
            $user->password = Yii::$app->security->generatePasswordHash($user->password);
            $user->role_id = Role::getRoleId('user');

            if (! $user->save()) {
                VarDumper::dump($user->errors, 10, true); die;
            }
        } else {
            // data - error
            // VarDumper::dump($this->errors, 10, true); die;
        }   
        
        return $user ?? false;
    }
}
