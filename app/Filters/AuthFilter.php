<?php namespace App\Filters;
 
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\Filters\FilterInterface;
use App\Models\Auth_model;
class AuthFilter implements FilterInterface
{
    public function before(RequestInterface $request)
    {
        if (session()->get('login')) // saya hanya membuat sederhana saja. silahkan kembangkan di kemudian hari
        {
            if(session()->get('level') =='Admin'){
                return redirect()->to('/admin/dashboard');
            }else{
                return redirect()->to('/');
            }
        }
        // Do something here
    }
 
    //--------------------------------------------------------------------
 
    public function after(RequestInterface $request, ResponseInterface $response)
    {
        // Do something here
    }
}