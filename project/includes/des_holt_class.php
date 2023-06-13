<?php
class DESHolt
{
    public $yt;
    public $alpha;
    public $beta;
    public $n_periode;

    public $lt;
    public $tt;

    function __construct($yt, $alpha, $beta, $n_periode)
    {
        $this->yt = $yt;
        $this->alpha = $alpha;
        $this->beta = $beta;
        $this->n_periode = $n_periode;

        $this->hitung();
    }
    function hitung()
    {

        $no = 1;
        $lt = null;
        $tt = null;
        $temp_yt = null;
        $temp_tt = null;
        $temp_lt = null;

        foreach ($this->yt as $key => $val) {
            if ($no == 2) {
                $lt = $val;
                $tt = $val - $temp_yt;
            } else if ($no > 2) {
                $lt = -1;
                $lt = $this->alpha * $val + (1 - $this->alpha) * ($temp_lt + $temp_tt);
                $tt = $this->beta * ($lt - $temp_lt) + (1 - $this->beta) * $temp_tt;


                $this->ft[$key] = $temp_lt  + $temp_tt;

                $this->e[$key] = $this->yt[$key] - $this->ft[$key];
                $this->e_abs[$key] = abs($this->e[$key]);
                $this->e2[$key] = pow($this->e[$key], 2);
                $this->e_abs_yt[$key] = abs($this->e[$key]) / $this->yt[$key];
            }

            $this->lt[$key] = $lt;
            $this->tt[$key] = $tt;
            $temp_lt = $lt;
            $temp_tt = $tt;
            $temp_yt = $val;
            $no++;
        }

        for ($a = 1; $a <= $this->n_periode; $a++) {
            if ($a == 1) {
                $this->ft_next[] = $temp_lt - $temp_tt;
            } else {
                $this->ft_next[] = $temp_lt + $temp_tt * $a;
            }
        }
    }
}
