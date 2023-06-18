<?php

namespace Tests\Unit;

// use PHPUnit\Framework\TestCase;
use Tests\TestCase;
use File;

class ControllerPermissionsTest extends TestCase
{
    private $arrayControllers;

    public function setUp() : void
    {
        parent::setUp();
        $path = app_path('Http/Controllers');
        $files = File::allFiles($path);
        // Exceções esses Controllers serão ignorado nos teste;
        $arrayControllersExceptions = [
            '\App\Http\Controllers\Controller',
            '\App\Http\Controllers\Configuracao\PermissionsGroupController',
            '\App\Http\Controllers\Auth\VerificationController',
            '\App\Http\Controllers\HomeController', // Esse eu vou ter que tirar
            'App\Http\Controllers\Auth\LoginController',
            '\App\Http\Controllers\Auth\RegisterController',
            '\App\Http\Controllers\Auth\ResetPasswordController',
            '\App\Http\Controllers\Auth\LoginController',
        ];
        foreach ($files as $file) {
            $arrayControllers[] = '\App\Http\Controllers\\'.basename(str_replace('/', "\\", $file->getRelativePathName()), '.php');
        }
        $arrayControllers = array_diff($arrayControllers, $arrayControllersExceptions);
        sort($arrayControllers);

        $this->arrayControllers = $arrayControllers;
    }

    private function getControllerInfo($classController)
    {
        $class = new $classController;
        // verificando as funções que existem
        $methods = get_class_methods($class);
        // dd($methods);
        $ignoredMethods = ['__construct', 'middleware', 'getMiddleware', 'callAction', '__call',
            'authorize', 'authorizeForUser', 'authorizeResource',
            'dispatchNow','dispatchSync',
            'validateWith','validate','validateWithBag',
            'showConfirmForm', 'confirm', 'redirectPath',
            'showLinkRequestForm', 'sendResetLinkEmail', 'broker',
        ];

        foreach ($methods as $value) {
            if(!in_array($value, $ignoredMethods)) {
                $arrayMethods[] = $value;
            }
        }
        // Verificando o construct em busca de permissões
        foreach ($class->getMiddleware() as $value) {
            if (isset($value['options']['only'])) {
                if (is_array($value['options']['only'])) {
                    foreach ($value['options']['only'] as $subValue) {
                        $arrayPermissions[] = $subValue;
                        $arrayNamePermissions[$subValue] = $value['middleware'];
                    }
                } else {
                    $arrayPermissions[] = $value['options']['only'];
                    $arrayNamePermissions[$value['options']['only']] = $value['middleware'];
                }
            }
        }
        $returnArray['class'] = $class::class;
        if(isset($arrayMethods)){
            $returnArray['arrayMethods'] = $arrayMethods;
        }
        if(isset($arrayPermissions)){
            $returnArray['arrayPermissions'] = $arrayPermissions;
        }
        if(isset($arrayNamePermissions)){
            $returnArray['arrayNamePermissions'] = $arrayNamePermissions;
        }
        if(isset($returnArray)){
            return $returnArray;
        } else {
            return null;
        }
    }


    /**
     * Testando as permissões do controller com relação ao método.
     *
     * @return void
     */
    public function test_check_controller_methods_and_permissions() {
        $output = "\n\033[1;39mErro de permissão no Controller:\033[0m\n";
        $outputError="";
        $erroCount = 0;
        $totalErroCount = 0;
        $controllerErroCount = 0 ;
        $erro = false;
        foreach ($this->arrayControllers as $classController) {
            $outputError="";
            $erroCount = 0;
            $controllerInfo = $this->getControllerInfo($classController);
            if(isset($controllerInfo['arrayPermissions']) and isset($controllerInfo['arrayMethods'])){
                $diffFuncoesPermissions = array_diff($controllerInfo['arrayMethods'], $controllerInfo['arrayPermissions']);
                if ($diffFuncoesPermissions) {
                    // dump('diffFuncoesPermissions', $diffFuncoesPermissions);
                    $outputError.= "\nMétodos criados sem permissões definidas: \n";
                    foreach ($diffFuncoesPermissions as $key => $value) {
                        $outputError.= "Métodos: \033[01;32m{$value}\033[0m;\n";
                        $erroCount+=1;
                    }
                }
                $diffPermissionsFunctions = array_diff($controllerInfo['arrayPermissions'], $controllerInfo['arrayMethods']);
                if ($diffPermissionsFunctions) {
                    // dump('diffPermissionsFunctions', $diffPermissionsFunctions);
                    $outputError.= "\nPermissões criadas sem funções relacionadas: \n";
                    foreach ($diffPermissionsFunctions as $key => $value) {
                        $outputError.= "Permissão: \033[01;34m{$controllerInfo['arrayNamePermissions'][$value]}\033[0m [\033[01;32m{$value}\033[0m];\n";
                        $erroCount+=1;
                    }
                }
            }
            if($erroCount > 0){
                $outputClass = "\033[01;31m".$controllerInfo['class']."\033[0m";
                $output.=$outputClass.$outputError;
                $totalErroCount = $totalErroCount + $erroCount;
                $controllerErroCount+=1;
            }
        }
        if($totalErroCount > 0) {
            $output.="\nControllers Com erro: \033[01;31m{$controllerErroCount}\033[0m de um total de \033[01;34m".count($this->arrayControllers)."\033[0m; ";
            $output.="\nHouveram um total de: \033[01;31m{$totalErroCount} \033[0m erros.\n";
            $erro = true;
        }
        $this->assertNotTrue($erro, $output );
    }



