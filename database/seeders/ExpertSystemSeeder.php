<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Symptom;
use App\Models\Diagnosis;

class ExpertSystemSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Create Symptoms
        $symptomsData = [
            ['code' => 'G01', 'name' => 'Mesin sulit dinyalakan saat dingin'],
            ['code' => 'G02', 'name' => 'Mesin tersendat-sendat / brebet'],
            ['code' => 'G03', 'name' => 'Mesin panas berlebih (Overheat)'],
            ['code' => 'G04', 'name' => 'Keluar asap hitam dari knalpot'],
            ['code' => 'G05', 'name' => 'Rem bunyi mencicit saat diinjak'],
            ['code' => 'G06', 'name' => 'Rem terasa tidak pakem'],
            ['code' => 'G07', 'name' => 'Lampu sering putus/mati'],
            ['code' => 'G08', 'name' => 'Aki tidak mengisi / starter lemah'],
        ];

        foreach ($symptomsData as $data) {
            Symptom::firstOrCreate(['code' => $data['code']], $data);
        }

        // 2. Create Diagnoses
        $diagnosesData = [
            [
                'code' => 'P01', 
                'name' => 'Busi Rusak/Kotor', 
                'solution' => 'Cek kondisi busi. Bersihkan jika kotor, atau ganti dengan yang baru (NGK/Denso).'
            ],
            [
                'code' => 'P02', 
                'name' => 'Filter Udara Kotor', 
                'solution' => 'Bersihkan filter udara atau ganti jika sudah terlalu kotor.'
            ],
            [
                'code' => 'P03', 
                'name' => 'Kampas Rem Habis', 
                'solution' => 'Ganti kampas rem segera untuk keselamatan.'
            ],
            [
                'code' => 'P04', 
                'name' => 'Radiator/Coolant Bermasalah', 
                'solution' => 'Cek air radiator, kipas radiator, dan pastikan tidak ada kebocoran.'
            ],
            [
                'code' => 'P05', 
                'name' => 'Kiprok/Regulator Rusak', 
                'solution' => 'Periksa tegangan pengisian. Ganti kiprok jika tegangan overcharge atau tidak mengisi.'
            ]
        ];

        foreach ($diagnosesData as $data) {
            Diagnosis::firstOrCreate(['code' => $data['code']], $data);
        }

        // 3. Define Rules (Pivot) - Forward Chaining Mapping
        // P01 (Busi): G01, G02
        $p01 = Diagnosis::where('code', 'P01')->first();
        $p01->symptoms()->sync(Symptom::whereIn('code', ['G01', 'G02'])->pluck('id'));

        // P02 (Filter Udara): G02, G04
        $p02 = Diagnosis::where('code', 'P02')->first();
        $p02->symptoms()->sync(Symptom::whereIn('code', ['G02', 'G04'])->pluck('id'));

        // P03 (Rem): G05, G06
        $p03 = Diagnosis::where('code', 'P03')->first();
        $p03->symptoms()->sync(Symptom::whereIn('code', ['G05', 'G06'])->pluck('id'));

        // P04 (Overheat): G03
        $p04 = Diagnosis::where('code', 'P04')->first();
        $p04->symptoms()->sync(Symptom::whereIn('code', ['G03'])->pluck('id'));

        // P05 (Kelistrikan): G07, G08
        $p05 = Diagnosis::where('code', 'P05')->first();
        $p05->symptoms()->sync(Symptom::whereIn('code', ['G07', 'G08'])->pluck('id'));
    }
}
