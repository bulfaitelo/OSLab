<?php

namespace Tests\Unit\Services\Html;

use App\Services\Html\ImageProcessor;
use Tests\TestCase;

class ImageProcessorTest extends TestCase
{
    private $fileId = 0;

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

        $result = $processor->trataImagemEnviada($html, $this->fileId);        

        $this->assertStringContainsString('/storage/wiki/'.$this->fileId.'/imgs/', $result);
        $this->assertEquals(1, $this->countFile());
        $this->assertFileExists($this->publicPath());
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
                World</p>';
        $result = $processor->trataImagemEnviada($html, $this->fileId);               
        
        $this->assertStringContainsString('/storage/wiki/'.$this->fileId.'/imgs/', $result);
        $this->assertEquals(2, $this->countFile());
        $this->assertFileExists($this->publicPath());
    }

    /**
     * Testando conversão e atualização de múltiplas imagens.
     */
    public function test_text_update_with_multiple_images(): void
    {      
        $processor = new ImageProcessor();
        $html = 'Hello World 
                <img src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAADIAAAAyCAIAAACRXR/mAAAAd0lEQVR4nOzQMQ2AQBQEUSA0JEigRwwS6FGCL8SQE3HdaZhki1/MCNi87Hr1ewr1tT01taSGsskiySLJIskiySLJIskiySLJIskiySIVZc3v8ae2zmdLTRV9SxZJFkkWSRZJFkkWSRZJFkkWSRZJFqkoawQAAP///zkFzqqxtdwAAAAASUVORK5CYII="/>
                <img src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAADIAAAAyCAIAAACRXR/mAAAAd0lEQVR4nOzQMQ2AQBQEUSA09PihwQ8yqDBChxgEXH8iTsMkW/xiRsDmZdetPVOo4/1TU0tqKJsskiySLJIskiySLJIskiySLJIskixSUda8X19qq99naqroW7JIskiySLJIskiySLJIskiySLJIskhFWSMAAP//vfwGhlh6/TEAAAAASUVORK5CYII="/>                
                
                ';        
        $preResult = $processor->trataImagemEnviada($html, $this->fileId);        

        $updatedText = substr($preResult, 0, -4);
        $updatedText = preg_replace("/<img[^>]+\>/i", "", $updatedText, limit: 1);
        $htmlMewImage  = $updatedText.'<img src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABQAAAAUCAIAAAAC64paAAAAM0lEQVR4nGL56H+JATf4ctsTjywTHjmCYFTzyNDMyOefj0d6cpwtrWwe1TwyNAMCAAD//5GFBk7Ss+FqAAAAAElFTkSuQmCC"/></p>';        
        $result = $processor->trataImagemEnviada($htmlMewImage, $this->fileId);
        
        $this->assertStringContainsString('/storage/wiki/'.$this->fileId.'/imgs/', $result);
        $this->assertEquals(2, $this->countFile());
        $this->assertFileExists($this->publicPath());
    }

    /**
     * Testando quando não á imagem.
     */
    public function test_text_without_image(): void
    {      
        $processor = new ImageProcessor();
        $html = '<p>Hello World</p>';        
        $processor->trataImagemEnviada($html, $this->fileId);      
                  
        $this->assertEquals(0, $this->countFile());        
    }   


    /**
     * Conta os arquivos do diretório de teste. 
     * 
     * @return int
     */
    private function countFile(): int
    {
        if (is_dir($this->publicPath())) {
            return count(scandir($this->publicPath())) - 2;
        }
        return 0;
    }

    /**
     * Retorna o diretório para o teste. 
     *
     * @return string     
     **/
    public function publicPath(): string
    {
        return public_path('/storage/wiki/'.$this->fileId.'/imgs/');
    }
}
