<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;
use App\Models\User;
use App\Models\UserInvite;
use App\Models\Workspace;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class RegisterController extends Controller
{
    use RegistersUsers;

    private ?bool $appsumoLicense = null;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // Apply the 'guest' middleware to ensure only unauthenticated users can access the registration functionality
        $this->middleware('guest');
    }

    /**
     * The user has been registered.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\JsonResponse
     */
    protected function registered(Request $request, User $user)
    {
        // If the user must verify their email, return a JSON response indicating that the verification email has been sent
        if ($user instanceof MustVerifyEmail) {
            return response()->json(['status' => trans('verification.sent')]);
        }

        // Otherwise, return a JSON response with the user data and the AppSumo license status
        return response()->json(array_merge(
            (new UserResource($user))->toArray($request),
            [
                'appsumo_license' => $this->appsumoLicense,
            ]
        ));
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        // Define validation rules for the registration data
        return Validator::make($data, [
            'name' => 'required|max:255',
            'email' => 'required|email:filter|max:255|unique:users|indisposable',
            'password' => 'required|min:6|confirmed',
            'hear_about_us' => 'required|string',
            'agree_terms' => ['required', Rule::in([true])],
            'appsumo_license' => ['nullable'],
            'invite_token' => ['nullable', 'string'],
        ], [
            'agree_terms' => 'Please agree with the terms and conditions.',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     */
    protected function create(array $data)
    {
        // Get the workspace and role for the new user
        [$workspace, $role] = $this->getWorkspaceAndRole($data);

        // Create a new user with the provided data
        $user = User::create([
            'name' => $data['name'],
            'email' => strtolower($data['email']),
            'password' => bcrypt($data['password']),
            'hear_about_us' => $data['hear_about_us'],
        ]);

        // Associate the user with the workspace and role
        $user->workspaces()->sync([
            $workspace->id => [
                'role' => $role,
            ],
        ], false);

        // Register the user with an AppSumo license if provided
        $this->appsumoLicense = AppSumoAuthController::registerWithLicense($user, $data['appsumo_license'] ?? null);

        return $user;
    }

    private function getWorkspaceAndRole(array $data)
    {
        // If no invite token is provided, create a new workspace and assign the user as an admin
        if (!array_key_exists('invite_token', $data)) {
            return [
                Workspace::create([
                    'name' => 'My Workspace',
                    'icon' => '🧪',
                ]),
                User::ROLE_ADMIN
            ];
        }

        // Find the user invite based on the provided email and invite token
        $userInvite = UserInvite::where('email', $data['email'])
            ->where('token', $data['invite_token'])
            ->first();

        // If the invite token is invalid, expired, or already accepted, return an error response
        if (!$userInvite) {
            response()->json(['message' => 'Invite token is invalid.'], 400)->throwResponse();
        }
        if ($userInvite->hasExpired()) {
            response()->json(['message' => 'Invite token has expired.'], 400)->throwResponse();
        }

        if ($userInvite->status == UserInvite::ACCEPTED_STATUS) {
            response()->json(['message' => 'Invite is already accepted.'], 400)->throwResponse();
        }

        // Mark the invite as accepted and return the associated workspace and role
        $userInvite->markAsAccepted();
        return [
            $userInvite->workspace,
            $userInvite->role,
        ];
    }
}
