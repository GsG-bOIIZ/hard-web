<?php

namespace App\Module\PhotoStorage;

use Symfony\Component\HttpFoundation\Request;

class PhotoStorage
{
    private const PATH = './data/';
    private const EXTENSIONS = '{png,jpg,jpeg}';
    private const ARRAY_EXTENSIONS = ['image/png', 'image/jpg', 'image/jpeg'];

    private Request $request;

    public function __construct()
    {
        $this->request = new Request(
            $_GET,
            $_POST,
            [],
            $_COOKIE,
            $_FILES,
            $_SERVER
        );
    }

    public function saveAvatar(string $key, string $dir): string
    {
        $file = $this->request->files->get($key) ?? null;
        if (($file->getError() === 0) && (in_array($file->getClientMimeType(), self::ARRAY_EXTENSIONS)))
        {            
            foreach ($this->getAllImages($dir) as $filename) 
            {
                unlink($filename);
            }
            $pathFile = $this->getPathFile($dir, $file->getClientMimeType());
            move_uploaded_file($file->getPathName(), $pathFile);   
            return " Avatar saved";
        }
        return " Avatar don't saved";
    }

    public function getAvatar(string $dir): ?string
    {
        return $this->getAllImages($dir) ? $this->getAllImages($dir)[0] : null;        
    }

    private function getAllImages(string $dir): array
    {
        return glob(self::PATH . "$dir/*." . self::EXTENSIONS, GLOB_BRACE);
    }

    private function getPathFile(string $dir, string $mimeType): string
    {
        return self::PATH . "$dir/" . uniqid() . '.' . explode("/", $mimeType)[1];     
    }
}