<?php

$fact_data = [ 'D', 'G', 'F'];
$rules = [
    [
        'C' , ['and' => ['A', 'B']]
    ],
    [
        'A' , ['and' => ['D']]
    ],
    [
        'F' , ['and' => ['E']]
    ],
    [
        'H' , ['and' => ['G']]
    ],
    [
        'F' , ['and' => ['I']]
    ],
    [
        'B' , ['and' => ['F', 'H'], 'or' => ['J']]
    ],
    [
        'J' , ['and' => ['H','K']]
    ],
    [
        'K' , ['and' => ['F','G']]
    ],
];

$initial_proof = 'C';
$loop_proof = $initial_proof;

function forward_chaining($fact_data, $rules, $loop_proof)
{
    #find the proof

    foreach ($rules as $rule) {
        if ($rule[0] == $loop_proof) {
            foreach($rule[1] as $key => $premices){
                $all_premices_are_true = 0;
                foreach ($premices as $premice){
                    if (check_fact_is_true($premice, $fact_data)) {
                        $all_premices_are_true += true;
                        return;
                    } else {
                        $loop_proof = $rule[1];
                        forward_chaining($fact_data, $rules, $loop_proof);
                    }
                }
            }
        }
    }

}

function check_fact_is_true( $fact, $fact_data)
{
    return in_array($fact, $fact_data);
}


forward_chaining($fact_data, $rules, $initial_proof);