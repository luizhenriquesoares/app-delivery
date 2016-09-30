<?php

namespace CodeDelivery\Http\Middleware;

use Closure;
use CodeDelivery\Repositories\UserRepository;
use LucaDegasperi\OAuth2Server\Facades\Authorizer;

class OAuthCheckRole
{
    /**
     * @var UserRepository
     */
    private $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next, $role)
    {
        // recupera o id do usuario ativo na sessao
        $id = Authorizer::getResourceOwnerId();

        // retorna a instancia do usuario
        $user  = $this->userRepository->find($id);

        // verifica se o usuario tem perimissao
        if($user->role <> $role) {
            abort(403, 'Access Forbidden');
        }
        return $next($request);
    }
}
