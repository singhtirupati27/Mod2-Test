<?php

  /**
   * Base class to load model and view.
   */
  class Framework {

    /**
     * Function to load web page.
     * If file exists it load else error page will be load.
     * 
     *  @param $filename
     *    Contains file name.
     */
    public function view($filename) {
      $dir = 'application/view/' . $filename . '.php';

      if(file_exists($dir)) {
        require_once $dir;
      }
      else {
        $this->error("error");
      }
    }

    /**
     * Function to load model page.
     * If file exists it require model page else error page will be load.
     * 
     *  @param $filename
     *    Contains file name.
     */
    public function model($filename) {
      $dir = 'application/model/' . ucfirst($filename) . '.php';
      
      if(file_exists($dir)) {
        require_once $dir;
      }
      else {
        $this->error("error");
      }
    }

    /**
     * Function to load error page.
     * 
     *  @param $filename
     *    Contains file name.
     */
    public function error($filename) {
      $dir = 'application/view/' . $filename . '.php';

      if(file_exists($dir)) {
        require_once $dir;
      }
    }
    
  }
  
?>
