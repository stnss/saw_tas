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

    public function perhitungan(array $data): array
    {
        $minmax = $this->getMinMaxKriteriaValue($data);
        $normalisasi = $this->getNormalisasi($data, $minmax);
        $ranking = $this->getRankingAlternatif($normalisasi);
        
        uasort($ranking, function ($a, $b) {
            return $a['sum'] < $b['sum'] ? 1 : -1;
        });        

        return [
            'data' => $data,
            'normalisasi' => $normalisasi,
            'ranking' => $ranking
        ];
    }

    private function getMinMaxKriteriaValue(array $data): array {
        $minmax = [];
        foreach ($data as $key => $value) {
            foreach ($value as $idKri => $valKri) {
                $kriteria = $this->kriterias->find($idKri)->first();
                if ($kriteria->type == 'Cost') {
                    $minmax[$idKri] = array_key_exists($idKri, $minmax) ?
                        min($minmax[$idKri], $valKri) :
                        $valKri;
                } else {
                    $minmax[$idKri] = array_key_exists($idKri, $minmax) ?
                        max($minmax[$idKri], $valKri) :
                        $valKri;
                }
            }
        }

        return $minmax;
    }

    private function getNormalisasi(array $data, array $minmax): array {
        foreach($data as $key => $value) {
            foreach ($value as $idKri => $valKri) {
                $kriteria = $this->kriterias->find($idKri)->first();
                if ($kriteria->type == 'Cost') {
                    $data[$key][$idKri] = round($minmax[$idKri] / $valKri, 3, PHP_ROUND_HALF_UP);
                } else {
                    $data[$key][$idKri] = round($valKri / $minmax[$idKri], 3, PHP_ROUND_HALF_UP);
                }
            }
        }

        return $data;
    }

    private function getRankingAlternatif(array $normalisasi): array {
        $ranking = [];

        foreach($normalisasi as $key => $value) {
            $sum = 0;
            $alt = Alternatif::where('id', $key)->first();
            foreach($value as $idKri => $valueKri) {
                $kriteria = $this->kriterias->find($idKri)->first();
                $sum += $valueKri * $kriteria->bobot;
            }

            array_push($ranking, ['nama' => $alt->name, 'sum' => $sum]);
        }

        return $ranking;
    }
}
