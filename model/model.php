<?php

class Post {
    public $conn;
    public $id;
    public $name;
    public $price;
    public $dish;
    public $cook;



    public function __construct($db){ 
         $this->conn = $db;
    }

    public function read(){
               $sql = 'select user.name,user.price,food.dish,food.id
               from food
                left join user on food.cook_id = user.id
                order by user.name
                ';
               $statement = $this->conn->prepare($sql);
               $statement->execute();
               return $statement;
    }




//create food

function create(){
   
 
    $sql = 'insert into food 
           Set cook_id = :cook, 
                 dish = :dish
      ';

      $statement = $this->conn->prepare($sql);
      $this->cook =  htmlspecialchars(strip_tags($this->cook));
      $this->dish =  htmlspecialchars(strip_tags($this->dish));
       

      $statement->bindParam(':cook', $this->cook);
      $statement->bindParam(':dish', $this->dish);

      if($statement->execute()) {
        return true;
    }

    printf("Error: %s.\n", $statement->error);
    return false;
   }



//delete
function delete(){
     $sql = 'delete from food where id = :id';

     $statement = $this->conn->prepare($sql);
     $this->id = htmlspecialchars(strip_tags($this->id));
     $statement->bindParam(':id',$this->id);

     if($statement->execute()){
          return true;
     }

     printf("Error: %s.\n", $statement->error);
     return false;
}

//update
public function update() {
    // Create query
    $query = 'update user set
              name = :name,
              price = :price
              where id = :id
             ';

    // Prepare statement
    $stmt = $this->conn->prepare($query);

    // Clean data
    $this->name = htmlspecialchars(strip_tags($this->name));
    $this->price = htmlspecialchars(strip_tags($this->price));
    $this->id = htmlspecialchars(strip_tags($this->id));


    // Bind data
    $stmt->bindParam(':name', $this->name);
    $stmt->bindParam(':price', $this->price);
    $stmt->bindParam(':id', $this->id);
    

    // Execute query
    if($stmt->execute()) {
      return true;
    }

    // Print error if something goes wrong
    printf("Error: %s.\n", $stmt->error);

    return false;
}




}

?>