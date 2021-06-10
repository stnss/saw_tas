<?php

namespace App\Services;

use App\Models\Alternatif;
use App\Models\Kriteria;

class SAWServices
{
    private $kriterias;

    public function __construct() {
        $this->kriterias = Kriteria::all();
    }

    /**
     * Main Function proses perhitungan metode SAW
     */
    public function perhitungan(array $data): array
    {
        // Get nilai minimum dan maximum untuk masing-masing kriteria
        $minmax = $this->getMinMaxKriteriaValue($data);

        // Hitung nilai normalisasi
        $normalisasi = $this->getNormalisasi($data, $minmax);

        // Hitung nilai hasil untuk mencari ranking alternatif
        $ranking = $this->getRankingAlternatif($normalisasi);
        
        // Urutkan hasil perhitungan hasil berdasarkan nilai terbesar
        uasort($ranking, function ($a, $b) {
            return $a['sum'] < $b['sum'] ? 1 : -1;
        });        

        return [
            'data' => $data,
            'normalisasi' => $normalisasi,
            'ranking' => $ranking
        ];
    }

    /**
     * Get nilai minimum dan maximum masing-masing kriteria
     * Nilai minimum jika Kriteria bertype 'COST'
     * Nilai maximum jika Kriteria bertype 'BENEFIT'
     */
    private function getMinMaxKriteriaValue(array $data): array {
        $minmax = [];
        // Loop berdasarkan data hasil input di halaman SAW
        foreach ($data as $key => $value) {
            foreach ($value as $idKri => $valKri) {
                $kriteria = $this->kriterias->find($idKri)->first(); // Get kriteria berdasarkan id
                if ($kriteria->type == 'Cost') {
                    // Jika kriteria 'COST'
                    // Cari nilai minimum dari seluruh nilai untuk kriteria tersebut
                    $minmax[$idKri] = array_key_exists($idKri, $minmax) ?
                        min($minmax[$idKri], $valKri) :
                        $valKri;
                } else {
                    // Jika kriteria 'BENEFIT'
                    // Cari nilai maximum dari seluruh nilai untuk kriteria tersebut
                    $minmax[$idKri] = array_key_exists($idKri, $minmax) ?
                        max($minmax[$idKri], $valKri) :
                        $valKri;
                }
            }
        }

        return $minmax;
    }

    /**
     * Function untuk mencari nilai normalisasi dari nilai input pada halaman SAW
     */
    private function getNormalisasi(array $data, array $minmax): array {
        // Loop berdasarkan data yang didapat dari input pada halaman SAW
        foreach($data as $key => $value) {
            foreach ($value as $idKri => $valKri) {
                $kriteria = $this->kriterias->find($idKri)->first(); // Get Kriteria berdasarkan id
                if ($kriteria->type == 'Cost') {
                    // Jika kriteria 'COST'
                    // Hitung nilai terinput dengan rumus Nilai minimum / Nilai Terinput
                    $data[$key][$idKri] = round($minmax[$idKri] / $valKri, 3, PHP_ROUND_HALF_UP);
                } else {
                    // Jika kriteria 'BENEFIT'
                    // Hitung nilai terinput dengan rumus Nilai terinput / Nilai maximum
                    $data[$key][$idKri] = round($valKri / $minmax[$idKri], 3, PHP_ROUND_HALF_UP);
                }
            }
        }

        return $data;
    }

    /**
     * Function untuk mencari ranking untuk masing-masing alternatif
     */
    private function getRankingAlternatif(array $normalisasi): array {
        $ranking = [];

        // Loop berdasarkan data hasil perhitungan normalisasi
        foreach($normalisasi as $key => $value) {
            $sum = 0;
            $alt = Alternatif::where('id', $key)->first(); // Get nilai alternatif berdasarkan id

            // Loop berdasarkan nilai untuk masing-masing kriteria
            foreach($value as $idKri => $valueKri) {
                $kriteria = $this->kriterias->find($idKri)->first(); // Get nilai Kriteria berdasarkan id
                $sum += $valueKri * $kriteria->bobot; // Jumlahkan keselurah nilai dari hasil nilai krteria * bobot masing-masing kriteria
            }

            array_push($ranking, ['nama' => $alt->name, 'sum' => $sum]);
        }

        return $ranking;
    }
}
