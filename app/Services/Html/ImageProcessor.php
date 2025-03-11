<?php

namespace App\Services\Html;

use DOMDocument;
use File;
use Str;

/**
 * Classe para tratamento de imagens.
 *
 * Imagens que são enviadas via Form em Blob a classe remove o blob e armazena o arquivo em um diretório.
 */
class ImageProcessor
{
    /**
     * Trata o texto e enviar as imagens para a pasta upload.
     *
     * @param  string  $text
     * @param  int  $id  id
     * @return bool|string $dom HTML
     */
    public function trataImagemEnviada($text, $id)
    {
        // tratando as imagens enviadas.
        $dom = new DOMDocument;
        @$dom->loadHTML($this->utf8_to_iso8859_1($text), LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NODEFDTD);
        $dom->encoding = 'utf-8';
        $imageFile = $dom->getElementsByTagName('img');
        $imagePath = '/storage/wiki/'.$id.'/imgs/';
        $path = public_path().$imagePath;
        $arrayImageUrl = [];
        if (! is_dir($path)) {
            mkdir($path, 0750, true);
        }
        foreach ($imageFile as $item => $image) {
            $data = $image->getAttribute('src');
            if (preg_match('/^data:image/m', $data)) {
                [$type, $data] = explode(';', $data);
                [, $data] = explode(',', $data);
                $imgeData = base64_decode($data);
                $imageName = Str::uuid().'_'.time().$item.'.'.$this->getFileExtension($type);
                file_put_contents($path.$imageName, $imgeData);
                $image->removeAttribute('src');
                $image->setAttribute('src', $imagePath.$imageName);
                $arrayImageUrl[] = $imageName;
            } else {
                $arrayImageUrl[] = str_replace($imagePath, '', $data);
            }
        }
        // Limpando imagens não usadas.
        if (File::isDirectory($path)) {
            foreach (File::allFiles($path) as $file) {
                if (! in_array($file->getFileName(), $arrayImageUrl)) {
                    unlink($path.$file->getFileName());
                }
            }
        }

        return $dom->saveHTML($dom->documentElement);
    }

    private function utf8_to_iso8859_1(string $string): string
    {
        $s = (string) $string;
        $len = \strlen($s);

        for ($i = 0, $j = 0; $i < $len; ++$i, ++$j) {
            switch ($s[$i] & "\xF0") {
                case "\xC0":
                case "\xD0":
                    $c = (\ord($s[$i] & "\x1F") << 6) | \ord($s[++$i] & "\x3F");
                    $s[$j] = $c < 256 ? \chr($c) : '?';
                    break;

                case "\xF0":
                    ++$i;
                    // no break

                case "\xE0":
                    $s[$j] = '?';
                    $i += 2;
                    break;

                default:
                    $s[$j] = $s[$i];
            }
        }

        return substr($s, 0, $j);
    }

    /**
     * Retorna a Extensão do arquivo, com base em seu metadata.
     *
     * retorna a extensão do arquivo, com base em seu metadado
     *
     * @param  string  $fileData  metadata
     **/
    private function getFileExtension(string $fileData): string
    {
        return explode('/', $fileData)[1];
    }
}
