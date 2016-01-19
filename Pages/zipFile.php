<?php
function zipFile($dirToZip){
    $dirToZip = realpath($dirToZip);
    echo 'Zipping ' . $dirToZip ;
    $zipObj = new ZipArchive();
    $zip->open('project.zip', ZipArchive::CREATE | ZipArchive::OVERWRITE);
    if(!$zip){
        die('Failed to make Zip Object');
    }
    $files = new RecursiveIteratorIterator(
        new RecursiveDirectoryIterator($dirToZip),
        RecursiveIteratorIterator::LEAVES_ONLY
    );
    foreach ($files as $name => $file){
        if (!$file->isDir())
        {
            echo 'Adding ' . $file . ' to Zip';
            $filePath = $file->getRealPath();
            $relativePath = substr($filePath, strlen($$dirToZip) + 1);
            $zip->addFile($filePath,$relativePath);
        }
    }
    
    $zip->close();
    
}

zipFile('/home/ubuntu/workspace/Content/Asset2/Project');

?>