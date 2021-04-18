<?php

namespace namespace_api_gasto;

const URL = 'https://localhost:44314/api/gastos';
const Apikey = "";

class ApiGasto{


    function getGastos(){
		$parameter = array();
        $result = json_decode($this->httpGet(URL.'/getAll',$parameter),true);
        return $result;
	}

    function getGastoById($id){
		$parameter = array();
        $result = json_decode($this->httpGet(URL.'/getGastoById\/'.$id,$parameter),true);
        return $result;
	}

    function setGasto($datos){
        $result = json_decode($this->httpPost(URL.'/setGasto',$datos),true);
        
        return $result;
    }

    public function httpGet($url, $params)
    {
        $postdata = json_encode($params);

        $ch = curl_init();
               
        $headers = array('Content-Type:application/json');
   
        curl_setopt($ch,CURLOPT_URL,$url);
        curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
        curl_setopt($ch, CURLOPT_HEADER, false);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt( $ch, CURLOPT_CUSTOMREQUEST, 'GET' );
        curl_setopt($ch, CURLOPT_POSTFIELDS, $postdata);

        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);

        $body = curl_exec($ch); 

        curl_close($ch);

        return $body;
    }

    public function httpPost($url,$params)
    {
        $postdata = json_encode($params);
       
        $ch = curl_init();  

        curl_setopt($ch, CURLOPT_URL,$url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $postdata);
                
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
        

        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            'Content-Type: application/json'
        ));
            
    
        $body = curl_exec($ch);

        curl_close($ch);
       
        return $body;
    
    }
}

?>