<?php

namespace App\Http\OsLabClass\Checklist;

/**
 * Monta um o HTML do checklist.
 *
 * Ref: https://formbuilder.online/
 */
class CreateHtmlChecklist
{
    private $checklist;
    private $osChecklist;
    private $html;

    /**
     * @param  object  $checklist  Recebe o modelo de Checklist com base no OS->categoria->checklist
     * @param  object|null  $osChecklist  Recebe o checklist refente a OS
     **/
    public function __construct($checklist, $osChecklist = null)
    {
        $this->checklist = $checklist;
        $this->osChecklist = $osChecklist;
        $this->setChecklist();
    }

    /**
     * Cria o HTML do checklist.
     *
     * Cria o HTML do check list para retornar dentro do model OS->getHtmlChecklist()
     *
     * @return string
     **/
    public function render()
    {
        foreach ($this->checklist as $opcao) {
            $this->html .= $this->getHtmlFromOption($opcao);
        }

        return $this->html;
    }

    /**
     * Retorna oa html pronto.
     *
     * Retorna o Html para ser concatenado e retornado na blade
     *
     * @param  object  $option  objeto da opção recebida.
     * @return string Retorna o string do HTML
     */
    private function getHtmlFromOption(object $option): string
    {
        if (method_exists($this, $this->dashToCamelCase($option->type))) {
            return $this->{$this->dashToCamelCase($option->type)}($option);
        }

        return '<pre> Não exite '.$option->type.'</pre>';
    }

    /**
     * header.
     *
     * cria o HTML do header
     *
     * @param  object  $option  Recebe o objeto do header
     * @return string
     **/
    private function header(object $option): string
    {
        return '<'.$option->subtype.$this->setClass($option).'>'.$option->label.'</'.$option->subtype.'>';
    }

    /**
     * paragraph.
     *
     * cria o HTML do paragraph
     *
     * @param  object  $option  Recebe o objeto do paragraph
     * @return string
     **/
    private function paragraph(object $option): string
    {
        return '<'.$option->subtype.$this->setClass($option).'>'.$option->label.'</'.$option->subtype.'>';
    }

    /**
     * text.
     *
     * cria o HTML do text
     *
     * @param  object  $option  Recebe o objeto do text
     * @return string
     **/
    private function text(object $option): string
    {
        // dd($option);
        $html = '<div class="form-group">';
        $html .= '<label for="'.$option->name.'">'.$option->label.'</label>';
        if ($option->required) {
            $html .= '<span class="formbuilder-required">*</span>';
        }
        if (property_exists($option, 'description')) {
            $html .= '<span class="tooltip-element" tooltip="'.$option->description.'"><i class="fa-solid fa-question"></i></span></label>';
        }
        $html .= '<input name="'.$option->name.
                '" id="'.$option->name.'" '.
                $this->setClass($option).
                'type="'.$option->subtype.'"'.
                $this->setMaxlength($option).
                ' value="'.$this->setValue($option).'" '.
                $this->setPlaceholder($option).
                $this->setTitle($option).
                $this->setRequired($option).
                ' >';
        $html .= '</div>';

        return $html;
    }

    /**
     * number.
     *
     * cria o HTML do number
     *
     * @param  object  $option  Recebe o objeto do number
     * @return string
     **/
    private function number(object $option): string
    {
        // dd($option);
        $html = '<div class="form-group">';
        $html .= '<label for="'.$option->name.'">'.$option->label.'</label>';
        if ($option->required) {
            $html .= '<span class="formbuilder-required">*</span>';
        }
        if (property_exists($option, 'description')) {
            $html .= '<span class="tooltip-element" tooltip="'.$option->description.'"><i class="fa-solid fa-question"></i></span></label>';
        }
        $html .= '<input name="'.$option->name.
                '" id="'.$option->name.'" '.
                $this->setClass($option).
                'type="number"'.
                $this->setPlaceholder($option).
                ' value="'.$this->setValue($option).'" '.
                $this->setMax($option).
                $this->setMin($option).
                $this->setStep($option).
                $this->setTitle($option).
                $this->setRequired($option).
                ' >';
        $html .= '</div>';

        return $html;
    }

