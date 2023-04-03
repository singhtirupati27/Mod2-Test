<?php

  /**
   * UserDb class hold database data.
   * This class have methods to insert and update data in databse.
   */
  class UserDb {
    public string $dbName;
    public string $dbUsername;
    public string $dbPassword;
    public object $connectionData;
    public string $username;
    public string $password;

    /**
     * It will initialize UserDb class with databasename, username and password.
     * 
     *  @param string $dbName
     *    Contains database name to be used.
     * 
     *  @param string $username
     *    Contains username of the database.
     * 
     *  @param string $password
     *    Contains password of the database.
     */
    public function __construct(string $dbName, string $username, string $password) {
      $this->dbName = $dbName;
      $this->dbUsername = $username;
      $this->dbPassword = $password;
      $this->databaseConnet();
    }

    /**
     * Function to connect database.
     */
    public function databaseConnet() {
      try {
        $this->connectionData = new PDO("mysql:host=localhost;dbname=$this->dbName", $this->dbUsername, $this->dbPassword);
        $this->connectionData->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      }
      catch(PDOException $e) {
        echo "Error while connecting database: " . $e->getMessage();
      }
    }

    /**
     * Funtion to close database connection.
     */
    public function disconnectDb() {
      $this->connectionData = NULL;
    }

    /**
     * Function to check whether login email and password exist in the database or not.
     * 
     *  @param string $username
     *    Contains user email used for login.
     * 
     *  @param string $password
     *    Contains user login password
     * 
     *  @return bool
     *    Return TRUE if data exists in database, if not then return FALSE.
     */
    public function checkLogin(string $username, string $password) {
      $this->databaseConnet();

      $query = $this->connectionData->prepare("SELECT * FROM admin WHERE user_email = :username AND user_password = :password");
      $query->bindParam(':username', $username);
      $query->bindParam(':password', $password);

      $query->execute();

      // Check how many rows are returned
      if($query->rowCount() == 1) {
        return TRUE;
      }
      else {
        return FALSE;
      }
    }

    /**
     * Function to check whether username or email exists in the database or not.
     * 
     *  @param string $email
     *    Contains user email used for login.
     * 
     *  @return bool
     *    Return TRUE if data exists in database, if not then return FALSE.
     */
    public function checkUserNameExists($email) {
      $this->databaseConnet();

      $query = $this->connectionData->prepare("SELECT * FROM admin WHERE user_email = :email");
      $query->bindParam(':email', $email);

      $query->execute();

      // Check how many rows are returned
      if($query->rowCount() == 1) {
        return TRUE;
      }
      else {
        return FALSE;
      }
    }

    public function getUsername($email) {
      $this->databaseConnet();

      $query = $this->connectionData->prepare("SELECT user_name FROM user_info
        INNER JOIN admin
        ON user_info.user_id = admin.user_id
        WHERE user_email = :email");

      $query->bindParam(':email', $email);
      $query->execute();

      $response = $query->fetchColumn();

      return $response;
    }

    public function getUserId($email) {
      $this->databaseConnet();

      $query = $this->connectionData->prepare("SELECT user_id FROM admin WHERE user_email = :email");

      $query->bindParam(':email', $email);
      $query->execute();

      $response = $query->fetchColumn();

      return $response;
    }

    public function fetchCategory2() {
      $this->databaseConnet();

      $query = $this->connectionData->prepare("SELECT * FROM unhealthy_snacks");
      $query->execute();

      $response = $query->fetchAll();

      return $response;
    }

    public function getCategory1() {
      $this->databaseConnet();

      $limit_per_page = 4;

      $page = "";

      if(isset($_POST["page_no"])) {
        $page = $_POST["page_no"];
      }
      else {
        $page = 1;
      }

      $offsets = ($page - 1) * $limit_per_page;

      $query = $this->connectionData->prepare("SELECT * FROM healthy_snacks LIMIT {$offsets}, {$limit_per_page}");
      $query->execute();

      $response = $query;
      $rows = $response->rowCount();
      $data = $response->fetchAll();

      $output = "";
      if($rows >= 1) {

        foreach($data as $value) {
          $item_id = $value["item_id"];
          $item_name = $value["item_name"];
          $item_price = $value["item_price"];
          $output .= "<div class='category1-list'>
                        <div class='item-box'>
                          <div class='item-name'>
                            <input type='checkbox' name='purchase[]' id='{$item_id}' value='{$item_id}'>
                            <h2>Item: {$item_name}</h2>
                          </div>
                          <div class='item-price'>
                            <h3>Price: Rs {$item_price}</h3>
                          </div>
                          <div class='unit'>
                            <label for='unit'>Quantity:</label>
                            <input type='number' name='unit' id='quantity'>
                          </div>
                        </div>";
        }
        $output .= "</div>";
        
        $query = $this->connectionData->prepare("SELECT * FROM healthy_snacks");
        $query->execute();

        $total_records = $query->rowCount();
        $total_pages = ceil($total_records/$limit_per_page);

        $outputs = "";
        $outputs .= '<div id="pagination">';

        for($i = 1; $i <= $total_pages; $i++) {
          if($i == $page) {
            $class_name = "";
            $color = "white";
            $background_color = "#ff554f";  
          }
          else {
            $class_name = "active";
            $color = "#ff554f";
            $background_color = "white";
          }

          $outputs .= "<a class='{$class_name}' id='{$i}' href='' style='background-color:{$background_color}; color:{$color};'>{$i}</a>";
        }

        $outputs .= '</div>';
      }
      else {
        return "No items found.";
      }

      return [$output, $outputs];
    }

    public function getCategory2() {
      $this->databaseConnet();

      $limit_per_page = 4;

      $page = "";

      if(isset($_POST["page_no"])) {
        $page = $_POST["page_no"];
      }
      else {
        $page = 1;
      }

      $offsets = ($page - 1) * $limit_per_page;

      $query = $this->connectionData->prepare("SELECT * FROM unhealthy_snacks LIMIT {$offsets}, {$limit_per_page}");
      $query->execute();

      $response = $query;
      $rows = $response->rowCount();
      $data = $response->fetchAll();

      $output = "";
      if($rows >= 1) {

        foreach($data as $value) {
          $item_id = $value["item_id"];
          $item_name = $value["item_name"];
          $item_price = $value["item_price"];
          $output .= "<div class='category1-list'>
                        <div class='item-box'>
                          <div class='item-name'>
                            <input type='checkbox' name='purchase[]' id='{$item_id}' value='{$item_id}'>
                            <h2>Item: {$item_name}</h2>
                          </div>
                          <div class='item-price'>
                            <h3>Price: Rs {$item_price}</h3>
                          </div>
                          <div class='unit'>
                            <label for='unit'>Quantity:</label>
                            <input type='number' name='unit' id='quantity'>
                          </div>
                        </div>";
        }
        $output .= "</div>";
        
        $query = $this->connectionData->prepare("SELECT * FROM unhealthy_snacks");
        $query->execute();

        $total_records = $query->rowCount();
        $total_pages = ceil($total_records/$limit_per_page);

        $outputs = "";
        $outputs .= '<div id="pagination">';

        for($i = 1; $i <= $total_pages; $i++) {
          if($i == $page) {
            $class_name = "";
            $color = "white";
            $background_color = "#ff554f";
          }
          else {
            $class_name = "active";
            $color = "#ff554f";
            $background_color = "white";
          }

          $outputs .= "<a class='{$class_name}' id='{$i}' href='' style='background-color:{$background_color}; color:{$color};'>{$i}</a>";
        }

        $outputs .= '</div>';
      }
      else {
        return "No items found.";
      }

      return [$output, $outputs];
    }

  }
  
?>
