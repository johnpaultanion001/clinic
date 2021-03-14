<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        $this->call([
            PermissionsTableSeeder::class,
            RolesTableSeeder::class,
            PermissionRoleTableSeeder::class,
            UsersTableSeeder::class,
            RoleUserTableSeeder::class,
            PurposeSeeder::class,
            AnnouncementSeeder::class,
            AboutUsSeeder::class,
            ContactSeeder::class,
            HolidaySeeder::class,
            ScheduleSeeder::class,
            FullDateSeeder::class,
            FeedbackSeeder::class,
        ]);
    }
}
