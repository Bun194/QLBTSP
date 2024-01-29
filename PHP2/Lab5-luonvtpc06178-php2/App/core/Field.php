<?php

namespace App\core;

class Field
{
    public const TYPE_TEXT = 'text';
    public const TYPE_PASSWORD = 'password';
    public const TYPE_NUMBER = 'number';

    public $type;
    public $attribute;
    public function __construct($attribute)
    {
        $this->type = self::TYPE_TEXT;
        $this->attribute = $attribute;
    }

    public function __toString()
    {
        return sprintf(
            '
            <div class = "mb-3">
        <lable class="form-label">%s</lable>
        <input type = "%s" name = "%s" class = "form-control" >
        </div>
            ',
            $this->getLabel($this->attribute),
            $this->type,
            $this->attribute
        );
    }

    public function passwordField()
    {
        $this->type = self::TYPE_PASSWORD;
        return $this;
    }

    public function labels()
    {
        return [
            "firstname" => "First Name",
            "lastname" => "Last Name",
            "email" => "Email",
            "password" => "Password",
            "confirm" => "Confirm Password",
        ];
    }
    public function getLabel($attribute)
    {
        return $this->labels()[$attribute] ?? $attribute;
    }
}
?>
