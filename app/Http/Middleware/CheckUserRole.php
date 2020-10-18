<?php

namespace App\Http\Middleware;

use Closure;
use App\User;
use App\Role\RoleChecker;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Support\Facades\Auth;

/**
 * Class CheckUserRole
 * @package App\Http\Middleware
 */
class CheckUserRole
{
    /**
     * @var roleChecker
     */
    protected $roleChecker;

    /**
     * Constructs a CheckUserRole instance.
     *
     * @var roleChecker
     * @return this
     */
    public function __construct(RoleChecker $roleChecker)
    {
        $this->roleChecker = $roleChecker;
    }

    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure $next
     * @param string $role
     *
     * @return mixed
     * @throws AuthorizationException
     */
    public function handle(Request $request, Closure $next, $role)
    {
        /** @var User $user: authorized user */
        $user = Auth::guard()->user();

        // Check if current user is not part of a given set of roles
        if(!$this->roleChecker->check($user, $role))
        {
            throw new AuthorizationException('You do not have permission to view this page.');
        }

        return $next($request);
    }

}