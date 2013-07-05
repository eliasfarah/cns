<?php
/**
 * Checks Cartao SUS for Brazil
 *
 * @author adapted by Elias Farah <eliasfa@gmail.com> https://github.com/eliasfarah/cns from https://github.com/insula/opes.
 */
Class CNS {
	/**
	 * @param string $s The value to check.
	 * @return boolean
	 */
    public function isValid($s) {
        if (preg_match("/[1-2]\d{10}00[0-1][0-9]/", $s) || preg_match("/[7-9]\d{14}/", $s)) {
            return $this->somaPonderada($s) % 11 == 0;
        }
        return false;
    }

	/**
	 * @param string $s The value to check.
	 * @return boolean
	 */
    private function somaPonderada($s) {
        $cs = str_split($s);
        $soma = 0;
        for ($i = 0; $i < count($cs); $i++) {
            $soma += intval($cs[$i], 10) * (15 - $i);
        }        
        return $soma;
    }
 }

$cns = new CNS();
if($cns->isValid('8014404873319291')) { 
	echo 'É valido';
} else {
	echo 'Não é valido';
}
