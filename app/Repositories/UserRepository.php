<?php
namespace App\Repositories;

use App\User;

class UserRepository
{
    /**
     * @param $userData
     * @return static
     */
    public function findByUserNameOrCreate($userData)
    {
        $user = User::where('provider_id', '=', $userData->id)
            ->orWhere('email', '=', $userData->email)
            ->first();
        if (!$user) {
            $user = User::create([
                'provider_id' => $userData->id,
                'first_name' => $userData->user['first_name'],
                'last_name' => $userData->user['last_name'],
                'email' => $userData->email
            ]);
        }
        $this->checkIfUserNeedsUpdating($userData, $user);
        return $user;
    }

    /**
     * @param $userData
     * @param $user
     */
    public function checkIfUserNeedsUpdating($userData, $user)
    {
        $socialData = [
            'email' => $userData->email,
            'first_name' => $userData->user['first_name'],
            'last_name' => $userData->user['last_name'],
            'provider_id' => $userData->id,
        ];
        $dbData = [
            'email' => $user->email,
            'first_name' => $user->first_name,
            'last_name' => $user->last_name,
            'provider_id' => $user->provider_id
        ];
        if (!empty(array_diff($socialData, $dbData))) {
            $user->email = $userData->email;
            $user->first_name = $userData->user['first_name'];
            $user->last_name = $userData->user['last_name'];
            $user->provider_id = $userData->id;
            $user->save();
        }
    }
}