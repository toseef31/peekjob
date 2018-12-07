<?php

namespace App\Services;
use App\SocialFacebookAccount;
use App\User;
use Laravel\Socialite\Contracts\User as ProviderUser;
use App\Facade\JobCallMe;
use DB;

class SocialFacebookAccountService
{
    public function createOrGetUser(ProviderUser $providerUser)
    {
        $account = SocialFacebookAccount::whereProvider('facebook')
            ->whereProviderUserId($providerUser->getId())
            ->first();

        if ($account) {
            return $account->user;
        } else {

            $account = new SocialFacebookAccount([
                'provider_user_id' => $providerUser->getId(),
                'provider' => 'facebook'
            ]);

           // $user = User::whereEmail($providerUser->getEmail())->first();
			$user =DB::table('jcm_users')->whereEmail($providerUser->getEmail())->first();

            if (!$user) {
            $input['companyId'] = '0';
			$input['type'] = 'User';
			$input['secretId'] = JobCallMe::randomString();
			$input['firstName'] = $providerUser->getName();
			$input['lastName'] = $providerUser->getName();
			$input['email'] = $providerUser->getEmail();
			$input['username'] = strtolower($providerUser->getName().$providerUser->getName().rand(00,99));
			$input['password'] = md5(rand(1,10000));
			$input['phoneNumber'] = '';
			$input['country'] = '';
			$input['state'] = '';
			$input['city'] = '';
			$input['profilePhoto'] = $providerUser->getAvatar();
			$input['about'] = '';
			$input['createdTime'] = date('Y-m-d H:i:s');
			$input['modifiedTime'] = date('Y-m-d H:i:s');

			$userId = DB::table('jcm_users')->insertGetId($input);

			extract($providerUser->all());
			$cInput = array('companyName' => $firstName.' '.$lastName, 'companyEmail' => $email, 'companyPhoneNumber' => $phoneNumber, 'companyCountry' => $country, 'companyState' => $state, 'companyCity' => $city, 'category' => '0', 'companyCreatedTime' => date('Y-m-d H:i:s'), 'companyModifiedTime' => date('Y-m-d H:i:s'));
			$companyId = DB::table('jcm_companies')->insertGetId($cInput);

			DB::table('jcm_users')->where('userId','=',$userId)->update(array('companyId' => $companyId));
              

            return $user;
        }
    }
}