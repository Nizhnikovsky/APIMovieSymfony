<?php

namespace APIMovieBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use GuzzleHttp\Psr7\Request;
use GuzzleHttp\Client;
use GuzzleHttp\Psr7\Response;
use Psr\Http\Message\RequestInterface;


class ApiMovieController extends Controller
{
    
    
    protected function sendRequest($title)
    {
       
        $client = new Client(['base_uri' =>"http://www.omdbapi.com"]);
        $request = new Request('GET', '/?t='.$title.'&apikey=bb92fae0');
        $response = $client->send($request, ['timeout' => 2]);
        if ($response->getStatusCode() === 200)
        {
            $body = $response->getBody();
        
            if ($body->read(5) == '<?xml')
            {
                echo 'Файл размечен как xml';
            }
            $body->seek(0); // вернет указатель в начало
            $content = $body->getContents();
           
            if (!empty($content))
            {
                return $content; // выведет результат запроса в строку
            }
        }
        return 0;
    }
    
    protected function parseBody($content)
    {
        //$content = $request->getContent();
        
        return json_decode($content, true);
    }



}
