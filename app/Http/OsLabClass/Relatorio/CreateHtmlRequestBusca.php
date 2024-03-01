<?php

namespace App\Http\OsLabClass\Relatorio;

use Request;

/**
 *
 *
 */

class CreateHtmlRequestBusca {

    public $request;

    public function __construct() {
        $this->request = Request::all();
    }



    public function render() {
        return $this->createRender($this->request);
    }

    private function createRender($request) {
        $return = "";
        try {
            if(is_array($request)){
                foreach ($request as $key => $value) {
                    $return.= "<span>". $this->convertToString($key) . ": " . $this->checkType($value) . "</span>";
                }
            }
        } catch (\Throwable $th) {
            throw $th;
        }
        return $return;
    }

    private function convertToString ($key) {
        return \Str::of($key)->snake()->replace('_', ' ')->title();
    }


    private function checkType ($value) {

       if (is_array($value)){

            return 'array';
        }
        else {
            return 'strung';
            // $data = \DateTime::createFromFormat('Y-m-d', $value);
            // if($data && $data->format('Y-m-d') === $value){
            //     return $data->format('d/m/Y');
            // } else {
            //     return $value;
            // }
        }

        // if() {

        // }
    }


}


// @php
//     function checkBusca($busca)  {





//     }
// @endphp

// <h5>Parâmetros Buscados:</h5>
// @foreach (Request::all() as $key => $item)
//     <span>
//         <b> {{  }}:</b> {{ checkBusca($item) }}
//     </span>
// @endforeach
