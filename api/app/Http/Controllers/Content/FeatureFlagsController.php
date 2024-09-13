<?php

namespace App\Http\Controllers\Content;

use App\Http\Controllers\Controller;

class FeatureFlagsController extends Controller
{
    public function index()
    {
        // Retrieve the feature flags from the cache, or store them in the cache if they don't exist
        $featureFlags = \Cache::remember('feature_flags', 3600, function () {
            // Return an array of feature flags and their statuses
            return [
                // Check if the application is in self-hosted mode
                'self_hosted' => config('app.self_hosted', true),
                // Check if custom domains are enabled
                'custom_domains' => config('custom-domains.enabled', false),
                // Check if AI features are enabled by verifying the presence of an OpenAI API key
                'ai_features' => !empty(config('services.openai.api_key')),

                // Billing-related feature flags
                'billing' => [
                    // Check if billing is enabled by verifying the presence of Cashier keys
                    'enabled' => !empty(config('cashier.key')) && !empty(config('cashier.secret')),
                    // Check if AppSumo integration is enabled by verifying the presence of AppSumo API keys
                    'appsumo' => !empty(config('services.appsumo.api_key')) && !empty(config('services.appsumo.api_secret')),
                ],
                // Storage-related feature flags
                'storage' => [
                    // Check if the default filesystem is local
                    'local' => config('filesystems.default') === 'local',
                    // Check if the default filesystem is S3
                    's3' => config('filesystems.default') !== 'local',
                ],
                // Service-related feature flags
                'services' => [
                    // Check if Unsplash integration is enabled by verifying the presence of an Unsplash access key
                    'unsplash' => !empty(config('services.unsplash.access_key')),
                    // Google-related feature flags
                    'google' => [
                        // Check if Google Fonts integration is enabled by verifying the presence of a Google Fonts API key
                        'fonts' => !empty(config('services.google.fonts_api_key')),
                        // Check if Google authentication is enabled by verifying the presence of Google client ID and secret
                        'auth' => !empty(config('services.google.client_id')) && !empty(config('services.google.client_secret')),
                    ],
                ],
                // Integration-related feature flags
                'integrations' => [
                    // Check if Zapier integration is enabled
                    'zapier' => config('services.zapier.enabled'),
                    // Check if Google Sheets integration is enabled by verifying the presence of Google client ID and secret
                    'google_sheets' => !empty(config('services.google.client_id')) && !empty(config('services.google.client_secret')),
                ],
            ];
        });

        // Return the feature flags as a JSON response
        return response()->json($featureFlags);
    }
}
