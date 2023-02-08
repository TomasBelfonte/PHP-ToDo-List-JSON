<?php
if(empty($_POST["newElement"])) {
    http_response_code(400);
    
    exit("non é stato modificato alcun dato");
    };
    //leggo il contenuto del file json di task.json 
    $elements = file_get_contents("../tasks.json");
    //converto la stringa ricevuta in un array associativo
    $elements = json_decode($elements , true);
    //recupere l'indice dell'elemento identico a quello ricevuto
    $indice;
    //per ogni elemento della lista controllo se il suo id corrisponde a quello richiesto
    //se lo trova salva su variabile $indice
    foreach($elements as $i => $post) {
    if($post["id"] === $_POST["id"]) {

        $indice = $i;
        }

    };


    $elements[$indice]["newElement"] = $_POST["newElement"];
    $elements[$indice]["createdAt"] =  date('Y-m-d H:i:s');

    $tasksjson = json_encode($elements, JSON_PRETTY_PRINT);

    //poso la stringa in tasks.json e passo la variabile convertita prima
    file_put_contents("../tasks.json" , $tasksjson);
    header("Content-Type:application/json");
    //converto l array in una stringa
    echo json_encode($elements[$indice]);
?>