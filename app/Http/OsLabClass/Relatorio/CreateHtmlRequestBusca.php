<?php

namespace App\Http\OsLabClass\Relatorio;

use Request;

/**
 * Gera o HTMl do formulário de busca.
 */
class CreateHtmlRequestBusca
{
    public $request;

    public function __construct()
    {
        $this->request = Request::all();
    }

    public function render()
    {
        return $this->createRender($this->request);
    }

    private function createRender($request)
    {
        $return = '';
        try {
            if (is_array($request)) {
                $return .= '<ul>';
                foreach ($request as $key => $value) {
                    $return .= '<li><strong>'.$this->convertToString($key).'</strong>'.$this->checkType($value).'</li>';
                }
                $return .= '</ul>';
            }
        } catch (\Throwable $th) {
            throw $th;
        }

        return $return;
    }

    private function convertToString($key, $subArray = false)
    {
        $ponto = '';
        if (is_integer($key)) {
            if ($key > 0) {
            }
        } else {
            if (! $subArray) {
                $ponto = ': ';
            }

            return \Str::of($key)->snake()->replace('_', ' ')->title().$ponto;
        }
    }

    private function checkType($value)
    {
        if (is_array($value)) {
            return $this->createRender($value);
        } else {
            $data = \DateTime::createFromFormat('Y-m-d', $value);
            if ($data && $data->format('Y-m-d') === $value) {
                return $data->format('d/m/Y');
            } else {
                return $this->convertToString($value, true);
            }
        }
    }
}
