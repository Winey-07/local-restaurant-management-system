<?php
namespace App\Http\Controllers;
 
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;
use Laravel\Sanctum\PersonalAccessToken;
use Throwable;
 
class AuthController extends Controller
{
    public function register(Request $request): JsonResponse
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255', 'unique:user_login,email'],
            'password' => ['required', 'confirmed', Password::min(8)],
        ]);
 
        try {
            $result = DB::transaction(function () use ($data) {
                $user = new User();
                $user->name = $data['name'];
                $user->email = $data['email'];
                $user->password = $data['password'];
                $user->role = 'staff';
                $user->save();
 
                return [
                    'user' => $user,
                    'token' => $user->createToken('auth_token')->plainTextToken,
                ];
            });
 
            return response()->json([
                'success' => true,
                'message' => 'Registration successful',
                'data' => [
                    'user' => $this->userData($result['user']),
                    'token' => $result['token'],
                    'token_type' => 'Bearer',
                ],
            ], 201);
        } catch (Throwable $e) {
            return $this->serverErrorResponse($e);
        }
}
 
    public function login(Request $request): JsonResponse
    {
        $data = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required', 'string'],
        ]);
 
        try {
            $user = User::where('email', $data['email'])->first();
            if (!$user || !Hash::check($data['password'], $user->password)) {
                return response()->json([
                    'success' => false,
                    'message' => 'Invalid email or password',
                ], 401);
            }
 
            $token = $user->createToken('auth_token')->plainTextToken;
            return response()->json([
                'success' => true,
                'message' => 'Login successful',
                'data' => [
                    'user' => $this->userData($user),
                    'token' => $token,
                    'token_type' => 'Bearer',
                ],
            ]);
        } catch (Throwable $e) {
            return $this->serverErrorResponse($e);
        }
    }
 
    public function logout(Request $request): JsonResponse
    {
        try {
            $token = $request->user()->currentAccessToken();
            if (!$token instanceof PersonalAccessToken) {
                return response()->json([
                    'success' => false,
                    'message' => 'No personal access token to revoke',
                ], 400);
            }
            $token->delete();
            return response()->json([
                'success' => true,
                'message' => 'Logout successful',
            ]);
        } catch (Throwable $e) {
            return $this->serverErrorResponse($e);
        }
    }
 
    public function me(Request $request): JsonResponse
    {
        return response()->json([
            'success' => true,
            'data' => ['user' => $this->userData($request->user())],
        ]);
    }
 
    private function userData(User $user): array
    {
return [
            'id' => $user->id,
            'name' => $user->name,
            'email' => $user->email,
            'role' => $user->role,
            'email_verified_at' => $user->email_verified_at,
            'created_at' => $user->created_at,
        ];
    }
 
    private function serverErrorResponse(Throwable $e): JsonResponse
    {
        report($e);
        return response()->json([
            'success' => false,
            'message' => $e->getMessage(),
        ], 500);
    }
}
