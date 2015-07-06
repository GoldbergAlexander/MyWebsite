<?php
function myCopy($source, $target) {
        if (!is_dir($source)) {//it is a file, do a normal copy
            copy($source, $target);
            return;
        }

        //it is a folder, copy its files & sub-folders
        @mkdir($target);
        $d = dir($source);
        $navFolders = array('.', '..');
        while (false !== ($fileEntry=$d->read() )) {//copy one by one
            //skip if it is navigation folder . or ..
            if (in_array($fileEntry, $navFolders) ) {
                continue;
            }

            //do copy
            $s = "$source/$fileEntry";
            $t = "$target/$fileEntry";
            myCopy($s, $t);
        }
        $d->close();
    }
?>