    /**
     * textarea.
     *
     * cria o HTML do textarea
     *
     * @param  object  $option  Recebe o objeto do textarea
     * @return string
     **/
    private function textarea(object $option): string
    {
        $html = '<div class="form-group">';
        $html .= '<label for="'.$option->name.'">'.$option->label.'</label>';
        if ($option->required) {
            $html .= '<span class="formbuilder-required">*</span>';
        }
        if (property_exists($option, 'description')) {
            $html .= '<span class="tooltip-element" tooltip="'.$option->description.'"><i class="fa-solid fa-question"></i></span></label>';
        }
        $html .= '<textarea name="'.$option->name.
                '" id="'.$option->name.'" '.
                $this->setClass($option).
                'type="'.$option->subtype.'"'.
                $this->setMaxlength($option).
                $this->setPlaceholder($option).
                $this->setTitle($option).
                $this->setRequired($option).
                $this->setRows($option).
                ' >'.$this->setValue($option).'</textarea>';
        $html .= '</div>';

        return $html;
    }

    /**
     * select.
     *
     * cria o HTML do select
     *
     * @param  object  $option  Recebe o objeto do select
     * @return string
     **/
    private function select(object $option): string
    {
        $html = '<div class="form-group">';
        $html .= '<label for="'.$option->name.'">'.$option->label.'</label>';
        if ($option->required) {
            $html .= '<span class="formbuilder-required">*</span>';
        }
        if (property_exists($option, 'description')) {
            $html .= '<span class="tooltip-element" tooltip="'.$option->description.'"><i class="fa-solid fa-question"></i></span></label>';
        }
        $html .= '<select name="'.$option->name.'[]'.
                '" id="'.$option->name.'" '.
                $this->setClass($option).
                $this->setMaxlength($option).
                $this->setPlaceholder($option).
                $this->setTitle($option).
                $this->setRequired($option).
                $this->setMultiple($option).
                ' >';
        foreach ($option->values as $selectValues) {
            $html .= '<option '.
            $this->setSelected($option, $selectValues).
            'value="'.$selectValues->value.'"  >'.
            $selectValues->label.
            '</option>';
        }
        $html .= '</select>';
        $html .= '</div>';

        return $html;
    }

    /**
     * checkbox-group.
     *
     * cria o HTML do checkbox-group
     *
     * @param  object  $option  Recebe o objeto do checkbox-group
     * @return string
     **/
    private function checkboxGroup(object $option): string
    {
        // dd($option);
        $html = '<div class="form-group">';
        $html .= '<label for="'.$option->name.'">'.$option->label.'</label>';
        if ($option->required) {
            $html .= '<span class="formbuilder-required">*</span>';
        }
        if (property_exists($option, 'description')) {
            $html .= '<span class="tooltip-element" tooltip="'.$option->description.'"><i class="fa-solid fa-question"></i></span></label>';
        }
        $html .= '<div class="formbuilder-checkbox-group form-group '.$option->name.'" >';
        foreach ($option->values as $key => $radioValues) {
            $html .= '<div class="formbuilder-checkbox '.$this->setInline($option).'">';
                $html .= '<input '.
                    // 'wire:model.defer="'.$option->name.'.'.$key.'" '.
                    'value ="'.$radioValues->value.'"'.
                    'name="'.$option->name.'[]" '.
                    'id="'.$option->name.'-'.$key.'"'.
                    $this->setClass($option).
                    $this->setChecked($option, $radioValues).
                    // $this->setRequired($option).
                    'aria-required="true"'.
                    'type="checkbox">';
                $html .= '<label for="'.$option->name.'-'.$key.'"'.'> '.$radioValues->label.'</label>';
            $html .= '</div>';
        }
        if ($option->other == true) {
            $html .= '<div class="formbuilder-checkbox'.$this->setInline($option).'">'.
                '<input '.
                // 'wire:model.defer="'.$option->name.'.-other" '.
                'id="'.$option->name.'-other"'.
                $this->setCheckedOther($option).
                'name="'.$option->name.'[]" '.
                'value = "other"'.
                'class=" other-option"'.
                'type="checkbox">';
            $html .= '<label for="'.$option->name.'-other" >Outro'.
                '<input '.
                $this->setCheckedOther($option, true).
                'name="'.$option->name.'[-other-value]" '.
                // 'wire:model.defer="'.$option->name.'.-other-value" '.
                'type="text" id="'.$option->name.'-other-value" class="other-val"></label></div>';
        }
        $html .= '</div>'; // checkbox-group
        $html .= '</div>'; // form-group

        return $html;

    }

