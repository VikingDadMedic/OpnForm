<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Cache;
use App\Models\User;

class SelfHostedCredentialsMiddleware
{
    // Define a list of routes that are allowed without checking the initial setup
    public const ALLOWED_ROUTES = [
        'login',
        'credentials.update',
        'user.current',
        'logout',
    ];

    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // If the application is in the testing environment, allow the request to proceed
        if (app()->environment('testing')) {
            return $next($request);
        }

        // If the request route is in the allowed routes, allow the request to proceed
        if (in_array($request->route()->getName(), self::ALLOWED_ROUTES)) {
            return $next($request);
        }

        // If the application is in self-hosted mode, the user is authenticated, and the initial setup is not complete,
        // return a forbidden response with an error message
        if (
            config('app.self_hosted') &&
            $request->user() &&
            !$this->isInitialSetupComplete()
        ) {
            return response()->json([
                'message' => 'You must change your credentials when in self-hosted mode',
                'type' => 'error',
            ], Response::HTTP_FORBIDDEN);
        }

        // Allow the request to proceed
        return $next($request);
    }

    /**
     * Check if the initial setup is complete.
     *
     * @return bool
     */
    private function isInitialSetupComplete(): bool
    {
        // Check the cache for the 'initial_user_setup_complete' key, or calculate and store it if not present
        return (bool) Cache::remember('initial_user_setup_complete', 60 * 60, function () {
            // Get the maximum user ID
            $maxUserId = $this->getMaxUserId();
            // If no users exist, the initial setup is not complete
            if ($maxUserId === 0) {
                return false;
            }
            // If the default admin user exists, the initial setup is not complete
            return !User::where('email', 'admin@opnform.com')->exists();
        });
    }

    /**
     * Get the maximum user ID.
     *
     * @return int
     */
    private function getMaxUserId(): int
    {
        // Check the cache for the 'max_user_id' key, or calculate and store it if not present
        return (int) Cache::remember('max_user_id', 60 * 60, function () {
            // Get the maximum user ID from the database, or return 0 if no users exist
            return User::max('id') ?? 0;
        });
    }
}
