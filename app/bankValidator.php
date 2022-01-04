<?php

namespace Bankas\Bankas2;

use Bankas\Bankas2\Controllers\bankController;
use Bankas\Bankas2\Messages;

class bankValidator
{

    public function Validation()
    {

        $error = 0;

        foreach ($_POST as $key => $val) {

            switch ($key) {
                case "name":
                    $error += $this->nameValidation($val);
                    break;
                case "lastname":
                    $error += $this->lastNameValidation($val);
                    break;
                case "code":
                    $error += $this->codeValidation($val);
                    break;
            }
        }
        return $error;
    }
    public function nameValidation(string $val): bool
    {
        if (empty($val)) {
            Messages::add('info', 'Vardo laukelis negali buti tuscias');
            return 1;
        }
        $pattern = "/[a-z]{3}/i";
        if (!preg_match($pattern, $val)) {

            Messages::add('info', 'Vardas negali buti trumpesnis uz 3 raides, mes ne Kinijoje, sorry');
            return 1;
        }
        return 0;
    }
    public function lastNameValidation(string $val): string
    {
        if (empty($val)) {
            Messages::add('info', 'Pavardes laukelis negali buti tuscias');
            return 1;
        }
        $pattern = "/[a-z]{3}/i";
        if (!preg_match($pattern, $val)) {

            Messages::add('info', 'Pavarde negali buti trumpesne uz 3 raides, mes ne Kinijoje, sorry');
            return 1;
        }
        return 0;
    }

    public function codeValidation(string $val): string
    {
        if (!empty($val)) {

            $pattern = "/^[3-6][0-9]{10}/";
            if (!preg_match($pattern, $val)) {

                Messages::add('info', 'Asmens kodas turi atitikti taisykles');
                return 1;
            }

            $personCodes = BankController::allCodes();
            foreach ($personCodes as $code) {
                if (in_array($val, $code)) {

                    Messages::add('info', 'Asmens kodas turi buti unikalus');
                    return 1;
                }
            }
        } else {
            Messages::add('info', 'Asmens kodas turi buti unikalus');
            return 1;
        }
        return 0;
    }
}
