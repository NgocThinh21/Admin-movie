<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UsersTableSeeder::class);
       $this->call(theloaiSeeder::class);
      $this->call(daodienSeeder::class);
       $this->call(dienvienSeeder::class);
      $this->call(nsxSeeder::class);
       $this->call(quocgiaSeeder::class);

     //  $this->call(phimSeeder::class);
    }
}
     //the loai
    class theloaiSeeder extends Seeder{
        public function run(){
            DB::table('theloais')->insert([
                ['tentheloai'=>'Khoa Học'],
                ['tentheloai'=>'Viễn Tưởng'],
                ['tentheloai'=>'Kinh Dị'],
                ['tentheloai'=>'Hoạt Hình'],
                ['tentheloai'=>'Hài Hước'],
                ['tentheloai'=>'Tình Cảm'],
            ]);
        }
    }

   

    //dao dien

    class daodienSeeder extends Seeder{
        public function run(){
            DB::table('daodiens')->insert([
                ['tendaodien'=>'Đạo Diễn 1'],
                ['tendaodien'=>'Đạo Diễn 2'],
                ['tendaodien'=>'Đạo Diễn 3'],
                ['tendaodien'=>'Đạo Diễn 4'],
                ['tendaodien'=>'Đạo Diễn 5'],
                ['tendaodien'=>'Đạo Diễn 6'],
            ]);
        }
    }
    //dien vien

    class dienvienSeeder extends Seeder{
        public function run(){
            DB::table('dienviens')->insert([
                ['tendienvien'=>'Diễn Viên 1'],
                ['tendienvien'=>'Diễn Viên 2'],
                ['tendienvien'=>'Diễn Viên 3'],
                ['tendienvien'=>'Diễn Viên 4'],
                ['tendienvien'=>'Diễn Viên 5'],
                ['tendienvien'=>'Diễn Viên 6'],
            ]);
        }
    }

    // nha san xuat

    class nsxSeeder extends Seeder{
        public function run(){
            DB::table('nsxes')->insert([
                ['tennsx'=>'NSX 1'],
                ['tennsx'=>'NSX 2'],
                ['tennsx'=>'NSX 3'],
                ['tennsx'=>'NSX 4'],
                ['tennsx'=>'NSX 5'],
                ['tennsx'=>'NSX 6'],
            ]);
        }
    }
    class quocgiaSeeder extends Seeder{
        public function run(){
            DB::table('quocgias')->insert([
                ['tenquocgia'=>'Việt Nam'],
                ['tenquocgia'=>'Lào'],
                ['tenquocgia'=>'Mỹ'],
                ['tenquocgia'=>'Trung Quốc'],
                ['tenquocgia'=>'Anh'],
                ['tenquocgia'=>'Campuchia'],
            ]);
        }
    }
    class phimSeeder extends Seeder{
        public function run(){
            DB::table('phims')->insert([
                ['tenphim'=>'Phim Số 1','theloai'=>'1','hinhanh'=>'a','thoiluong'=>'60p','diem'=>'10','daodien'=>'1','dienvien'=>'1','quocgia'=>'1','nsx'=>'1','trangthai'=>'1','trailer'=>'asssa'],
                ['tenphim'=>'Phim Số 2','theloai'=>'2','hinhanh'=>'a','thoiluong'=>'60p','diem'=>'10','daodien'=>'2','dienvien'=>'2','quocgia'=>'2','nsx'=>'2','trangthai'=>'1','trailer'=>'asssa'],
                ['tenphim'=>'Phim Số 3','theloai'=>'3','hinhanh'=>'a','thoiluong'=>'60p','diem'=>'10','daodien'=>'3','dienvien'=>'3','quocgia'=>'3','nsx'=>'3','trangthai'=>'1','trailer'=>'asssa'],
                ['tenphim'=>'Phim Số 4','theloai'=>'4','hinhanh'=>'a','thoiluong'=>'60p','diem'=>'10','daodien'=>'4','dienvien'=>'4','quocgia'=>'4','nsx'=>'4','trangthai'=>'1','trailer'=>'asssa'],
                ['tenphim'=>'Phim Số 5','theloai'=>'5','hinhanh'=>'a','thoiluong'=>'60p','diem'=>'10','daodien'=>'5','dienvien'=>'5','quocgia'=>'5','nsx'=>'5','trangthai'=>'1','trailer'=>'asssa'],
                ['tenphim'=>'Phim Số 6','theloai'=>'6','hinhanh'=>'a','thoiluong'=>'60p','diem'=>'10','daodien'=>'1','dienvien'=>'1','quocgia'=>'1','nsx'=>'1','trangthai'=>'1','trailer'=>'asssa'],
                ['tenphim'=>'Phim Số 7','theloai'=>'1','hinhanh'=>'a','thoiluong'=>'60p','diem'=>'10','daodien'=>'2','dienvien'=>'2','quocgia'=>'2','nsx'=>'2','trangthai'=>'1','trailer'=>'asssa'],
                ['tenphim'=>'Phim Số 8','theloai'=>'2','hinhanh'=>'a','thoiluong'=>'60p','diem'=>'10','daodien'=>'3','dienvien'=>'3','quocgia'=>'3','nsx'=>'3','trangthai'=>'1','trailer'=>'asssa'],
                ['tenphim'=>'Phim Số 9','theloai'=>'3','hinhanh'=>'a','thoiluong'=>'60p','diem'=>'10','daodien'=>'4','dienvien'=>'4','quocgia'=>'4','nsx'=>'4','trangthai'=>'1','trailer'=>'asssa'],
                ['tenphim'=>'Phim Số 10','theloai'=>'4','hinhanh'=>'a','thoiluong'=>'60p','diem'=>'10','daodien'=>'5','dienvien'=>'5','quocgia'=>'5','nsx'=>'5','trangthai'=>'1','trailer'=>'asssa'],
            ]);
        }
    }
