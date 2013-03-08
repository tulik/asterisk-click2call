
<?php

/**
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 * 
 */

/**
 * Description of CreateIVR
 *
 * @author lukasz
 */
class CreateIVR {

    static private $_Directory = null;
    private $_IVR_code = null;
    private $_Nr_klienta = null;
    private $_Nazwa_klienta = null;

    public function __construct() {
        $this->_SetIVR_code();
        /**
         * @todo zmienic "\" na "/" dla systemow UNIX'owych
         */
        self::$_Directory =  __DIR__ . '\..\asterisk_files\IVRs\\';
    }

    public function __destruct() {
        try {
            self::__destruct();
        } catch (Exception $e) {
            echo "Fatal error:", $e->getMessage, '\n';
            die();
        }
    }

    private function _SetIVR_code() {
        $this->_IVR_code = "
[voicemenu-custom-$this->_Nr_klienta] 
include = default
exten = s,1,NoOp($this->_Nazwa_klienta) ;Nazwa klienta
exten = s,2,Answer()
exten = s,3,Background(ivr_set/1) ;Sciezki do dzwiekow, domyslna:
                                  ;/var/lib/asterisk/sounds/en/...
exten = s,4,Background(ivr_set/2) ;Odtwarza nazwe firmy
exten = s,5,Background(ivr_set/4)
exten = s,6,Background(ivr_set/5)
exten = s,7,Background(ivr_set/6)
exten = s,8,Background(ivr_set/7)
exten = s,9,Background(ivr_set/8)
exten = s,10,Wait(4)
exten = s,11,Background(ivr_set/9)
exten = s,12,Wait(2)
exten = s,13,Goto(voicemenu-custom-$this->_Nr_klienta,s,5)
exten = 1,1,Goto(queues,6500,1)
exten = 2,1,Goto(queues,6501,1)
exten = 5,1,Goto(voicemailgroups,6600,1) ;To jeszcze do opracowania
exten = 9,1,Goto(voicemenu-custom-$this->_Nr_klienta,s,5)
exten = i,1,Background(ivr_set/10)
exten = i,2,Background(ivr_set/11)
exten = i,3,Wait(4)
exten = i,4,Goto(voicemenu-custom-$this->_Nr_klienta,s,11)";
        if (!isset($this->_IVR_code)) {
            throw new Exception('Nie mozna ustawic atrybutu IVR_code. ');
            $this->__desctruct();
        }
    }

    public function SetNazwa_Klienta($nazwa_klienta) {
        $this->_Nazwa_klienta = $nazwa_klienta;
        if ($this->_Nazwa_klienta == null)
            throw new Exception('Nie mozna ustawic nazwy klienta. ');
    }

    public function GetNazwa_Klienta() {
        if (isset($this->_Nazwa_klienta)) {
            return $this->_Nazwa_klienta;
        } else {
            throw new Exception('Nazwa klienta nie jest ustawiona. ');
        }
    }

    public function SetNr_klienta($nr_klienta) {
        $this->_Nr_klienta = $nr_klienta;
        if ($this->_Nr_klienta == null)
            throw new Exception('Nie mozna ustawic nr klienta. ');
    }

    public function GetNr_Klienta() {
        if (isset($this->_Nr_klienta)) {
            return $this->_Nr_klienta;
        } else {
            throw new Exception('Nr klienta nie jest ustawiony. ');
        }
    }
    
    private function _CheckIVRatrributes() {
        if (!isset($this->_Nazwa_klienta))
            throw new Exception('Nr klienta nie jest ustatwiony. ');
        if (!isset($this->_Nazwa_klienta))
            throw new Exception('Nazwa klienta nie jest ustawiona. ');
        if (!isset($this->_Nazwa_klienta) || !isset($this->_Nr_klienta)) {
            throw new Exception('IVR nie zostal stworzony! ');
            $this->__destruct();
        }
    }

    public function GenerateNewIVR() {
        $this->_CheckIVRatrributes();
        $this->_SetIVR_code();
        $directory = self::$_Directory;
        $filename = $directory . "$this->_Nr_klienta-$this->_Nazwa_klienta";
        $mode = 'x+';
        $string = (string) $this->_IVR_code;
        try {
            $handle = fopen($filename, $mode);
        } catch (Exception $e) {
            $e = $e->getTraceAsString();
            throw new Exception(
                    "Nie mozna stworzyc pliku o nazwie " .
                    "$this->_Nr_klienta - $this->_Nazwa_klienta w katalogu " .
                    "$directory \nPrawdopodobnie taki IVR juz istnieje lub " .
                    "brak wystarczajacych uprawnien. Trace: $e"
            );
        }
        fwrite($handle, $string);
        fclose($handle);
    }

}

?>
