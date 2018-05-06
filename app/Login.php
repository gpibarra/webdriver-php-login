<?php
namespace App;

use gpibarra\WebDriverPHP\WebDriver;
use Facebook\WebDriver\WebDriverBy;
use Facebook\WebDriver\WebDriverElement;
use Facebook\WebDriver\WebDriverSelect;

class Login {

    function __construct() {
    }

    function __destruct() {
    }

    public static function Login(WebDriver $wd, $conf, $data) {
        $wd->driver->get($conf['login']['url']);
        sleep(1);
        if (isset($conf['login']['frame'])) {
            $wd->driver->switchTo()->frame($conf['login']['frame']);
        }
        foreach ($conf['login']['form']['input'] as $field => $value) {
            if ($value['search']==='id') {
                $input = $wd->driver->findElement(WebDriverBy::id($value['target']));
            }
            else if ($value['search']==='name') {
                $input = $wd->driver->findElements(WebDriverBy::name($value['target']));
            }
            else if ($value['search']==='class') {
                $input = $wd->driver->findElement(WebDriverBy::className($value['target']));
            }
            else if ($value['search']==='selector') {
                $input = $wd->driver->findElement(WebDriverBy::cssSelector($value['target']));
            }
            if (isset($input)) {
                if ($value['type']==="text" || $value['type']=="pass") {
                    $input->sendKeys($data[$field]);
                }
                else if ($value['type']==="select") {
                    $inputSelect = new WebDriverSelect($input);
                    if ($value['selectBy']==="value") {
                        $inputSelect->selectByValue($data[$field]);
                    }
                    else {
                        $inputSelect->selectByVisibleText($data[$field]);
                    }
                }
            }
        }
        if ($conf['login']['form']['submit']['type']==='button') {
            if ($conf['login']['form']['submit']['search']==='id') {
                $buttonLogin = $wd->driver->findElement(WebDriverBy::id($conf['login']['form']['submit']['target']));
            }
            else if ($conf['login']['form']['submit']['search']==='name') {
                $buttonLogin = $wd->driver->findElement(WebDriverBy::name($conf['login']['form']['submit']['target']));
            }
            else if ($conf['login']['form']['submit']['search']==='class') {
                $buttonLogin = $wd->driver->findElement(WebDriverBy::className($conf['login']['form']['submit']['target']));
            }
            else if ($conf['login']['form']['submit']['search']==='selector') {
                $buttonLogin = $wd->driver->findElement(WebDriverBy::cssSelector($conf['login']['form']['submit']['target']));
            }
            //Hacer click en un elemento que no esta en el scroll actual puede traer errores
            //$wd->driver->executeScript('window.scrollTo('.$buttonLogin->getLocation()->getX().',document.body.scrollHeight);');
            if (isset($buttonLogin)) {
                $buttonLogin->click();
            }
        }
        sleep(1);
    }

    public static function isLoginOk(WebDriver $wd, $conf) {
        $blIsOk = false;
        if ($conf['login']['check']['type']==='url') {
            $currentURL = $wd->driver->getCurrentURL();
            if ($conf['login']['check']['compare']==='equal') {
                $blIsOk = ($currentURL===$conf['login']['check']['url']);
            }
            else if ($conf['login']['check']['compare']==='match') {
                $blIsOk = (strpos($currentURL,$conf['login']['check']['match'])!==false);
            }
            return ($conf['login']['check']['exist']==true)?$blIsOk:!$blIsOk;
        }
        else if ($conf['login']['check']['type']==='element') {
            try {
                if ($conf['login']['check']['search']==='id') {
                    $wd->driver->findElement(WebDriverBy::id($conf['login']['check']['target']));
                }
                else if ($conf['login']['check']['search']==='name') {
                    $wd->driver->findElement(WebDriverBy::name($conf['login']['check']['target']));
                }
                else if ($conf['login']['check']['search']==='class') {
                    $wd->driver->findElement(WebDriverBy::className($conf['login']['check']['target']));
                }
                else if ($conf['login']['check']['search']==='selector') {
                    $wd->driver->findElement(WebDriverBy::cssSelector($conf['login']['check']['target']));
                }
                $blIsOk = true;
            }
            catch (\Exception $e) {
                $blIsOk = false;
            }
            return ($conf['login']['check']['exist']==true)?$blIsOk:!$blIsOk;
        }
        echo "No se puede chequear login\n";
        return false;
    }

}
