<?php
declare(strict_types=1);

namespace app\middleware;

class ArtistMiddleware
{
    public function handle($request, $next)
    {
        // Get the user's role. Replace this with your actual logic
        $userRole = $_SESSION['user_role'] ?? null;

        if ($userRole !== 'artist') {
            // If the user is not an artist, return a response and stop processing the request
            http_response_code(403);
            echo json_encode(['error' => 'Forbidden']);
        }

        // Call the next middleware or the route handler
        return $next($request);
    }
}
