<?php
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

/*
GET /accounts/1/transactions per ottenere l'elenco dei movimenti
GET /accounts/1/transactions/5 per ottenere il dettaglio di un movimento
POST /accounts/1/deposits per registrare un deposito
POST /accounts/1/withdrawals per registrare un prelievo
PUT /accounts/1/transactions/5 per modificare la descrizione di un movimento
DELETE /accounts/1/transactions/5 per eliminare un movimento secondo la regola scelta
*/
class MovimentiController
{
  /*
GET /accounts/{idAccount}/transactions per ottenere l'elenco dei movimenti
*/
  public function elencoMovimenti(Request $request, Response $response, $args){
    $mysqli_connection = new MySQLi('my_mariadb', 'root', 'ciccio', 'banca');
    $stmt = $mysqli_connection->prepare("SELECT * FROM transactions WHERE account_id = ? ");
    $stmt ->bind_param("i", $args['idAccount']);
    $results=[];
    if($stmt->execute())
    {
      $stmt->execute();
      $result = $stmt->get_result();
      if($result)
        $results = $result->fetch_all(MYSQLI_ASSOC);
      
    }
       

    $response->getBody()->write(json_encode($results));
    return $response->withHeader("Content-type", "application/json")->withStatus(200);
  }
  
/*
GET /accounts/{idAccount}/transactions/{idTransazione} per ottenere il dettaglio di un movimento
*/
  public function dettaglioMovimento(Request $request, Response $response, $args){
    $mysqli_connection = new MySQLi('my_mariadb', 'root', 'ciccio', 'banca');
    $stmt = $mysqli_connection->prepare("SELECT * FROM transactions WHERE account_id = ? AND id = ?");
    $stmt ->bind_param("ii", $args['idAccount'], $args['idTransazione']);
    $results=[];
    if($stmt->execute())
    {
      $stmt->execute();
      $result = $stmt->get_result();
      if($result)
        $results = $result->fetch_all(MYSQLI_ASSOC);
      
    }

    $response->getBody()->write(json_encode($results));
    return $response->withHeader("Content-type", "application/json")->withStatus(200);
  }

  /*
POST /accounts/{idAccount}/deposits per registrare un deposito
*/
  public function deposito(Request $request, Response $response, $args){
    $mysqli_connection = new MySQLi('my_mariadb', 'root', 'ciccio', 'banca');
    $result = $mysqli_connection->query("SELECT * FROM accounts");
    $results = $result->fetch_all(MYSQLI_ASSOC);

    $response->getBody()->write(json_encode($results));
    return $response->withHeader("Content-type", "application/json")->withStatus(200);
  }

  /*
POST /accounts/{idAccount}/withdrawals per registrare un prelievo
*/
  public function prelievo(Request $request, Response $response, $args){
    $mysqli_connection = new MySQLi('my_mariadb', 'root', 'ciccio', 'banca');
    $result = $mysqli_connection->query("SELECT * FROM accounts");
    $results = $result->fetch_all(MYSQLI_ASSOC);

    $response->getBody()->write(json_encode($results));
    return $response->withHeader("Content-type", "application/json")->withStatus(200);
  }

  /*
PUT /accounts/{idAccount}/transactions/{idTransazione} per modificare la descrizione di un movimento
*/
  public function descrizioneMovimento(Request $request, Response $response, $args){
    $mysqli_connection = new MySQLi('my_mariadb', 'root', 'ciccio', 'banca');
    $result = $mysqli_connection->query("SELECT * FROM accounts");
    $results = $result->fetch_all(MYSQLI_ASSOC);

    $response->getBody()->write(json_encode($results));
    return $response->withHeader("Content-type", "application/json")->withStatus(200);
  }

/*
DELETE /accounts/{idAccount}/transactions/{idTransazione} per eliminare un movimento secondo la regola scelta
*/
  public function eliminaMovimento(Request $request, Response $response, $args){
    $mysqli_connection = new MySQLi('my_mariadb', 'root', 'ciccio', 'banca');
    $result = $mysqli_connection->query("SELECT * FROM accounts");
    $results = $result->fetch_all(MYSQLI_ASSOC);

    $response->getBody()->write(json_encode($results));
    return $response->withHeader("Content-type", "application/json")->withStatus(200);
  }
}
