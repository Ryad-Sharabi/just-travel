@if(config('services.clarity.enabled', true) && config('services.clarity.project_id'))
{{-- Clarity is loaded conditionally by cookie-consent.blade.php after user accepts cookies --}}
@else
{{-- Clarity is disabled or project ID is not configured. Set CLARITY_PROJECT_ID in your .env file to enable. --}}
@endif