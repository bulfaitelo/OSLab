<?php

namespace Tests\Unit\Services\Html;

use App\Services\Html\ImageProcessor;
use Tests\TestCase;

class ImageProcessorTest extends TestCase
{

    protected function setUp(): void
    {
        parent::setUp();                
    }

    /**
     * Testando conversão e salvamento de imagem.
     */
    public function test_text_with_image(): void
    {      
        $processor = new ImageProcessor();
        $html = '<p>Hello <img src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAADIAAAAyCAIAAACRXR/mAAAAd0lEQVR4nOzQMQ2AQBQEUSA0JEigRwwS6FGCL8SQE3HdaZhki1/MCNi87Hr1ewr1tT01taSGsskiySLJIskiySLJIskiySLJIskiySIVZc3v8ae2zmdLTRV9SxZJFkkWSRZJFkkWSRZJFkkWSRZJFqkoawQAAP///zkFzqqxtdwAAAAASUVORK5CYII="/> World</p>';        
        $id = 0;

        $result = $processor->trataImagemEnviada($html, $id);

        $this->assertStringContainsString('/storage/wiki/0/imgs/', $result);
        $this->assertFileExists(public_path('/storage/wiki/0/imgs/'));
    }

    /**
     * Testando conversão e salvamento de múltiplas imagens.
     */
    public function test_text_with_multiple_images(): void
    {      
        $processor = new ImageProcessor();
        $html = '<p>Hello 
                <img src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAADIAAAAyCAIAAACRXR/mAAAAd0lEQVR4nOzQMQ2AQBQEUSA0JEigRwwS6FGCL8SQE3HdaZhki1/MCNi87Hr1ewr1tT01taSGsskiySLJIskiySLJIskiySLJIskiySIVZc3v8ae2zmdLTRV9SxZJFkkWSRZJFkkWSRZJFkkWSRZJFqkoawQAAP///zkFzqqxtdwAAAAASUVORK5CYII="/>
                <img src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAADIAAAAyCAIAAACRXR/mAAAAd0lEQVR4nOzQMQ2AQBQEUSA09PihwQ8yqDBChxgEXH8iTsMkW/xiRsDmZdetPVOo4/1TU0tqKJsskiySLJIskiySLJIskiySLJIskixSUda8X19qq99naqroW7JIskiySLJIskiySLJIskiySLJIskhFWSMAAP//vfwGhlh6/TEAAAAASUVORK5CYII="/>                
                World
                </p>';        
        $id = 0;
        $result = $processor->trataImagemEnviada($html, $id);
        dump($result);

        $this->assertStringContainsString('/storage/wiki/0/imgs/', $result);
        $this->assertFileExists(public_path('/storage/wiki/0/imgs/'));
    }

    /**
     * Testando quando não á imagem.
     */
    public function test_text_without_image(): void
    {      
        $processor = new ImageProcessor();
        $html = '<p>Hello World</p>';        
        $id = 0;

        $processor->trataImagemEnviada($html, $id);        
        $checkDir = $this->isDirectoryEmpty(public_path('/storage/wiki/0/imgs/'));
        
        $this->assertTrue($checkDir);      
    }
    
    /**
     * Verifica se um diretório está vazio.
     *
     * @param string $directory Caminho do diretório
     * @return bool
     */
    private function isDirectoryEmpty(string $directory): bool
    {
        return is_dir($directory) && count(scandir($directory)) === 2;
    }
}
