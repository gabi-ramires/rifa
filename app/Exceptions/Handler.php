<?php
namespace App\Exceptions;

use Illuminate\Auth\AuthenticationException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use Throwable;

class Handler extends ExceptionHandler
{
    /**
     * Render an exception into an HTTP response.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Throwable  $exception
     * @return \Illuminate\Http\Response
     */
    public function render($request, Throwable $exception)
    {
        if ($exception instanceof ValidationException) {
            $errors = $exception->errors(); // Obtém os erros de validação
            $firstError = reset($errors); // Pega o primeiro erro
            $errorMessage = reset($firstError); // Pega a mensagem de erro

            return response()->json(['message' => $errorMessage], 422); // Código HTTP 422 Unprocessable Entity
        }

        // Para outras exceções, você pode optar por renderizar o erro padrão ou fazer outra lógica
        return parent::render($request, $exception);
    }
}
