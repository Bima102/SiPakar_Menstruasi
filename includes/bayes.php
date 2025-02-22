<?php

/** class Bayes */
class Bayes
{
    public array $selected;
    public array $penyakit;
    public array $data;
    public array $pro_gejala_penyakit = [];
    public array $pro_gejala = [];
    public array $pro_penyakit = [];
    public array $hasil = [];
    public array $persen = [];

    /**
     * Konstruktor class
     * @param array $selected Gejala yang terpilih
     * @param array $penyakit Data semua penyakit (kode, nama, bobot, keterangan)
     * @param array $data Data bobot penyakit untuk setiap gejala
     */
    function __construct(array $selected, array $penyakit, array $data)
    {
        $this->selected = $selected;
        $this->penyakit = $penyakit;
        $this->data = $data;
        $this->hitung();
    }

    /**
     * Melakukan proses perhitungan
     */
    function hitung()
    {
        /** probabilitas penyakit gejala */
        $this->pro_gejala_penyakit = [];

        /** perulangan penyakit */
        foreach ($this->data as $key => $val) {
            /** perulangan gejala dan bobot setiap penyakit */
            foreach ($val as $k => $v) {
                /** bobot dikalikan dengan bobot gejala */
                $this->pro_gejala_penyakit[$k][$key] = $v * $this->penyakit[$key]->bobot;
            }
        }

        /** probabilitas gejala */
        $this->pro_gejala = [];
        foreach ($this->pro_gejala_penyakit as $key => $val) {
            /** mentotalkan (sum) probabilitas gejala penyakit untuk masing-masing gejala */
            $this->pro_gejala[$key] = array_sum($val);
        }

        /** probabilitas penyakit */
        $this->pro_penyakit = [];
        foreach ($this->pro_gejala_penyakit as $key => $val) {
            foreach ($val as $k => $v) {
                /** x adalah pembilang (pro penyakit gejala) */
                $this->pro_penyakit[$k][$key]['x'] = $v;
                /** y adalah penyebut (pro gejala) */
                $this->pro_penyakit[$k][$key]['y'] = $this->pro_gejala[$key];
                /** probabilitas penyakit adalah x / y */
                $this->pro_penyakit[$k][$key]['z'] = $this->pro_penyakit[$k][$key]['x'] / $this->pro_penyakit[$k][$key]['y'];
            }
        }

        /** hasil probabilitas penyakit */
        $this->hasil = [];
        foreach ($this->penyakit as $key => $val) {
            $this->hasil[$key] = 0;
            foreach ((array) $this->pro_penyakit[$key] as $k => $v) {
                $this->hasil[$key] += $v['z'];
            }
        }

        /** persentase */
        $this->persen = [];
        $total = array_sum($this->hasil);
        foreach ($this->hasil as $key => $val) {
            $this->persen[$key] = ($total > 0) ? $val / $total : 0;
        }
    }
}