    /**
     * radio-group.
     *
     * cria o HTML do radio-group
     *
     * @param  object  $option  Recebe o objeto do radio-group
     * @return string
     **/
    private function radioGroup(object $option): string
    {
        // dd($option);
        $html = '<div class="formbuilder-radio-group form-group">';
        $html .= '<label for="'.$option->name.'">'.$option->label.'</label>';
        if ($option->required) {
            $html .= '<span class="formbuilder-required">*</span>';
        }
        if (property_exists($option, 'description')) {
            $html .= '<span class="tooltip-element" tooltip="'.$option->description.'"><i class="fa-solid fa-question"></i></span></label>';
        }
        $html .= '<div class="radio-group" >';
        foreach ($option->values as $key => $radioValues) {
            $html .= '<div class="formbuilder-radio'.$this->setInline($option).'">';
                $html .= '<input  '.
                    // 'wire:model.defer="'.$option->name.'" '.
                    'value ="'.$radioValues->value.'"'.
                    'name="'.$option->name.'[]" '.
                    'id="'.$option->name.'-'.$key.'"'.
                    $this->setChecked($option, $radioValues).
                    $this->setClass($option).
                    $this->setRequired($option).
                    // 'aria-required="true"'.
                    'type="radio">';
                $html .= '<label for="'.$option->name.'-'.$key.'"'.'> '.$radioValues->label.'</label>';
            $html .= '</div>';
        }
        if ($option->other == true) {
            $html .= '<div class="formbuilder-radio'.$this->setInline($option).'">'.
                '<input  '.
                'id="'.$option->name.'-other"'.
                'name="'.$option->name.'[]" '.
                'value = "other"'.
                // $this->setClass($option).
                $this->setCheckedOtherRadio($option).
                'class=" other-option"'.
                'type="radio">';
            $html .= '<label for="'.$option->name.'-other" >Outro'.
                '<input '.
                $this->setCheckedOtherRadio($option, true).
                // 'wire:model.defer="'.$option->name.'.-other-value" '.
                'name="'.$option->name.'[-other-value]" '.
                'type="text" id="'.$option->name.'-other-value" class="other-val"></label></div>';
        }
        $html .= '</div>'; // checkbox-group
        $html .= '</div>'; // form-group

        return $html;
    }

    /**
     * Define o item selecionado para o HTML.
     *
     * @param  object  $object  objeto do item selecionado do html
     * @param  object  $object  objeto da opção selecionado do html
     * @return string|null
     **/
    private function setChecked(object $object, $option) {
        // dd(json_decode($this->osChecklist->where('name', $object->name)->first()?->value));
        if ($osOption = (array) json_decode($this->osChecklist->where('name', $object->name)->first()?->value)) {
            if (in_array($option->value, $osOption)) {
                // dd($option->value, $osOption);
                return ' checked="checked" ';
            }
        } else {
            if ($option->selected == true) {
                return ' checked="checked" ';
            }
        }
    }

    /**
     * Define o item selecionado (other) para o HTML.
     *
     * @param  object  $object  objeto do item selecionado do html
     * @param  object  $object  objeto da opção selecionado do html
     * @return string|null
     **/
    private function setCheckedOtherRadio(object $object, $value = false)
    {
        if ($osOption = (array) json_decode($this->osChecklist->where('name', $object->name)->first()?->value)) {
            if (isset($osOption['-other-value'])) {
                if (!$value) {
                    return ' checked="checked" ';
                }

                return 'value= "'.$osOption['-other-value'].'"';
            }
        }
    }

    /**
     * Define o item selecionado (other) para o HTML.
     *
     * @param  object  $object  objeto do item selecionado do html
     * @param  object  $object  objeto da opção selecionado do html
     * @return string|null
     **/
    private function setCheckedOther(object $object, $value = false)
    {
        if ($osOption = (array) json_decode($this->osChecklist->where('name', $object->name)->first()?->value)) {
            if (isset($osOption['-other-value'])) {
                if (!$value) {

                    return ' checked="checked" ';
                }

                return 'value= "'.$osOption['-other-value'].'"';
            }
        }
    }

    /**
     * Define o item selecionado para o HTML.
     *
     * @param  object  $object  objeto do item selecionado do html
     * @param  object  $object  objeto da opção selecionado do html
     * @return string|null
     **/
    private function setSelected(object $object, $option)
    {
        if ($osOption = json_decode($this->osChecklist->where('name', $object->name)->first()?->value)) {
            if (in_array($option->value, $osOption)) {

                return ' selected="selected" ';
            }
        } else {
            if ($option->selected == true) {

                return ' selected="selected" ';
            }
        }
    }


