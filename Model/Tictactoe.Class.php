<?php

namespace Model;


class Tictactoe
{
    public  $turn;
    public  $map;

    public function place($case){
        $this->map[$case] = $this->turn;
        if ($this->turn == 'x')
            $this->turn = 'o';
        else
            $this->turn = 'x';
    }

    public function checkEndCon(){
        if ($this->map[0] && $this->map[0] == $this->map[1] && $this->map[1] == $this->map[2])
            return ($this->map[0]);
        else if ($this->map[3] && $this->map[3] == $this->map[4] && $this->map[4] == $this->map[5])
            return ($this->map[3]);
        else if ($this->map[6] && $this->map[6] == $this->map[7] && $this->map[7] == $this->map[8])
            return ($this->map[6]);
        else if ($this->map[0] && $this->map[0] == $this->map[4] && $this->map[4] == $this->map[8])
            return ($this->map[0]);
        else if ($this->map[2] && $this->map[2] == $this->map[4] && $this->map[4] == $this->map[6])
            return ($this->map[2]);
        else if ($this->map[0] && $this->map[0] == $this->map[3] && $this->map[3] == $this->map[6])
            return $this->map[0];
        else if ($this->map[1] && $this->map[1] == $this->map[4] && $this->map[4] == $this->map[7])
            return $this->map[1];
        else if ($this->map[2] && $this->map[2] == $this->map[5] && $this->map[5] == $this->map[8])
            return $this->map[2];
        else {
            foreach ($this->map as $value) {
                if (!isset($value))
                    return (false);
                else
                    return (true);
            }
        }
    }
}