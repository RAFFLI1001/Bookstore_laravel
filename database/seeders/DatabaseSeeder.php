<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Category;
use App\Models\Book;

class DatabaseSeeder extends Seeder {
    public function run(): void {
        // Admin
        User::create([
            'name'     => 'Administrator',
            'email'    => 'admin@bookstore.com',
            'password' => Hash::make('admin123'),
            'role'     => 'admin',
        ]);

        // Sample User
        User::create([
            'name'     => 'Budi Santoso',
            'email'    => 'budi@gmail.com',
            'password' => Hash::make('user123'),
            'role'     => 'user',
        ]);

        // Kategori
        $categories = ['Novel','Pendidikan','Teknologi','Agama','Bisnis'];
        foreach ($categories as $cat) {
            Category::create(['name' => $cat, 'slug' => \Str::slug($cat)]);
        }

        // Buku
        $books = [
            [1,'Laskar Pelangi','Andrea Hirata','Bentang Pustaka',2005,85000,20,'Novel fenomenal karya Andrea Hirata.'],
            [1,'Bumi Manusia','Pramoedya Ananta Toer','Hasta Mitra',1980,95000,15,'Mahakarya sastra Indonesia.'],
            [3,'Laravel untuk Pemula','Andi Wijaya','Elex Media',2022,120000,10,'Belajar Laravel dari nol hingga mahir.'],
            [2,'Matematika Dasar','Siti Rahayu','Erlangga',2020,75000,30,'Buku matematika untuk pelajar.'],
            [5,'Rich Dad Poor Dad','Robert Kiyosaki','Gramedia',2000,110000,25,'Buku motivasi keuangan.'],
            [3,'Clean Code','Robert C. Martin','Prentice Hall',2008,150000,8,'Panduan menulis kode yang bersih.'],
            [4,'Fikih Islam','Sulaiman Rasyid','Sinar Baru',2015,65000,40,'Panduan fikih lengkap.'],
            [5,'Zero to One','Peter Thiel','Gramedia',2014,98000,18,'Membangun startup dari nol.'],
        ];

        foreach ($books as $b) {
            Book::create([
                'category_id' => $b[0], 'title'     => $b[1],
                'author'      => $b[2],  'publisher' => $b[3],
                'year'        => $b[4],  'price'     => $b[5],
                'stock'       => $b[6],  'description' => $b[7],
            ]);
        }
    }
}