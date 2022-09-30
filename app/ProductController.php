<?php
session_start();
if(isset($_POST["action"])){
    
    switch ($_POST["action"]) {
        case 'create':
            $name = strip_tags($_POST["name"]);
            $slug = strip_tags($_POST["slug"]);
            $description = strip_tags($_POST["description"]);
            $features = strip_tags($_POST["features"]);
            $brand_id = strip_tags($_POST["brand_id"]);
            
            $productController = new ProductController();
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
}

?>