<?php

namespace Modules\Auth\Services;

use Exception;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Hash;
use Modules\Auth\Enums\UserStatusEnum;
use Modules\Auth\Models\Admin;
use Modules\Auth\Models\User;
use Modules\Base\Enums\ResponseCode;
use Modules\Base\Exceptions\CustomException;
use Modules\Base\Helpers\WhatsAppHelper;
use Modules\Base\Interface\ImageServiceInterface;

class AuthService
{
    public function __construct(protected ImageServiceInterface $imageInterface, protected WhatsAppHelper $whatsAppHelper) {}

    public function loginUser(string $phone_number, string $password): array
    {
        $user = User::wherePhoneNumber($phone_number)->first();
        if (! $user) {
            throw new Exception('wrong_phone_number');
        }
        if ($user->status == UserStatusEnum::BLOCKED) {
            throw new Exception('user_blocked');
        }
        if ($user->status == UserStatusEnum::UNVARIFIED) {
            throw new Exception('user_unvarified', 455);
        }
        $this->comparePassword($password, $user->password);

        return [
            'user' => [
                'id' => $user->id,
                'first_name' => $user->first_name,
                'last_name' => $user->last_name,
                'phone_number' => $user->phone_number,
            ],
            'token' => $user->createToken(config('auth.user_login_token_name'))->plainTextToken,
        ];
    }

    public function loginAdmin(string $email, string $password): array
    {
        $admin = Admin::whereEmail($email)->first();
        if (! $admin) {
            throw new CustomException('wrong_email', ResponseCode::INVALID_EMAIL->value);
        }
        $this->comparePassword($password, $admin->password);

        return [
            'admin' => [
                'id' => $admin->id,
                'fist_name' => $admin->first_name,
                'last_name' => $admin->last_name,
                'email' => $admin->email,
            ],
            'token' => $admin->createToken(config('auth.admin_login_token_name'))->plainTextToken,
        ];
    }

    public function logout($user): bool
    {
        $user->tokens()->delete();

        return true;
    }

    public function registerUser(array $data): Model
    {
        $data['password'] = Hash::make($data['password']);
        $image = $this->imageInterface->saveImage($data['image']);
        $data['image'] = $image;
        $code = $this->sendCode($data['phone_number']);
        $data['code'] = $code;
        $user = User::create($data);

        return $user;
    }

    public function verifyUser(string $phone_number, string $code)
    {
        $user = User::where('phone_number', $phone_number)
            ->where('code', $code)
            ->first();
        if (! $user) {
            throw new Exception('Invalid Code');
        }

        $user->status = UserStatusEnum::VARIFIED;
        $user->varified_at = now();
        $user->save();

        return [
            'user' => [
                'id' => $user->id,
                'first_name' => $user->first_name,
                'last_name' => $user->last_name,
                'phone_number' => $user->phone_number,
            ],
            'token' => $user->createToken(config('auth.user_login_token_name'))->plainTextToken,
        ];
    }

    public function resendCode($phone_number)
    {

        $user = User::where('phone_number', $phone_number)->first();
        $code = $this->whatsAppHelper->generateWhatsAppCode();
        $this->whatsAppHelper->SendWhatsAppMessage($phone_number, $code);

        $user->code = $code;
        $user->save();

        return $code;

    }

    private function sendCode($phone_number)
    {
        // $code = $this->whatsAppHelper->generateWhatsAppCode();
        // $this->whatsAppHelper->SendWhatsAppMessage($phone_number, $code);

        return '12345';
    }

    private function comparePassword(string $password, string $hash)
    {
        Hash::check($password, $hash) ?: throw new Exception('invalid_credintial');
    }
}
