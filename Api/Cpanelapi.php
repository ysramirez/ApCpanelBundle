<?php

namespace Ap\CpanelBundle\Api;

class Cpanelapi{

    private $domain;
    private $whmusername;
    private $whmhash;
    private $curl;
    private $header;
    private $host;
    private $apitype;

    private $hostapitype;

    private $localquery;

    private $query;

    public function __construct($domain, $whmusername, $whmhash, $apitype = "json-api"){

        $this->domain      = $domain;
        $this->whmusername = $whmusername;
        $this->whmhash     = $whmhash;
        $this->host        = "https://".$this->domain.":2087/";

        $this->localquery  = "";

        if((strcmp($apitype, "json-api") && strcmp($apitype, "xml-api")) == 0){
            $this->apitype = $apitype;  
        }else{
            throw new Exception("apitype must be json-api or xml-api", 1);
        }


        $this->hostapitype = $this->host.$this->apitype."/";


        $this->curl = curl_init(); //Create Curl Object

        // Allow certs that do not match the domain
        curl_setopt($this->curl, CURLOPT_SSL_VERIFYHOST,0);

        // Allow self-signed certs
        curl_setopt($this->curl, CURLOPT_SSL_VERIFYPEER,0);

        // Return contents of transfer on curl_exec
        curl_setopt($this->curl, CURLOPT_RETURNTRANSFER,1);

        // Remove newlines from the hash
        $this->header[0] = "Authorization: WHM ".$this->whmusername.":" . preg_replace("'(\r|\n)'","",$this->whmhash);

        // Set curl header
        curl_setopt($this->curl,CURLOPT_HTTPHEADER,$this->header);

    }

    public function getQuery(){
      return $this->query;
    }

    public function setQuery($action, array $options = NULL){
      if(isset($options)){
        $this->query  = $this->hostapitype.$action."?".http_build_query($options);  
      }else{
        $this->query  = $this->hostapitype.$action;
      }
      
      return $this;
    }

    public function exec(){

        // Set your URL
        curl_setopt($this->curl, CURLOPT_URL, $this->query);

        // Execute Query, assign to $result
        $this->result = curl_exec($this->curl);

        if ($this->result == false) {
        error_log("curl_exec threw error \"" . curl_error($this->curl) . "\" for".$this->query);
        }

        return $this->result;
    }

    public function close(){
       curl_close($this->curl);
    }

// 
// 
// Implementation
// 
// 


    /**
     * List Packages (listpkgs) 
     * This API function lets you view all hosting packages available to the user. 
     * @return Cpanelapi
     */
    public function listpkgs(){
        $this->setQuery("listpkgs");
        return $this;
    }

    /**
     * List Accounts — listaccts
     * This function lists all accounts on the server, 
     * and also allows you to search for a specific account or set of accounts. 
     * @return [type] [description]
     */
    public function listaccts($searchtype = NULL, $search = NULL){

        $options['searchtype'] = $searchtype;
        $options['search']     = $search;
        $this->setQuery("listaccts", $options);
        
        return $this;
    }

    
}







