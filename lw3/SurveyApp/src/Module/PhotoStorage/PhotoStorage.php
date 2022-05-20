<?php

namespace App\Module\PhotoStorage;

class PhotoStorage
{
    private const PATH = './data/';
    private const EXTENSIONS = '{png,jpg,jpeg}';
    private const ARRAY_EXTENSIONS = ['image/png', 'image/jpg', 'image/jpeg'];

    public function saveAvatar(string $key, string $dir): string
    {
        $file = $_FILES[$key] ?? null;
        if (($file['error'] === 0) && (in_array($file["type"], self::ARRAY_EXTENSIONS)))
        {            
            foreach ($this->getAllImages($dir) as $filename) 
            {
                unlink($filename);
            }
            $pathFile = self::PATH . "$dir/" . $file['name'];
            move_uploaded_file($file['tmp_name'], $pathFile);   
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
}