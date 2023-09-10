<?php

namespace App\Http\Class\Checklist;

/**
 *
 *
 */

class CreateHtmlChecklist {


    private $checklist, $osChecklist, $html;

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

        foreach ($this->checklist as $opcao) {
           $this->html.= $this->getHtmlFromOption($opcao);

        }
        return $this->html;

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
        }
        return '<pre> Não exite '.$option->type.'</pre>';
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
        return '<'.$option->subtype.$this->setClass($option).'>'.$option->label.'</'.$option->subtype.'>';
    }

    /**
     * paragraph
     *
     * cria o HTML do paragraph
     *
     * @param object $$option Recebe o objeto do paragraph
     * @return string
     **/
    private function paragraph(object $option) : string {
        return '<'.$option->subtype.$this->setClass($option).'>'.$option->label.'</'.$option->subtype.'>';
    }

    /**
     * text
     *
     * cria o HTML do text
     *
     * @param object $$option Recebe o objeto do text
     * @return string
     **/
    private function text(object $option) : string {
        dd($option);
    // <div class="formbuilder-text form-group field-text-1694297771817-0">
    //     <label for="text-1694297771817-0" class="formbuilder-text-label">Campo de texto<span class="tooltip-element" tooltip="tesxto de ajuda ">?</span></label>
    //     <input name="text-1694297771817-0" type="text" value="valor inicial" class="form-control" maxlength="30" placeholder="placeholder aqui " id="text-1694297771817-0" title="tesxto de ajuda ">
    // </div>
        return '<'.$option->subtype.$this->setClass($option).'>'.$option->label.'</'.$option->subtype.'>';
    }


    /**
     * Define e retorna a classe para o HTMl
     *
     * @param object $object objeto par apegar a classe do html
     * @return string|null
     **/
    private function setClass(object $object) {
        if (property_exists($object,'className')) {
            return ' class="'.$object->className.'" ';
        }
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
