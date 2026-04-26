<?php

class Model {

    private $file = "data.json";

    private function defaultStructure() {
        return [
            "matakuliah" => [],
            "mahasiswa" => []
        ];
    }

    private function readData() {
        if (!file_exists($this->file)) {
            return $this->defaultStructure();
        }

        $content = file_get_contents($this->file);
        $data = json_decode($content, true);

        if (!$data || !is_array($data)) {
            return $this->defaultStructure();
        }

        if (!isset($data['matakuliah'])) $data['matakuliah'] = [];
        if (!isset($data['mahasiswa'])) $data['mahasiswa'] = [];

        return $data;
    }

    private function writeData($data)
    {
        file_put_contents(
            $this->file,
            json_encode($data, JSON_PRETTY_PRINT),
            LOCK_EX
        );
    }

    public function saveMK($mk) {
        $data = $this->readData();

        if (!is_array($mk)) return;

        $temp = [];

        foreach ($data['matakuliah'] as $item) {
            $temp[$item['kode']] = $item;
        }

        foreach ($mk as $item) {
            $temp[$item['kode']] = $item;
        }

        $data['matakuliah'] = array_values($temp);
        $this->writeData($data);
    }

    public function getMK() {
        return $this->readData()['matakuliah'];
    }

    public function saveMahasiswa($mhs) {
        $data = $this->readData();

        if (!isset($mhs['npm']) || !isset($mhs['nama'])) return;

        $data['mahasiswa'][] = $mhs;

        $this->writeData($data);
    }

    public function getMahasiswa() {
        return $this->readData()['mahasiswa'];
    }
}
