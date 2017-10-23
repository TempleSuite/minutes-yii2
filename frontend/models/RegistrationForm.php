<?php
namespace frontend\models;

class RegistrationForm extends \dektrium\user\models\RegistrationForm {
    public $first_name;
    public $last_name;
    public $repeatPassword;

    public function rules() {

        $rules = parent::rules();

        $rules['firstnameFilter'] = ['first_name', 'filter', 'filter' => 'trim'];
        $rules['firstnameRequired'] = [['first_name'], 'required'];
        $rules['firstnameLength'] = ['first_name', 'string', 'min' => 2, 'max' => 255];
        $rules['lastnameRequired'] = ['last_name', 'filter', 'filter' => 'trim'];
        $rules['lastnameRequired'] = ['last_name', 'required'];
        $rules['lastnameLength'] = ['last_name', 'string', 'min' => 2, 'max' => 255];
        $rules['nameAlpha'] = [['first_name', 'last_name'], 'match', 'pattern' => "/^[a-zA-Z ,'-]+$/", 'message' => 'Your name can only contain alphabetic characters.'];
        $rules['repeatpasswordRequired'] = ['repeatPassword', 'required'];
        $rules['comparePassword'] = ['repeatPassword', 'compare', 'compareAttribute'=>'password', 'message'=>"Passwords don't match"];

        return $rules;
    }
}