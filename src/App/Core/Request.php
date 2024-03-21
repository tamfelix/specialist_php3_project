<?php
namespace App\Core;

use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Message\StreamInterface;
use Psr\Http\Message\UriInterface;

class Request implements ServerRequestInterface {

    private $get;
    private $post;
    private $cookie;
    private $files;
    private $server;
    private $header;

    //создаем конструктор для сохранения переменных
    public function __construct(array $get, array $post, array $cookie, array $files, array $server, array $header ){
        $this->get = $_GET;
        $this->post = $_POST;
        $this->files = $_FILES;
        $this->cookie = $_COOKIE;
        $this->server = $_SERVER;
        $formattedHeader = [];
        foreach ($header as $key => $value){
            $formattedHeader[strtolower($key)] = $value;
        }
        $this->header = $formattedHeader;
    }

    public function getUri()
    {
        // TODO: Implement getUri() method.
    }

    public function getAttributes()
    {
        // TODO: Implement getAttributes() method.

    }

    public function getQueryParams()
    {
        // TODO: Implement getQueryParams() method.
        return $this->get;
    }

    public function getServerParams(){
        return $this->server;
    }

//    public function getSessionParams(){
//        return $this->session;
//    }
    public function getPostParams(){
        return $this->post;
    }

    public function getCookieParams(){
        return $this->cookie;
    }

    public function getUploadedFiles()
    {
        // TODO: Implement getUploadedFiles() method.
        return $this->files;
    }


    //метод должен быть не регистрозависимым
    public function getHeaderLine($name)
    {
        // TODO: Implement getHeaderLine() method.
        return $this->header[strtolower($name)] ?? null;
    }


    public function getHeaders()
    {
        // TODO: Implement getHeaders() method.
        return $this->header;
    }

    //возвращяем тело запроса http
    public function getBody()
    {
        // TODO: Implement getBody() method.

     }

    public function getParsedBody()
    {
        // TODO: Implement getParsedBody() method.
        $input =  file_get_contents('php://input');
        $contentType = $this->getHeader('Content-Type');


        if($contentType == 'text/xml'){
            return 'xml';
            //return $input;
        }elseif ($contentType == 'application/json'){

            return json_decode($input, true);
        }

        if(
            $this->server['REQUEST_METHOD'] == 'POST'
            && !empty($this->post)
        ) {
            return $this->post;
        }
        //        //вернуть поток входа
        //        //return file_get_contents('php://input');
        //       else{return file_get_contents('php://input');}
    }

    public function getMethod()
    {
        // TODO: Implement getMethod() method.
    }


    public function getRequestTarget()
    {
        // TODO: Implement getRequestTarget() method.
    }



    public function getAttribute($name, $default = null)
    {
        // TODO: Implement getAttribute() method.
    }


    public function getProtocolVersion()
    {
        // TODO: Implement getProtocolVersion() method.
    }

    public function withProtocolVersion($version)
    {
        // TODO: Implement withProtocolVersion() method.
    }

    public function hasHeader($name)
    {
        // TODO: Implement hasHeader() method.
    }


    public function withHeader($name, $value)
    {
        // TODO: Implement withHeader() method.
    }

    public function withAddedHeader($name, $value)
    {
        // TODO: Implement withAddedHeader() method.
    }

    public function withoutHeader($name)
    {
        // TODO: Implement withoutHeader() method.
    }


    public function withBody(StreamInterface $body)
    {
        // TODO: Implement withBody() method.
    }


    public function getHeader($name)
    {
        // TODO: Implement getHeader() method.
    }


    public function withAttribute($name, $value)
    {
        // TODO: Implement withAttribute() method.
    }

    public function withoutAttribute($name)
    {
        // TODO: Implement withoutAttribute() method.
    }



    public function withMethod($method)
    {
        // TODO: Implement withMethod() method.
    }



    public function withUri(UriInterface $uri, $preserveHost = false)
    {
        // TODO: Implement withUri() method.
    }

    public function withCookieParams(array $cookies)
    {
        // TODO: Implement withCookieParams() method.
    }

    public function withQueryParams(array $query)
    {
        // TODO: Implement withQueryParams() method.
    }



    public function withUploadedFiles(array $uploadedFiles)
    {
        // TODO: Implement withUploadedFiles() method.
    }

    public function withParsedBody($data)
    {
        // TODO: Implement withParsedBody() method.
    }

    public function withRequestTarget($requestTarget)
    {
        // TODO: Implement withRequestTarget() method.
    }



}