    /**
     * Define e retorna a Value para o HTML.
     *
     * @param  object  $object  objeto par apegar a Value do html
     * @return string|null
     **/
    private function setValue(object $object)
    {
        $osValue = $this->osChecklist->where('name', $object->name)->first()?->value;
        if (property_exists($object, 'value') && ($osValue == null) ) {
            return $object->value;
        }
        if ($osValue) {
            return json_decode($osValue);
        }
    }

    /**
     * Define e retorna a inline para o HTML.
     *
     * @param  object  $object  objeto par apegar a inline do html
     * @return string|null
     **/
    private function setInline(object $object)
    {
        if (property_exists($object, 'inline') && $object->inline == 'true') {

            return '-inline';
        }
    }

    /**
     * Define e retorna a multiple para o HTML.
     *
     * @param  object  $object  objeto par apegar a multiple do html
     * @return string|null
     **/
    private function setMultiple(object $object)
    {
        if (property_exists($object, 'multiple') && $object->multiple == 'true') {

            return ' multiple="multiple" ';
        }
    }

    /**
     * Define e retorna a rows para o HTML.
     *
     * @param  object  $object  objeto par apegar a rows do html
     * @return string|null
     **/
    private function setRows(object $object)
    {
        if (property_exists($object, 'rows')) {

            return ' rows="'.$object->rows.'" ';
        }
    }

    /**
     * Define e retorna a step para o HTML.
     *
     * @param  object  $object  objeto par apegar a step do html
     * @return string|null
     **/
    private function setStep(object $object)
    {
        if (property_exists($object, 'step')) {

            return ' step="'.$object->step.'" ';
        }
    }

    /**
     * Define e retorna a min para o HTML.
     *
     * @param  object  $object  objeto par apegar a min do html
     * @return string|null
     **/
    private function setMin(object $object)
    {
        if (property_exists($object, 'min')) {

            return ' min="'.$object->min.'" ';
        }
    }

    /**
     * Define e retorna a max para o HTML.
     *
     * @param  object  $object  objeto par apegar a max do html
     * @return string|null
     **/
    private function setMax(object $object)
    {
        if (property_exists($object, 'max')) {

            return ' max="'.$object->max.'" ';
        }
    }

    /**
     * Define e retorna a required para o HTML.
     *
     * @param  object  $object  objeto par apegar a required do html
     * @return string|null
     **/
    private function setRequired(object $object)
    {
        if (property_exists($object, 'required') && $object->required == 'true') {

            return ' required="required" ';
        }
    }

    /**
     * Define e retorna a title para o HTML.
     *
     * @param  object  $object  objeto par apegar a title do html
     * @return string|null
     **/
    private function setTitle(object $object)
    {
        if (property_exists($object, 'description')) {

            return ' title="'.$object->description.'" ';
        }
    }

    /**
     * Define e retorna a placeholder para o HTML.
     *
     * @param  object  $object  objeto par apegar a placeholder do html
     * @return string|null
     **/
    private function setPlaceholder(object $object)
    {
        if (property_exists($object, 'placeholder')) {

            return ' placeholder="'.$object->placeholder.'" ';
        }
    }

    /**
     * Define e retorna a maxlength para o HTML.
     *
     * @param  object  $object  objeto par apegar a maxlength do html
     * @return string|null
     **/
    private function setMaxlength(object $object)
    {
        if (property_exists($object, 'maxlength')) {

            return ' maxlength="'.$object->maxlength.'" ';
        }
    }

    /**
     * Define e retorna a classe para o HTML.
     *
     * @param  object  $object  objeto par apegar a classe do html
     * @return string|null
     **/
    private function setClass(object $object)
    {
        if (property_exists($object, 'className')) {

            return ' class="'.$object->className.'" ';
        }
    }

    /**
     * Converte a a string em um objeto json.
     */
    private function setChecklist(): void
    {
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
    private function isJson($string)
    {
        json_decode($string);
        return json_last_error() === JSON_ERROR_NONE;
    }

    /**
     * Converte hifen em CamelCase
     * @param string $string texto par aser convertido
     * @return string
     */
    private function dashToCamelCase($string, $capitalizeFirstCharacter = false): string
    {
        $str = str_replace('-', '', ucwords($string, '-'));
        if (!$capitalizeFirstCharacter) {
           $str = lcfirst($str);
        }
        return $str;
    }
}
