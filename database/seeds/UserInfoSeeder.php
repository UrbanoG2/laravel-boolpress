<?php
use App\User;
use App\Model\UserInfo;
use Illuminate\Database\Seeder;
use Faker\Generator as Faker;

class UserInfoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker) //faccio un foreach perchè mi rifaccio al numero degli users, per ogni user faccio un ciclo
    {
        $users = User::all();

        foreach ($users as $user) {
            $newUserInfo = new UserInfo();
            $newUserInfo->phone = $faker->phoneNumber();
            $newUserInfo->address = $faker->address();
            $newUserInfo->user_id = $user->id;//dato non fake, dico che nella colonna user_id della tabella UserInfos, devi inserire l'id dello user

            $newUserInfo->save();
        }
    }
}