    /**
     * Testando para ver se existem controllers com methodos sem permissões.
     *
     * @return void
     */
    public function test_check_controller_methods_without_permissions() {
        $output = "\n\033[1;39mErro de Controllers que não tem permissão definida:\033[0m\n";
        $outputError="";
        $erroCount = 0;
        $totalErroCount = 0;
        $controllerErroCount = 0 ;
        $erro = false;
        foreach ($this->arrayControllers as $classController) {
            $outputError="";
            $erroCount = 0;
            $controllerInfo = $this->getControllerInfo($classController);

            if(!isset($controllerInfo['arrayPermissions']) and isset($controllerInfo['arrayMethods'])){
                $outputError.="\nNão foram criadas permissões para esse Controller:\n";
                foreach ($controllerInfo['arrayMethods'] as $methodsItem) {
                    $outputError.= "Métodos: \033[01;32m{$methodsItem}\033[0m;\n";
                    $erroCount+=1;
                }
            }
            if($erroCount > 0){
                $outputClass = "\033[01;31m".$controllerInfo['class']."\033[0m";
                $output.=$outputClass.$outputError;
                $totalErroCount = $totalErroCount + $erroCount;
                $controllerErroCount+=1;
            }
        }
        if($totalErroCount > 0) {
            $output.="\nControllers Com erro: \033[01;31m{$controllerErroCount}\033[0m de um total de \033[01;34m".count($this->arrayControllers)."\033[0m; ";
            $output.="\nHouveram um total de: \033[01;31m{$totalErroCount} \033[0m erros.\n";
            $erro = true;
        }
        $this->assertNotTrue($erro, $output );
    }

    /**
     * Testando para ver se existem controllers sem Métodos
     *
     * @return void
     */

     public function test_check_controller_without_methods() {
        $output = "\n\033[1;39mErro de Controller que não tem metodos definidos:\033[0m\n";
        $outputError="";
        $erroCount = 0;
        $totalErroCount = 0;
        $controllerErroCount = 0 ;
        $erro = false;
        foreach ($this->arrayControllers as $classController) {
            $outputError="";
            $erroCount = 0;
            $controllerInfo = $this->getControllerInfo($classController);

            if(isset($controllerInfo['arrayPermissions']) and !isset($controllerInfo['arrayMethods'])){

                $outputError.="\nNão existem métodos criados porem existem permissões criadas:\n";
                foreach ($controllerInfo['arrayPermissions'] as $permissionsItem) {
                    $outputError.= "Permissão: \033[01;32m{$permissionsItem}\033[0m;\n";
                    $erroCount+=1;
                }
            }
            if($erroCount > 0){
                $outputClass = "\033[01;31m".$controllerInfo['class']."\033[0m";
                $output.=$outputClass.$outputError;
                $totalErroCount = $totalErroCount + $erroCount;
                $controllerErroCount+=1;
            }
        }
        if($totalErroCount > 0) {
            $output.="\nControllers Com erro: \033[01;31m{$controllerErroCount}\033[0m de um total de \033[01;34m".count($this->arrayControllers)."\033[0m; ";
            $output.="\nHouveram um total de: \033[01;31m{$totalErroCount} \033[0m erros.\n";
            $erro = true;
        }
        $this->assertNotTrue($erro, $output );

     }

}
