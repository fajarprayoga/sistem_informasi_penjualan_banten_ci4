<?php namespace App\Filters;
 
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\Filters\FilterInterface;
use App\Models\Auth_model;
class MarketLoginFilter implements FilterInterface
{
    public function before(RequestInterface $request)
    {
        if (!session()->get('login')) // saya hanya membuat sederhana saja. silahkan kembangkan di kemudian hari
        {
            return redirect()->to('/auth/login');
        }
        // Do something here
    }
 
    //--------------------------------------------------------------------
 
    public function after(RequestInterface $request, ResponseInterface $response)
    {
        // Do something here
    }
}