<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\InformationPermit;
use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Permission;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        Permission::create(['name' => 'get-role']);
        Permission::create(['name' => 'create-role']);
        Permission::create(['name' => 'update-role']);
        Permission::create(['name' => 'delete-role']);

        Permission::create(['name' => 'get-permission']);
        Permission::create(['name' => 'create-permission']);
        Permission::create(['name' => 'update-permission']);
        Permission::create(['name' => 'delete-permission']);

        Permission::create(['name' => 'get-user']);
        Permission::create(['name' => 'create-user']);
        Permission::create(['name' => 'update-user']);
        Permission::create(['name' => 'delete-user']);

        Permission::create(['name' => 'get-classroom']);
        Permission::create(['name' => 'create-classroom']);
        Permission::create(['name' => 'update-classroom']);
        Permission::create(['name' => 'delete-classroom']);

        Permission::create(['name' => 'get-presence']);
        Permission::create(['name' => 'create-presence']);
        Permission::create(['name' => 'update-presence']);
        Permission::create(['name' => 'delete-presence']);

        Permission::create(['name' => 'get-permit']);
        Permission::create(['name' => 'create-permit']);
        Permission::create(['name' => 'update-permit']);
        Permission::create(['name' => 'delete-permit']);

        Permission::create(['name' => 'get-information-permit']);
        Permission::create(['name' => 'create-information-permit']);
        Permission::create(['name' => 'update-information-permit']);
        Permission::create(['name' => 'delete-information-permit']);

        Permission::create(['name' => 'get-status-permit']);
        Permission::create(['name' => 'create-status-permit']);
        Permission::create(['name' => 'update-status-permit']);
        Permission::create(['name' => 'delete-status-permit']);

        Permission::create(['name' => 'get-task']);
        Permission::create(['name' => 'create-task']);
        Permission::create(['name' => 'update-task']);
        Permission::create(['name' => 'delete-task']);

        Permission::create(['name' => 'approve-permit']);

        Role::create(['name' => 'Super Admin']);
        Role::create(['name' => 'Admin']);
        Role::create(['name' => 'Waka Kurikulum']);
        Role::create(['name' => 'Waka Admin']);
        Role::create(['name' => 'Guru Full Time']);
        Role::create(['name' => 'Guru Part Time']);
        Role::create(['name' => 'TPA Full Time']);
        Role::create(['name' => 'TPA Part Time']);

        $sa = Role::findByName('Super Admin');
        $sa->givePermissionTo('get-role');
        $sa->givePermissionTo('create-role');
        $sa->givePermissionTo('update-role');
        $sa->givePermissionTo('delete-role');
        $sa->givePermissionTo('get-permission');
        $sa->givePermissionTo('create-permission');
        $sa->givePermissionTo('update-permission');
        $sa->givePermissionTo('delete-permission');
        $sa->givePermissionTo('get-user');
        $sa->givePermissionTo('create-user');
        $sa->givePermissionTo('update-user');
        $sa->givePermissionTo('delete-user');
        $sa->givePermissionTo('get-classroom');
        $sa->givePermissionTo('create-classroom');
        $sa->givePermissionTo('update-classroom');
        $sa->givePermissionTo('delete-classroom');
        $sa->givePermissionTo('create-status-permit');
        $sa->givePermissionTo('update-status-permit');
        $sa->givePermissionTo('delete-status-permit');
        $sa->givePermissionTo('get-information-permit');
        $sa->givePermissionTo('create-information-permit');
        $sa->givePermissionTo('update-information-permit');
        $sa->givePermissionTo('delete-information-permit');

        $admin = Role::findByName('Admin');
        $admin->givePermissionTo('get-presence');
        $admin->givePermissionTo('create-presence');
        $admin->givePermissionTo('update-presence');
        $admin->givePermissionTo('delete-presence');
        $admin->givePermissionTo('get-permit');

        $waka_kurikulum = Role::findByName('Waka Kurikulum');
        $waka_kurikulum->givePermissionTo('get-permit'); //perizinannya menampilkan data dari guru saja
        $waka_kurikulum->givePermissionTo('approve-permit');

        
        $waka_admin = Role::findByName('Waka admin');
        $waka_admin->givePermissionTo('get-permit'); //perizinannya menampilkan data dari TPA saja ntah itu TPA full dan TPA part
        $waka_admin->givePermissionTo('approve-permit');



        $gurufull = Role::findByName('Guru Full Time');
        $gurufull->givePermissionTo('get-permit');
        $gurufull->givePermissionTo('create-permit');
        $gurufull->givePermissionTo('update-permit');
        $gurufull->givePermissionTo('delete-permit');
        $gurufull->givePermissionTo('get-task');
        $gurufull->givePermissionTo('create-task');
        $gurufull->givePermissionTo('update-task');
        $gurufull->givePermissionTo('delete-task');

        

        $gurupart = Role::findByName('Guru Part Time');
        $gurupart->givePermissionTo('get-permit');
        $gurupart->givePermissionTo('create-permit');
        $gurupart->givePermissionTo('update-permit');
        $gurupart->givePermissionTo('delete-permit');
        $gurupart->givePermissionTo('get-task');
        $gurupart->givePermissionTo('create-task');
        $gurupart->givePermissionTo('update-task');
        $gurupart->givePermissionTo('delete-task');

        $tpa = Role::findByName('TPA Full Time');
        $tpa->givePermissionTo('get-permit');
        $tpa->givePermissionTo('create-permit');
        $tpa->givePermissionTo('update-permit');
        $tpa->givePermissionTo('delete-permit');

        $tpa = Role::findByName('TPA Part Time');
        $tpa->givePermissionTo('get-permit');
        $tpa->givePermissionTo('create-permit');
        $tpa->givePermissionTo('update-permit');
        $tpa->givePermissionTo('delete-permit');

        InformationPermit::create([
            'name' => 'Izin'
        ]);
        InformationPermit::create([
            'name' => 'Sakit'
        ]);
        InformationPermit::create([
            'name' => 'Cuti'
        ]);
        InformationPermit::create([
            'name' => 'Dinas'
        ]);

        $superadmin = User::create([
            'no_id' => 00000,
            'name' => 'Sigit Super Admin',
            'username' => '00000',
            'employment_status' => 'Super Admin',
            'status' => 'Tetap',
            'password' => Hash::make('password')
        ]);

        $superadmin->assignRole('Super Admin');

        $user = User::create([
            'no_id' => 11111,
            'name' => 'Admin',
            'username' => '11111',
            'employment_status' => 'Admin',
            'status' => 'Tetap',
            'password' => Hash::make('password')
        ]);

        $user->assignRole('Admin');

        $user = User::create([
            'no_id' => 1,
            'name' => 'KRISNHA PRASETYO',
            'username' => '00770047',
            'phone' => '082213314889',
            'address' => 'Perum kodam blok C6/10 Mustika Jaya Bekasi Timur Jawa Barat',
            'employment_status' => 'Kepala Sekolah',
            'status' => 'Tetap',
            'password' => Hash::make('password')
        ]);

        $user->assignRole('Waka kurikulum');
        
        $user = User::create([
            'no_id' => 2,
            'name' => 'MUBAROK',
            'username' => '23456879',
            'phone' => '081347865789',
            'address' => 'Jln F raya no 339',
            'employment_status' => 'Waka kurikulum',
            'status' => 'Tetap',
            'password' => Hash::make('password')
        ]);
        
        $user->assignRole('Waka Admin');
        $user = User::create([
            'no_id' => 3,
            'name' => 'Saya',
            'username' => '23648463',
            'phone' => '081347865789',
            'address' => 'Jln F raya no 339',
            'employment_status' => 'Waka Admin',
            'status' => 'Tetap',
            'password' => Hash::make('password')
        ]);

        $user->assignRole('TPA Full Time');

        $user = User::create([
            'no_id' => 4,
            'name' => 'KISMANTO',
            'username' => '16880100',
            'phone' => '085714999524',
            'address' => 'Jl. Peta Utara 1 No. 179 Rt 001 Rw 007, Pegadungan, Kalideres, Jakarta Barat',
            'employment_status' => 'Guru',
            'status' => 'Full Time',
            'password' => Hash::make('password')
        ]);

        $user->assignRole('Guru Full Time');

        $user = User::create([
            'no_id' => 5,
            'name' => 'DIAN MUSTIKA MAHARANI',
            'username' => '17850110',
            'phone' => '081288464512',
            'address' => 'Jl. Daan Mogot Kembangan Jakarta Barat',
            'employment_status' => 'TPA',
            'status' => 'Tetap',
            'password' => Hash::make('password')
        ]);

        $user->assignRole('TPA Full Time');

        $user = User::create([
            'no_id' => 6,
            'name' => 'WINDRI SETIAWATI',
            'username' => '05840030',
            'phone' => '081316910827',
            'address' => 'Jl. Tawangmangu RT/RW/ 12/03 Blok E 4 Kedaung Kali Angke Cengkareng Jakarta Barat',
            'employment_status' => 'TPA',
            'status' => 'Tetap',
            'password' => Hash::make('password')
        ]);

        $user->assignRole('TPA Full Time');

        $user = User::create([
            'no_id' => 7,
            'name' => 'LILI HERAWATI',
            'username' => '14750019',
            'phone' => '081296969351',
            'address' => 'Jl. Batu Raya No. 16 Rt.014 Rw. 007 Kel. Menteng Atas Kec. Setiabudi, Jakarta Selatan DKI Jakarta',
            'employment_status' => 'TPA',
            'status' => 'Full Time',
            'password' => Hash::make('password')
        ]);

        $user->assignRole('TPA Full Time');

        $user = User::create([
            'no_id' => 8,
            'name' => 'TATANG SUTARTO',
            'username' => '96710006',
            'phone' => '082122828264',
            'address' => 'Jl. Daan Mogot Km 11 Cengkareng Kedaung Kaliangke Jakarta Barat',
            'employment_status' => 'TPA',
            'status' => 'Tetap',
            'password' => Hash::make('password')
        ]);

        $user->assignRole('TPA Full Time');

        $user = User::create([
            'no_id' => 9,
            'name' => 'ADITYA WARDANA',
            'username' => '15920044',
            'phone' => '081903259535',
            'address' => 'Jl. Sirayu No.64 Pakunden Banyumas',
            'employment_status' => 'GURU',
            'status' => 'Full Time',
            'password' => Hash::make('password')
        ]);

        $user->assignRole('Guru Full Time');

        $user = User::create([
            'no_id' => 10,
            'name' => 'AULIA FAJAR ALAMSAH',
            'username' => '19930028',
            'phone' => '08993831608',
            'address' => 'Medang Lestari Jl. Asri Lestari 3 Blok A3 Rt.004 Rw.013 Kel. Medang Kec. Pagedangan Kab. Tangerang',
            'employment_status' => 'GURU',
            'status' => 'Tetap',
            'password' => Hash::make('password')
        ]);

        

        $user->assignRole('Guru Full Time');
    }
}
