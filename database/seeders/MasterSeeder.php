<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Role;
use App\Models\User;
use App\Models\Position;
use App\Models\Division;
use App\Models\OrgMember;
use App\Models\WorkProgram;
use App\Models\WorkProgramTeam;
use Illuminate\Support\Facades\Hash;

class MasterSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Roles
        $adminRole = Role::create(['name' => 'admin', 'display_name' => 'Administrator']);
        Role::create(['name' => 'user', 'display_name' => 'User']);

        // 2. Admin User
        User::create([
            'name' => 'Admin HMIF',
            'email' => 'admin@hmif.com',
            'password' => Hash::make('password'),
            'role' => 'admin',
        ]);

        // 3. Positions
        $posKetua = Position::create(['name' => 'Ketua Himpunan', 'type' => 'inti', 'order' => 1]);
        $posWakil = Position::create(['name' => 'Wakil Ketua Himpunan', 'type' => 'inti', 'order' => 2]);
        $posSekre = Position::create(['name' => 'Sekretaris Umum', 'type' => 'inti', 'order' => 3]);
        $posBenda = Position::create(['name' => 'Bendahara Umum', 'type' => 'inti', 'order' => 4]);
        $posKoor = Position::create(['name' => 'Koordinator', 'type' => 'divisi', 'order' => 5]);
        $posAnggota = Position::create(['name' => 'Anggota', 'type' => 'divisi', 'order' => 6]);

        // 4. Divisions
        $divHumas = Division::create(['name' => 'Humas', 'description' => 'Hubungan Masyarakat', 'color' => 'bg-pink-500', 'order' => 1]);
        $divPsdm = Division::create(['name' => 'PSDM', 'description' => 'Pengembangan Sumber Daya Mahasiswa', 'color' => 'bg-blue-500', 'order' => 2]);
        $divMedinfo = Division::create(['name' => 'Media Digital', 'description' => 'Media dan Informasi', 'color' => 'bg-purple-500', 'order' => 3]);

        // 5. Members
        $memberAbiyyu = OrgMember::create([
            'name' => 'R. Abiyyu Ardi Lian Permadi',
            'npm' => '06.2021.1.074XX',
            'position_id' => $posKetua->id,
            'order' => 1
        ]);

        $memberMaulana = OrgMember::create([
            'name' => 'Ahmad Maulana Ismaindra',
            'npm' => '06.2021.1.074XY',
            'position_id' => $posAnggota->id,
            'division_id' => $divMedinfo->id,
            'order' => 10
        ]);

        $memberTarishah = OrgMember::create([
            'name' => 'Tarishah Aridhah Zhafirah',
            'npm' => '06.2021.1.074XZ',
            'position_id' => $posKoor->id,
            'division_id' => $divMedinfo->id,
            'order' => 9
        ]);

        // 6. Work Program
        $progPromosi = WorkProgram::create([
            'name' => 'Promosi Himpunan Mahasiswa Teknik Informatika 2025',
            'division_id' => $divHumas->id,
            'description' => 'Kegiatan ini bertujuan memperkenalkan HMIF ITATS kepada mahasiswa baru Teknik Informatika ITATS, meliputi pengenalan program kerja, struktur organisasi, dan manfaat bergabung di himpunan.',
            'status' => 'selesai',
            'start_date' => '2025-10-01',
            'end_date' => '2025-10-01',
            'location' => 'Graha ITATS',
            'head_id' => $memberAbiyyu->id,
            'participants_count' => 99,
            'budget' => '-',
            'team_count' => 3
        ]);

        // 7. Program Team
        WorkProgramTeam::create([
            'work_program_id' => $progPromosi->id,
            'member_id' => $memberMaulana->id,
            'role' => 'Dokumentasi'
        ]);

        WorkProgramTeam::create([
            'work_program_id' => $progPromosi->id,
            'member_id' => $memberTarishah->id,
            'role' => 'Publikasi'
        ]);

        // 8. More Programs
        WorkProgram::create([
            'name' => 'Open Recruitment Mahasiswa Informatika',
            'division_id' => $divPsdm->id,
            'description' => 'Penerimaan anggota baru HMIF ITATS untuk generasi selanjutnya. Mencari bakat-bakat baru yang siap berkontribusi.',
            'status' => 'mendatang',
            'start_date' => '2026-06-30',
            'end_date' => '2026-07-05',
            'location' => 'Gedung A 301',
            'head_id' => $memberAbiyyu->id,
            'participants_count' => 0,
            'budget' => 'Rp 500.000',
            'team_count' => 15
        ]);

        WorkProgram::create([
            'name' => 'Pelatihan Manajemen dan Organisasi (PMO)',
            'division_id' => $divPsdm->id,
            'description' => 'Memberikan bekal kepemimpinan dan manajemen organisasi bagi calon pengurus baru.',
            'status' => 'mendatang',
            'start_date' => '2026-10-31',
            'end_date' => '2026-11-01',
            'location' => 'Auditorium ITATS',
            'head_id' => $memberTarishah->id,
            'participants_count' => 0,
            'budget' => 'Rp 1.500.000',
            'team_count' => 20
        ]);
    }
}
