<?php

/**
 * @package		ATS PHP MVC
 * @author		Atish Chandole
 * @since       31 May 2021
 */

class framework
{

   public function view($viewName, $data = [])
   {

      if (file_exists("application/views/" . $viewName . ".php")) {
         extract($data);
         require_once "application/views/$viewName.php";
      } else {
         echo "<div style='margin:0;padding: 10px;background-color:silver;'>Sorry $viewName.php file not found </div>";
         die;
      }
   }

   public function model($modelName)
   {

      if (file_exists("application/models/" . $modelName . ".php")) {

         require_once "application/models/$modelName.php";

         $modelArray = explode('/', $modelName);
         $modelName = end($modelArray);

         return new $modelName;
      } else {
         echo "<div style='margin:0;padding: 10px;background-color:silver;'>Sorry $modelName.php file not found </div>";
         die;
      }
   }

   public function input($inputName)
   {
      if ($_SERVER['REQUEST_METHOD'] == "POST" || $_SERVER['REQUEST_METHOD'] == 'post') {
         return trim(strip_tags($_POST[$inputName]));
      } else if ($_SERVER['REQUEST_METHOD'] == 'GET' || $_SERVER['REQUEST_METHOD'] == 'get') {
         return trim(strip_tags($_GET[$inputName]));
      }
   }

   public function helper($helperName)
   {

      if (file_exists("system/helpers/" . $helperName . ".php")) {

         require_once "system/helpers/" . $helperName . ".php";
      } else {
         echo "<div style='margin:0;padding: 10px;background-color:silver;'>Sorry helper $helperName file not found </div>";
         die;
      }
   }

   public function setSession($sessionName, $sessionValue)
   {

      if (!empty($sessionName) && !empty($sessionValue)) {
         $_SESSION[$sessionName] = $sessionValue;
      }
   }

   public function getSession($sessionName)
   {
      if (isset($_SESSION[$sessionName])) {
            return $_SESSION[$sessionName];
      }
   }

   public function unsetSession($sessionName)
   {

      if (!empty($sessionName)) {

         unset($_SESSION[$sessionName]);
      }
   }

   public function destroy()
   {

      session_destroy();
   }

   public function setFlash($sessionName, $msg)
   {

      if (!empty($sessionName) && !empty($msg)) {

         $_SESSION[$sessionName] = $msg;
      }
   }

   public function flash($sessionName, $className)
   {

      if (!empty($sessionName) && !empty($className) && isset($_SESSION[$sessionName])) {

         $msg = $_SESSION[$sessionName];

         echo "<div class='" . $className . "'>" . $msg . "</div>";
         unset($_SESSION[$sessionName]);
      }
   }

   public function redirect($path)
   {
      header("location:" . BASEURL . $path);
   }
}
