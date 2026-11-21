<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Book;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::firstOrCreate(
            ['username' => 'admin1'],
            [
                'password' => 'hellouniverse1!',
                'role' => 'admin'
            ]
        );
        User::firstOrCreate(
            ['username' => 'member1'],
            [
                'password' => 'helloworld1!',
                'role' => 'member'
            ]
        );
        User::firstOrCreate(
            ['username' => 'member2'],
            [
                'password' => 'helloworld2!',
                'role' => 'member'
            ]
        );

        $admin = User::where('username', 'admin1')->firstOrFail();

        $books = [
            [
                'title' => 'Laskar Pelangi',
                'slug' => 'laskar-pelangi',
                'description' => 'Kisah perjuangan sepuluh anak di Belitung untuk mendapatkan pendidikan.',
            ],
            [
                'title' => 'Bumi',
                'slug' => 'bumi',
                'description' => 'Petualangan Raib, Seli, dan Ali menjelajahi dunia paralel.',
            ],
            [
                'title' => 'Bulan',
                'slug' => 'bulan',
                'description' => 'Kelanjutan petualangan tiga sahabat di dunia paralel.',
            ],
            [
                'title' => 'Negeri 5 Menara',
                'slug' => 'negeri-5-menara',
                'description' => 'Perjalanan enam santri dalam mengejar cita-cita.',
            ],
            [
                'title' => 'Ronggeng Dukuh Paruk',
                'slug' => 'ronggeng-dukuh-paruk',
                'description' => 'Kisah kehidupan masyarakat desa dan tradisi ronggeng.',
            ],
            [
                'title' => 'Perahu Kertas',
                'slug' => 'perahu-kertas',
                'description' => 'Kisah persahabatan, mimpi, dan perjalanan cinta.',
            ],
            [
                'title' => 'Dilan 1990',
                'slug' => 'dilan-1990',
                'description' => 'Kisah kehidupan remaja Bandung pada tahun 1990.',
            ],
            [
                'title' => 'Bumi Manusia',
                'slug' => 'bumi-manusia',
                'description' => 'Kisah Minke dalam menghadapi ketidakadilan pada masa kolonial.',
            ],
            [
                'title' => 'Sang Pemimpi',
                'slug' => 'sang-pemimpi',
                'description' => 'Perjuangan tiga sahabat dalam mengejar pendidikan dan impian.',
            ],
            [
                'title' => 'Filosofi Teras',
                'slug' => 'filosofi-teras',
                'description' => 'Pengantar filsafat Stoisisme untuk kehidupan sehari-hari.',
            ],
            [
                'title' => 'Atomic Habits',
                'slug' => 'atomic-habits',
                'description' => 'Panduan membangun kebiasaan baik melalui perubahan kecil.',
            ],
            [
                'title' => 'Rich Dad Poor Dad',
                'slug' => 'rich-dad-poor-dad',
                'description' => 'Pembahasan dasar mengenai pola pikir dan literasi keuangan.',
            ],
            [
                'title' => 'The Psychology of Money',
                'slug' => 'the-psychology-of-money',
                'description' => 'Pembahasan hubungan perilaku manusia dengan keputusan keuangan.',
            ],
            [
                'title' => 'Clean Code',
                'slug' => 'clean-code',
                'description' => 'Prinsip menulis kode yang mudah dibaca dan dipelihara.',
            ],
            [
                'title' => 'The Pragmatic Programmer',
                'slug' => 'the-pragmatic-programmer',
                'description' => 'Panduan pola pikir dan praktik profesional dalam pengembangan perangkat lunak.',
            ],
        ];
        foreach ($books as $book) {
            Book::firstOrCreate(
                [
                    'slug' => $book['slug']
                ],
                [
                    'title' => $book['title'],
                    'created_by' => $admin->id,
                    'description' => $book['description'],
                ]
            );
        }
    }
}
