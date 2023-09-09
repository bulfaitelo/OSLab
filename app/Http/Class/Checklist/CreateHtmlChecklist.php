<?php

namespace App\Http\Class\Checklist;

/**
 *
 *
 */

class CreateHtmlChecklist {


    private $checklist, $osChecklist;

/**
 * @param object|null $osChecklist Recebe as respostas  relacionada a Os
 * @param object|null $checklist Recebe o modelo de Checklist com base no OS->categoria->checklist
 **/
    public function __construct($checklist, $osChecklist = null) {
        $this->checklist = $checklist;
        $this->osChecklist = $osChecklist;
        $this->setChecklist();

    }

    /**
     * Cria o HTML do checklist
     *
     * Cria o HTML do check list para retornar dentro do model OS->getHtmlChecklist()
     *
     * @return string
     **/
    public function render() {
        $name = '';
        foreach ($this->checklist as $opcao) {
             dump($this->getHtmlFromOption($opcao));

        }

        return $name;
    }

    /**
     * Retorna oa html pronto
     * Retorna o Html para ser concatenado e retornado na blade
     * @param object $option objeto da opção recebida.
     * @return string Retorna o string do HTML
     */
    private function getHtmlFromOption(object $option) : string {

        if (method_exists($this, $option->type)) {
            return $this->{$option->type}($option);
        } else {
            return 'Não exite '.$option->type;


        }
    }

    /**
     * header
     *
     * cria o HTML do header
     *
     * @param object $$option Recebe o objeto do header
     * @return string
     **/
    private function header(object $option) : string {
        return 'header function hue';
    }

    /**
     * Converte a a string em um objeto json.
     */
    private function setChecklist() : void {
        try {
            if ($this->isJson($this->checklist->checklist)) {
                $this->checklist = json_decode($this->checklist->checklist);
            }
        } catch (\Throwable $th) {
            throw $th;
        }

    }

    /**
     * verifica se é um json valido ou não
     * @param string $string jon a ser verificado
     * @return bool
     */
    private function isJson($string) {
        json_decode($string);
        return json_last_error() === JSON_ERROR_NONE;
    }


}
