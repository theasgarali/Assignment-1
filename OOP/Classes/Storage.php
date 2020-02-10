<?php

//This file is called from add.php to STORE the movie images.

namespace OOP\Classes;

class Storage{
    public function __construct(){
    }

    public static function save($file, $subPath){
        
        //Loop for 40 times and get one number randomly from $character variable to give the image name.
        $n=40; 
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ'; 
        $randomString = ''; 
    
        for ($i = 0; $i < $n; $i++) { 
            $index = rand(0, strlen($characters) - 1); 
            $randomString .= $characters[$index]; 
        }

        $currentDir = getcwd();
        $uploadDirectory = "/../../".STORAGE_PATH."/".$subPath;
    
        $errors = [];
    
        $fileName = $file['name'];
        $fileSize = $file['size'];
        $fileTmpName  = $file['tmp_name'];
        $fileType = $file['type'];
        $name_exploded = explode(".", $fileName);
        $fileExtension = end($name_exploded);

        $save_fileName = $randomString . '.' .$fileExtension;
    
        $uploadPath = $currentDir . $uploadDirectory . '/' . $save_fileName;
        $didUpload = move_uploaded_file($fileTmpName, $uploadPath);

        return $subPath . '/' . $save_fileName;
    }

    // Delete function is used to delete the Movie image. 
    public static function delete($path){
        $currentDir = getcwd();
        $storageSubPath = "/../../".STORAGE_PATH;
        $file = $currentDir . $storageSubPath . '/' . $path;

        unlink($file);
    }
}