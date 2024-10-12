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
    public bool   $rules = false;


    /**
     * @return array the validation rules.
     */
    public function rules()
    {
        return [
            // name, email, subject and body are required
            [['name', 'surname', 'login', 'email', 'phone', 'password_repeat', 'password'], 'required'],
            [['name', 'surname', 'patronymic', 'login', 'email', 'phone', 'password_repeat', 'password'], 'string', 'max' => 255],            
            // email has to be a valid email address
            ['email', 'email'],
            ['rules', 'required'],            
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
            VarDumper::dump($this->errors, 10, true); die;
        }   
        
        return $user ?? false;
    }
}
