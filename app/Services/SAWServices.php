<?php

namespace App\Services;

use App\Models\Kriteria;

class SAWServices
{
    private $kriterias;

    public function __construct() {
        $this->kriterias = Kriteria::all();
    }

    public function perhitungan(array $data)
    {
        $minmax = $this->getMinMaxKriteriaValue($data);
        $normalisasi = $this->getNormalisasi($data, $minmax);
        // $

        debug($minmax, $normalisasi);

        return $data;
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
}
