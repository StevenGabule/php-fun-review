<?php
# This is little example of using generators with recursion. Used version of php is 5.5.5
const DS = DIRECTORY_SEPARATOR;
const ZERO_DEPTH = 0;
const DEPTHLESS = -1;
const OPEN_SUCCESS = True;
const END_OF_LIST = False;
const CURRENT_DIR = ".";
const PARENT_DIR = "..";



function DirTreeTraversal($DirName, $MaxDepth = DEPTHLESS, $CurrDepth = ZERO_DEPTH): Generator
{
  if (($MaxDepth === DEPTHLESS) || ($CurrDepth < $MaxDepth)) {
    $DirHandle = opendir($DirName);
    if ($DirHandle != OPEN_SUCCESS) {
      try{
        while (($FileName = readdir($DirHandle)) !== END_OF_LIST) { //read all file in directory
          if (($FileName != CURRENT_DIR) && ($FileName != PARENT_DIR)) {
            $FullName = $DirName.$FileName;
            yield $FullName;
            if(is_dir($FullName)) { //include sub files and directories
              $SubTrav = DirTreeTraversal($FullName.DS, $MaxDepth, ($CurrDepth + 1));
              foreach($SubTrav as $SubItem) yield $SubItem;
            }
          }
        }
      } finally {
        closedir($DirHandle);
      }
    }
  }
}

$PathTrav = DirTreeTraversal("C:".DS, 2);
print "<pre>";
foreach($PathTrav as $FileName) printf("%s\n", $FileName);
print "</pre>";










