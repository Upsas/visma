<?php

class VisitorValidation
{

    private $data;
    private $errors = [];
    private $errorsEdit = [];
    private static $fields = ['name', 'email', 'phone'];

    public function __construct($data)
    {
        $this->data = $data;
    }

    public function validateForm()
    {
        foreach (self::$fields as $field) {
            if (!array_key_exists($field, $this->data)) {
                trigger_error($field . 'is not assigned in data');
                return;
            }
        }
        $this->validateName();
        $this->validateEmail();
        $this->validatePhone();
        return $this->errors;
        return $this->errorsEdit;
    }

    private function validateName()
    {
        $val = trim($this->data['name']);
        if (empty($val)) {
            $this->addError('name', 'name can not be empty');
        } else {
            if (!preg_match('/^[A-Z]+$/i', $val)) {
                $this->addError('name', 'name must be only in alphabetic');
            }
        }
    }
    private function validateEmail()
    {
        $val = trim($this->data['email']);
        if (empty($val)) {
            $this->addError('email', 'email can not be empty');
        } else {
            if (!filter_var($val, FILTER_VALIDATE_EMAIL)) {
                $this->addError('email', 'email must be a valid email');
            }
        }

    }
    private function validatePhone()
    {
        $val = trim($this->data['phone']);
        if (empty($val)) {
            $this->addError('phone', 'phone can not be empty');
        } else {
            if (!preg_match('/^(86)[1-9]{7}$/', $val)) {
                $this->addError('phone', 'phone number must be only numbers start with 86 and  be 9 number length');
            }
        }
    }
    private function addError($key, $val)
    {
        $this->errors[$key] = $val;
    }
}
