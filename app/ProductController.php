<?php
session_start();
if(isset($_POST["action"])){
    $productController = new ProductController();
    switch ($_POST["action"]) {
        case 'create':
            $name = strip_tags($_POST["name"]);
            $slug = strip_tags($_POST["slug"]);
            $description = strip_tags($_POST["description"]);
            $features = strip_tags($_POST["features"]);
            $brand_id = strip_tags($_POST["brand_id"]);
            
            $productController->storeProduct($name, $slug, $description, $features, $brand_id);
            break;
        default:
            # code...
            break;
    }
}
Class ProductController {
    public function storeProduct($name, $slug, $description, $features, $brand_id){
        if($_FILES["cover"]["error"] > 0){
            header("Location: ../products?error=Imposible subir sin imagen");
        }
       
        $imagen = $_FILES["cover"]["tmp_name"];

        $curl = curl_init();

        curl_setopt_array($curl, array(
        CURLOPT_URL => 'https://crud.jonathansoto.mx/api/products',
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => 'POST',
        CURLOPT_POSTFIELDS => array('name' => $name,'slug' => $slug,'description' => $description,'features' => $features,'brand_id' => $brand_id,
        'cover'=> new CURLFILE($imagen)),
        CURLOPT_HTTPHEADER => array(
            'Authorization: Bearer '.$_SESSION["token"].''
        ),
        ));

        $response = curl_exec($curl);

        curl_close($curl);
        $response = json_decode($response);
     
        if(isset($response->code) && $response->code > 0){
            header("Location: ../products?success=true");
        }else{
            header("Location: ../products?error=$response->message");
        }

    }
    public function getProductos(){
 
        $curl = curl_init();

        curl_setopt_array($curl, array(
        CURLOPT_URL => 'https://crud.jonathansoto.mx/api/products',
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => 'GET',
        CURLOPT_HTTPHEADER => array(
            'Authorization: Bearer '.$_SESSION["token"].'',
            'Cookie: XSRF-TOKEN=eyJpdiI6ImdWbDVRYjBzOEJTRzNvVERrejNmUFE9PSIsInZhbHVlIjoiYzlaM1EyRXBSSit5dzdOV2RzRHNkc2JVRjArZGZ2Q2lCZVM1ejJFMmRsSFdtTkFpNUJyblpoMEdiV002NEpoUUVDSkdvNGtxeXp5YlNFa2dwK3FrRDV0bFZXR0NNQ01qcTdkY0pqZElodDNyc0tZNEpMcEdrNllFRk1IMXBINnEiLCJtYWMiOiI3YzYxMWIxZGM5MDZjMTlhMDMwZjhjOWJiN2Y2ZmJjNzJlNmEwZDViZGMwODRmMDRiNzBkYWJkZDQxOTc5MzdhIiwidGFnIjoiIn0%3D; laravel_session=eyJpdiI6IlhyL0dwZWxTL3MxbHU5Zk1FVTBId3c9PSIsInZhbHVlIjoiM3UzU1BocUFDZjhjUlhiM2hldElPM0RrQWxFdm1DSnh2Q1FjYnoyOTNLa1BFeW1CbWVoSmpZR05abHZMQVJ6NXBLWGZaalNtc3VwMkovdE5lYWY5dzhLOXZXaVFhNlBrdGFuMXdndVA4WWJLQmQ3SkN0cS8yc0RNajY3NFExNFQiLCJtYWMiOiI5MzIxZjZiODczMzY2YTNjYWQzZGZkNTNjNDUxMDRkNTliZWMzMjY5ZDdhNmI0OGYyNjdkNjRjNTFkZGRkYTc2IiwidGFnIjoiIn0%3D'
        ),
        ));

        $response = curl_exec($curl);
        
        curl_close($curl);
        $response = json_decode($response, true);
        
        return $response["data"];
    }

    public function getProduct($id){
        $curl = curl_init();

        curl_setopt_array($curl, array(
        CURLOPT_URL => 'https://crud.jonathansoto.mx/api/products/'.$id, //id product
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => 'GET',
        CURLOPT_HTTPHEADER => array(
            'Authorization: Bearer '.$_SESSION['token'],
            'Cookie: XSRF-TOKEN=eyJpdiI6ImFoR0lIZ2pDMlhEQzlMdDMvSG4rYlE9PSIsInZhbHVlIjoiM0Z6M1lZUmQwejUzSzBMM2RrdDJTN21YWTdPakxEeGZFcXhLOEpoekxkSnBGSXc2Qlo2RktPTmFwWWRvODAwOHUrTmw1NjVRZHFXWi9STkF1U3lWVUJRcjlITU14djRtVCtnY0txMzQycnlVdWhCKytyckU3ZW9CSjVKVXRqOVQiLCJtYWMiOiI2MTc3NTZiZDBiOWUwMjc2ZTc4OTZlOTRiOWIyOGY5ZWQ1NDNjZDYyNzgxM2I4NGJjYjY2ZmY3NTc1YTY1YWRkIiwidGFnIjoiIn0%3D; laravel_session=eyJpdiI6InNQQ2lIV1F5T2F2RFhkSEpMRlRGK2c9PSIsInZhbHVlIjoiK1J5K1RwRHQ3T3M1UlhJYW9qMjB5TzdNcHEyME82WHJZeGd2eURHZ3FybThsSHZkbmNsTEl3blRJYUZjcG1WWlB3K3RPVks0SWl4Tng1Y3BqcHg0ekN2NlpDR1JEYTdCY0QxRGpwcG1mOUxKT3dzN0pWM1czdm5UL0svQWJwWjYiLCJtYWMiOiJmNDljM2MxNmFmZDBkYjRjMjNjODA3NGU4ODI0NjA0MjNiNGQ1ZWIwZTVjOWM2ZDMxN2I4ZWNlMGQ5MGQxYjNlIiwidGFnIjoiIn0%3D'
        ),
        ));

        $response = curl_exec($curl);

        curl_close($curl);
  
        $response = json_decode($response, true);
        
        return $response["data"];

    }
}

?>