<?php
define('MAIN_FOLDER','temp_logs/');
class ShittyLog {


  private $accessKeyName = 'accessKey';
  private $folderKeyName = 'u';

  function __construct() {
   $currentFolder = $this->getKeyUsingPriority($this->folderKeyName);
   $accessKey = $this->getKeyUsingPriority($this->accessKeyName);

   $hasAccess = false;
   if ($currentFolder && $accessKey) {
    $hasAccess = $this->checkAccess($currentFolder, $accessKey);
   }


   if (!$hasAccess || !$currentFolder || !$accessKey) {
    $accessKey = $this->createUniqueKey();
    $currentFolder = $this->createUniqueKey();
    $folderPath = $this->getFolderPath($currentFolder);
    mkdir($folderPath);
    file_put_contents($folderPath. '/' . $accessKey . '.txt', "shittyLog\n");
   }

   define('USER_FOLDER', $currentFolder);
   define('USER_ACCESS_KEY', $accessKey);
   setcookie($this->accessKeyName, $accessKey);
   setcookie($this->folderKeyName, $currentFolder);
   if (isset($_REQUEST['logData']) && !empty($_REQUEST['logData'])) {
    $this->logToUserFile($_REQUEST['logData']);
   }
  }

  function getFolderPath($folderName) {
    return './' .   MAIN_FOLDER . ltrim($folderName, '\\,/');
  }


  function checkAccess($folderName, $accessKey) {
    $sanitizedFolderName = ltrim($folderName, '\\,/');
    $exactFolderPath = './' .   MAIN_FOLDER . $sanitizedFolderName;
    $isDir = is_dir($exactFolderPath);
    $hasAccessKey = !$isDir ? false : file_exists($exactFolderPath .'/'. $accessKey.'.txt');
    return ($isDir && $hasAccessKey);
  }
  /* priority
    -> Header
    -> Cookie
    -> Request
  */
  function getKeyUsingPriority($keyName) {
    $headerVal = $this->safeGetObjectValue($_SERVER, $keyName);
    $cookieVal = $this->safeGetObjectValue($_COOKIE, $keyName);
    $requestVal = $this->safeGetObjectValue($_REQUEST, $keyName);
    $arr = array($headerVal, $cookieVal, $requestVal);
    $result = array_filter($arr, function ($var) {
      if (!$var) {
        return false;
      }
      return $var;
    });
    if (count($result) > 0) {
      return array_values($result)[0];
    }
    return false;
  }

  function safeGetObjectValue($arr, $keyName) {
    if(isset($arr[$keyName]) && !empty($arr[$keyName])) {
      return $arr[$keyName];
    }
    return false;
  }


  function createUniqueKey() {
    // yes :)
    // https://stackoverflow.com/questions/6564251/generate-a-unique-key
    $key = md5(microtime().rand());
    return $key;
  }

  function logToUserFile($logData) {
    $logFileExactPath = './'.MAIN_FOLDER.USER_FOLDER.'/'.USER_ACCESS_KEY.'.txt';
    $deleteContent = isset($_REQUEST['del']);
    if ($deleteContent) {
      file_put_contents($logFileExactPath, $logData ."\n");
      echo('log & delete older success!');exit;
    } else {
      file_put_contents($logFileExactPath, $logData ."\n", FILE_APPEND);
      echo('log success!');exit;
    }
  }
}


new ShittyLog();
$mainPage = 'http://shittylog.com';
$userEndpoint = define('USER_ENDPOINT', $mainPage.'?u='.USER_FOLDER.'&accessKey='.USER_ACCESS_KEY);
$userLogFile = define('USER_LOG_FILE', $mainPage .'/'.MAIN_FOLDER.USER_FOLDER.'/'.USER_ACCESS_KEY.'.txt');
?>