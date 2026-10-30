<?php

namespace App\Support;

/**
 * Data contoh untuk tampilan. Ganti dengan Model Eloquent
 * (Ruangan, Guru, Riwayat) saat backend sudah siap.
 */
class DummyData
{
    public static function user(): array
    {
        return [
            'nama'    => 'Sarah',
            'lengkap' => 'Sarah Amalia',
            'peran'   => 'TU / Administrator',
            'email'   => 'sarah@smartclassroom.sch.id',
            'telepon' => '0812-3456-7890',
            'sekolah' => 'SMA Negeri 1 Batam',
        ];
    }

    public static function ruangan(): array
    {
        return [
            ['id' => 1, 'nama' => 'X IPA 1',   'lantai' => 1, 'kapasitas' => 32, 'status' => 'Terpakai',  'guru' => 'Bu Rina Wulandari',  'mapel' => 'Matematika', 'suhu' => 24, 'fasilitas' => ['AC', 'Proyektor']],
            ['id' => 2, 'nama' => 'X IPA 2',   'lantai' => 1, 'kapasitas' => 32, 'status' => 'Kosong',    'guru' => null,                 'mapel' => null,         'suhu' => 27, 'fasilitas' => ['AC', 'Proyektor']],
            ['id' => 3, 'nama' => 'XI IPS 1',  'lantai' => 2, 'kapasitas' => 30, 'status' => 'Terpakai',  'guru' => 'Pak Dimas Prakoso',  'mapel' => 'Ekonomi',    'suhu' => 25, 'fasilitas' => ['AC']],
            ['id' => 4, 'nama' => 'XI IPS 2',  'lantai' => 2, 'kapasitas' => 30, 'status' => 'Perawatan', 'guru' => null,                 'mapel' => null,         'suhu' => 29, 'fasilitas' => ['Kipas', 'Proyektor']],
            ['id' => 5, 'nama' => 'XII IPA 1', 'lantai' => 3, 'kapasitas' => 28, 'status' => 'Terpakai',  'guru' => 'Bu Laila Nurhayati', 'mapel' => 'Biologi',    'suhu' => 23, 'fasilitas' => ['AC', 'Proyektor', 'Smart TV']],
        ];
    }

    public static function guru(): array
    {
        return [
            ['nip' => '198504122010', 'nama' => 'Rina Wulandari',   'mapel' => 'Matematika',       'kelas' => 'X IPA 1',   'status' => 'Mengajar'],
            ['nip' => '198809232012', 'nama' => 'Dimas Prakoso',    'mapel' => 'Ekonomi',          'kelas' => 'XI IPS 1',  'status' => 'Mengajar'],
            ['nip' => '199001152015', 'nama' => 'Laila Nurhayati',  'mapel' => 'Biologi',          'kelas' => 'XII IPA 1', 'status' => 'Mengajar'],
            ['nip' => '198211302008', 'nama' => 'Hendra Saputra',   'mapel' => 'Fisika',           'kelas' => 'X IPA 2',   'status' => 'Istirahat'],
            ['nip' => '199205182017', 'nama' => 'Maya Anggraini',   'mapel' => 'Bahasa Indonesia', 'kelas' => 'XI IPS 2',  'status' => 'Istirahat'],
            ['nip' => '198706092011', 'nama' => 'Yusuf Maulana',    'mapel' => 'Sejarah',          'kelas' => 'XI IPS 1',  'status' => 'Istirahat'],
            ['nip' => '199302212019', 'nama' => 'Putri Ayuningtyas','mapel' => 'Bahasa Inggris',   'kelas' => 'X IPA 1',   'status' => 'Istirahat'],
            ['nip' => '198003142005', 'nama' => 'Bambang Irawan',   'mapel' => 'Kimia',            'kelas' => 'XII IPA 1', 'status' => 'Cuti'],
        ];
    }

    public static function riwayat(): array
    {
        return [
            ['waktu' => '08:12', 'hari' => 'Hari ini', 'aksi' => 'X IPA 1 dipakai oleh Bu Rina Wulandari',          'jenis' => 'Ruangan'],
            ['waktu' => '07:45', 'hari' => 'Hari ini', 'aksi' => 'Suhu XII IPA 1 diturunkan ke 23°C',                'jenis' => 'Kondisi'],
            ['waktu' => '07:30', 'hari' => 'Hari ini', 'aksi' => 'Sarah menambahkan data guru Putri Ayuningtyas',    'jenis' => 'Guru'],
            ['waktu' => '16:20', 'hari' => 'Kemarin',  'aksi' => 'XI IPS 2 ditandai perawatan: AC tidak dingin',     'jenis' => 'Kondisi'],
            ['waktu' => '14:05', 'hari' => 'Kemarin',  'aksi' => 'Status Bambang Irawan diubah menjadi cuti',        'jenis' => 'Guru'],
            ['waktu' => '10:40', 'hari' => 'Kemarin',  'aksi' => 'Kapasitas X IPA 2 diperbarui menjadi 32 siswa',    'jenis' => 'Ruangan'],
        ];
    }
}