<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Auth\AuthenticationException;

class Handler extends ExceptionHandler
{
   
    protected $dontReport = [
        //
    ];

    
    protected $dontFlash = [
        'password',
        'password_confirmation',
    ];

    public function report(Exception $exception)
    {
        parent::report($exception);
    }

    
     
    public function render($request, Exception $exception)
    {
        return parent::render($request, $exception);
    }
    protected function unauthenticated($request, AuthenticationException $exception)
   {
       if($request->expectsJson()) {
           return response()->json(['error' => 'Unauthenticated.'], 401);
       }

       if(in_array('admin', $exception->guards(), true )){
           return redirect()->guest('admin/login');
       }

       return redirect()->guest(route('login'));
    }
}
