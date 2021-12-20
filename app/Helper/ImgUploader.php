<?php namespace App\Helper;

use App\core\Validation;

class ImgUploader{
    protected Validation $validation;
      // image uploader
      public function __construct() {
          $this->validation = new Validation;
      }
      public function imgUploader($pic)
      {
          if (!file_exists($pic['tmp_name'])) {
              $this->validation->set('pic', 'no file founded');
              return;
          }
  
          // validation the img direction path
          if (!is_dir('/uploads'))
              mkdir('/uploads');
  
          // declare the img path
          $ImgUrl = './uploads/' . $pic['name'];
  
          // add img to the path
          $result = move_uploaded_file($pic['tmp_name'], $ImgUrl);
  
          // validate the upload result
          if ($result) {
              echo ($ImgUrl);
          } else {
              $this->validation->set('pic', 'there is no path for file');
              return;
          }
  
          return $ImgUrl;
      }
  
      public function DeleteFile($FilePath)
      {
          if (file_exists($FilePath))
              $result = unlink($FilePath);
  
          if (!$result) {
              $this->validation->set('pic', 'there is no file for delete');
              return;
          }
      }
  
}