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
        $html = '<div class="form-group">';
        $html.= '<label for="'.$option->name.'">'.$option->label.'</label>';
        if ($option->required) {
            $html.='<span class="formbuilder-required">*</span>';
        }
        if (property_exists($option,'description')) {
            $html.='<span class="tooltip-element" tooltip="'.$option->description.'"><i class="fa-solid fa-question"></i></span></label>';
        }
        $html.= '<input wire:model="form.'.$option->name.
                '" id="'.$option->name.'" '.
                $this->setClass($option).
                'type="'.$option->subtype.'"'.
                $this->setMaxlength($option).
                $this->setPlaceholder($option).
                $this->setTitle($option).
                $this->setRequired($option).
                ' >';
        $html.= '</div>';
    return $html;
    }


    /**
     * number
     *
     * cria o HTML do number
     *
     * @param object $$option Recebe o objeto do number
     * @return string
     **/
    private function number(object $option) : string {

        dd($option);
        $html = '<div class="form-group">';
        $html.= '<label for="'.$option->name.'">'.$option->label.'</label>';
        if ($option->required) {
            $html.='<span class="formbuilder-required">*</span>';
        }
        if (property_exists($option,'description')) {
            $html.='<span class="tooltip-element" tooltip="'.$option->description.'"><i class="fa-solid fa-question"></i></span></label>';
        }
        $html.= '<input wire:model="form.'.$option->name.
                '" id="'.$option->name.'" '.
                $this->setClass($option).
                'type="number"'.
                $this->setMaxlength($option).
                $this->setPlaceholder($option).
                $this->setTitle($option).
                $this->setRequired($option).
                ' >';
        $html.= '</div>';
    return $html;
    }

    /**
     * Define e retorna a required para o HTMl
     *
     * @param object $object objeto par apegar a required do html
     * @return string|null
     **/
    private function setRequired(object $object) {
        if (property_exists($object,'required')) {
            return ' required="required" ';
        }
    }

    /**
     * Define e retorna a title para o HTMl
     *
     * @param object $object objeto par apegar a title do html
     * @return string|null
     **/
    private function setTitle(object $object) {
        if (property_exists($object,'description')) {
            return ' title="'.$object->description.'" ';
        }
    }


    /**
     * Define e retorna a placeholder para o HTMl
     *
     * @param object $object objeto par apegar a placeholder do html
     * @return string|null
     **/
    private function setPlaceholder(object $object) {
        if (property_exists($object,'placeholder')) {
            return ' placeholder="'.$object->placeholder.'" ';
        }
    }

    /**
     * Define e retorna a maxlength para o HTMl
     *
     * @param object $object objeto par apegar a maxlength do html
     * @return string|null
     **/
    private function setMaxlength(object $object) {
        if (property_exists($object,'maxlength')) {
            return ' maxlength="'.$object->maxlength.'" ';
        }
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
