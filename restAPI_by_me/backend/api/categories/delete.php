<?php 
  // Headers
  header('Access-Control-Allow-Origin: *');
  header('Content-Type: application/json');
  header('Access-Control-Allow-Methods: DELETE');
  header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods, Authorization, X-Requested-With');

  include_once '../../config/Database.php';
  include_once '../../models/categories.php';

  // Instantiate DB & connect
  $database = new Database();
  $db = $database->connect();

  // Instantiate blog post object
  $categorie = new Categories($db);

  // Get raw categorieed data
  $data = json_decode(file_get_contents("php://input"));

  // Set ID to update
  $categorie->ID = $data->ID;

  // Delete categorie
  if($categorie->delete()) {
    echo json_encode(
      array('message' => 'categorie is  Deleted')
    );
  } else {
    echo json_encode(
      array('message' => 'unseccessful Deleted')
    );
  }

?>