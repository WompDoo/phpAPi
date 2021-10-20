<?php
use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;

/**
 * Get Art
 */
// create GET HTTP request
$app->get('/api/product', function( Request $request, Response $response){
     $sql = "SELECT * FROM products";
 
    try {
      // Get DB Object
      $db = new db();
  
      // connect to DB
      $db = $db->connect();
  
      // query
      $stmt = $db->query( $sql );
      $products = $stmt->fetchAll( PDO::FETCH_OBJ );
      $db = null; // clear db object
  
      // print out the result as json format
      echo json_encode( $products );    
        
    } catch( PDOException $e ) {
      // show error message as Json format
      echo '{"error": {"msg": ' . $e->getMessage() . '}';
    }
})->name("data");
/**
 * Add new Art data
 */
// create POST HTTP request
$app->post('/api/product/add', function( Request $request, Response $response){

  // get the parameter from the form submit
  $name = $request->getParam('name');
  $date = $request->getParam('date');
  $max_price = $request->getParam('max_price');
  $min_price = $request->getParam('min_price');
  $no_to_be_sold = $request->getParam('no_to_be_sold');
  
  $sql = "INSERT INTO products (name, date, max_price, min_price, no_to_be_sold) 
          VALUES(:name,:date,:max_price,:min_price,:no_to_be_sold)";
          echo "hello";

  try {
    // Get DB Object 
    $db = new db();

    // connect to DB
    $db = $db->connect();

    // https://www.php.net/manual/en/pdo.prepare.php
    $stmt = $db->prepare( $sql );

    // bind each paramenter
    // https://www.php.net/manual/en/pdostatement.bindparam.php
    $stmt->bindParam(':name', $name);
    $stmt->bindParam(':date', $date);
    $stmt->bindParam(':max_price', $max_price);
    $stmt->bindParam(':min_price', $min_price);
    $stmt->bindParam(':no_to_be_sold', $no_to_be_sold);

    // execute sql
    $stmt->execute();
    
    // return the message as json format
    echo '{"notice" : {"msg" : "New product added to products."}';

  } catch( PDOException $e ) {

    // return error message as Json format
    echo '{"error": {"msg": ' . $e->getMessage() . '}';
  }
});
