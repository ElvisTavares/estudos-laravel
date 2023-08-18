<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Cache\RateLimiter;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class RateLimitMiddleware
{
    protected $limiter;

    public function __construct(RateLimiter $limiter)
    {
        $this->limiter = $limiter;
    }
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
       $key = $this->resolveRequestSignature($request);
       $maxAttempts = 2;      // Número máximo de tentativas
       $decayMinutes = 1;     // Tempo de redefinição em minutos

        if ($this->tooManyAttempts($key, $maxAttempts, $decayMinutes)) {
            return response('Limite de taxa excedido. Tente novamente mais tarde.', 429);
        }

        $this->limiter->hit($key, $decayMinutes);


        return $next($request);
    }

    protected function tooManyAttempts($key, $maxAttempts, $decayMinutes)
    {
        return Cache::has($key.':lockout');
    }
    
    public function resolveRequestSignature($request){
        return sha1(
            $request->method() .  '|' .$request->path() . '|' . $request->ip()
        );
    }

    protected function hit($key, $decayMinutes)
    {
        Cache::put($key. ':lockout', time() + $decayMinutes * 60, $decayMinutes);
    }
}
