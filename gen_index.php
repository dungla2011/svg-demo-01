<?php

function output($filename,$string)
{
    $file = fopen($filename, "a");
    if(!$file)
        return;
    fputs($file, $string."\r\n");
    fclose($file);
}


function ListDirSortABC($dirpath, $ignoreCaseSen = 0, $des = 0)
{

    if (!is_dir($dirpath))
        return NULL;

    if ($dirpath[strlen($dirpath) - 1] <> '/')
        $dirpath .= '/';

    //inr($dirpath);

    $d = dir($dirpath); //need sort this a->z

    if (!$d)
        return NULL;

    $count = 0;

    $dirsort = array();

    while (false !== ($entry = $d->read())) {

        if ($entry[0] != '.') {
            //echo chr(10).$count."-".$entry;
            $dirsort[$count] = $entry;
            $count++;
        }
    }


    if ($count) {
        if ($des == 1)
            array_multisort(array_map('strtolower', $dirsort), SORT_DESC, SORT_STRING, $dirsort);
        else
            array_multisort(array_map('strtolower', $dirsort), SORT_ASC, SORT_STRING, $dirsort);
    }

    return $dirsort;
}
//$arrFull = array();
//DirListFullToArray($dirPath,$arrFull);
function DirListFullToArray($dir,&$arrFull)
{
    $arr = ListDirSortABC($dir);
    for ($i=0;$i<count($arr);$i++)
    {
        $arrFull[] =  $dir.'/'.$arr[$i];
        if (is_dir($dir.'/'.$arr[$i]))
        {
            DirListFullToArray($dir.'/'.$arr[$i],$arrFull);
            //inl($countBook.". OK BOOK TO ZIP: ".$dir);
        }
    }
}

function ListDirFullToArray($dir,&$arrFull)
{
    $arr = ListDirSortABC($dir);
    for ($i=0;$i<count($arr);$i++)
    {
        $arrFull[] =  $dir.'/'.$arr[$i];
        if (is_dir($dir.'/'.$arr[$i]))
        {
            DirListFullToArray($dir.'/'.$arr[$i],$arrFull);
            //inl($countBook.". OK BOOK TO ZIP: ".$dir);
        }
    }
}


$m1 = [];

ListDirFullToArray(__DIR__, $m1);

unlink(__DIR__."/index.html");
foreach ($m1 AS $file){

    if(strstr($file, '.html') || strstr($file, '.htm')){
        $pathName = str_replace(__DIR__, "", $file);
        output(__DIR__."/index.html", "<a target='_blank' href='/demo_web$pathName'> $pathName </a><br>");
    }

}

?>