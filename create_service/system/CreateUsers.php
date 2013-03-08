<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of CreateIVR
 *
 * @author lukasz
 */
class CreateUsers {

    static private $_Directory = null;
    private $_Nr_SIP_klienta = null;
    private $_Nr_SIP_c2c = null;
    private $_Nr_klienta = null;
    private $_Nazwa_klienta = null;
    private $_User_code = null; // formatka usera dla Asteriska
    private $_Has_external_dial = null; //true allow, false disallow
    private $_VM_password = null; //haslo skrzynki glosowej
    private $_Numer_prezentowany = null;
    private $_User_email = null;
    private $_User_password = null;

    public function __construct() {
        $this->SetUser_code();
        //@TODO zmienic "\" na "/" dla systemow UNIX'owych
        self::$_Directory = __DIR__ . '\..\asterisk_files\Users\\';
    }

    public function __destruct() {
        try {
            self::__destruct();
        } catch (Exception $e) {
            echo "Fatal error:", $e->getMessage, '\n';
            die();
        }
    }

    private function SetUser_code() {
        $this->_User_code = "
[\$nr_SIP]
fullname = Dział obsługi klienta
registersip = no
host = dynamic
callgroup = 1
mailbox = \$nr_SIP
call-limit = 100
type = peer
username = \$nr_SIP
transfer = yes
callcounter = yes
context = \$dialplan
cid_number = \$this->_Numer_prezentowany
hasvoicemail = yes
vmsecret = \$this->_VM_password
email = \$this->_User_email;
threewaycalling = no
hasdirectory = no
callwaiting = no
hasmanager = no
hasagent = yes
hassip = yes
hasiax = no
secret = \$this->_User_password;
nat = yes
canreinvite = no
dtmfmode = rfc2833
insecure = no
pickupgroup = 1
macaddress = \$nr_SIP
autoprov = yes
label = \$nr_SIP
linenumber = 1
LINEKEYS = 1
disallow = all
allow = ulaw,ulaw,g729,speex";
        if (!isset($this->_User_code)) {
            throw new Exception('Nie mozna ustawic atrybutu User_code. ');
            $this->__desctruct();
        }
    }

    public function getNr_SIP_klienta() {
        if (isset($this->_Nr_SIP_klienta)) {
            return $this->_Nr_SIP_klienta;
        } else {
            throw new Exception('Atrybut Nr_SIP_klienta nie jest ustawiony. ');
        }
    }

    public function setNr_SIP_klienta($Nr_SIP_klienta) {
        $this->_Nr_SIP_klienta = $Nr_SIP_klienta;
        if ($this->_Nr_SIP_klienta == null)
            if ($this->_Nr_SIP_klienta == null)
                throw new Exception('Nie mozna ustawic atrybutu Nr_SIP_klienta. ');
    }

    public function getNr_SIP_c2c() {
        if (isset($this->_Nr_SIP_c2c)) {
            return $this->_Nr_SIP_c2c;
        } else {
            throw new Exception('Atrybut Nr_SIP_c2c nie jest ustawiony. ');
        }
    }

    public function setNr_SIP_c2c($Nr_SIP_c2c) {
        $this->_Nr_SIP_c2c = $Nr_SIP_c2c;
        if ($this->_Nr_SIP_c2c == null)
            throw new Exception('Nie mozna ustawic atrybutu NAZWA. ');
    }

    public function getNr_klienta() {
        if (isset($this->_Nr_klienta)) {
            return $this->_Nr_klienta;
        } else {
            throw new Exception('Atrybut Nr_klienta nie jest ustawiony. ');
        }
    }

    public function setNr_klienta($Nr_klienta) {
        $this->_Nr_klienta = $Nr_klienta;
        if ($this->_Nr_klienta == null)
            throw new Exception('Nie mozna ustawic atrybutu Nr_klienta. ');
    }

    public function getNazwa_klienta() {
        if (isset($this->_Nazwa_klienta)) {
            return $this->_Nazwa_klienta;
        } else {
            throw new Exception('Atrybut Nazwa_klienta nie jest ustawiony. ');
        }
    }

    public function setNazwa_klienta($Nazwa_klienta) {
        $this->_Nazwa_klienta = $Nazwa_klienta;
        if ($this->_Nazwa_klienta == null)
            throw new Exception('Nie mozna ustawic atrybutu Nazwa_klienta. ');
    }

    public function getHas_external_dial() {
        if (isset($this->_Has_external_dial)) {
            return $this->_Has_external_dial;
        } else {
            throw new Exception('Atrybut Has_external_dial nie jest ustawiony. ');
        }
    }

    public function setHas_external_dial($Has_external_dial) {
        $this->_Has_external_dial = $Has_external_dial;
        if ($this->_Has_external_dial == null)
            throw new Exception('Nie mozna ustawic atrybutu Has_external_dial. ');
    }

    public function getVM_password() {
        if (isset($this->_VM_password)) {
            return $this->_VM_password;
        } else {
            throw new Exception('Atrybut VM_password nie jest ustawiony. ');
        }
    }

    public function setVM_password($VM_password) {
        $this->_VM_password = $VM_password;
        if ($this->_VM_password == null)
            throw new Exception('Nie mozna ustawic atrybutu VM_password. ');
    }

    public function getNumer_prezentowany() {
        if (isset($this->_Numer_prezentowany)) {
            return $this->_Numer_prezentowany;
        } else {
            throw new Exception('Atrybut Numer_prezentowany nie jest ustawiony. ');
        }
    }

    public function setNumer_prezentowany($Numer_prezentowany) {
        $this->_Numer_prezentowany = $Numer_prezentowany;
        if ($this->_Numer_prezentowany == null)
            throw new Exception('Nie mozna ustawic atrybutu Numer_prezentowany. ');
    }

    public function getUser_email() {
        if (isset($this->_User_email)) {
            return $this->_User_email;
        } else {
            throw new Exception('Atrybut User_email nie jest ustawiony. ');
        }
    }

    public function setUser_email($User_email) {
        $this->_User_email = $User_email;
        if ($this->_User_email == null)
            throw new Exception('Nie mozna ustawic atrybutu User_email. ');
    }

    public function getUser_password() {
        if (isset($this->_User_password)) {
            return $this->_User_password;
        } else {
            throw new Exception('Atrybut User_password nie jest ustawiony. ');
        }
    }

    public function setUser_password($User_password) {
        $this->_User_password = $User_password;
        if ($this->_User_password == null)
            throw new Exception('Nie mozna ustawic atrybutu User_password. ');
    }

    private function _CheckUserAtrributes() {
        $kill = false;
        if (!isset($this->_Has_external_dial)) {
            $kill = true;
            throw new Exception('Atrybut _Has_external_dial nie jest ustawiony. ');
        } if (!isset($this->_Nazwa_klienta)) {
            $kill = true;
            throw new Exception('Atrybut _Nazwa_klienta nie jest ustawiony. ');
        } if (!isset($this->_Nr_SIP_c2c)) {
            $kill = true;
            throw new Exception('Atrybut _Nr_SIP_c2c nie jest ustawiony. ');
        } if (!isset($this->_Nr_SIP_klienta)) {
            $kill = true;
            throw new Exception('Atrybut _Nr_SIP_klienta nie jest ustawiony. ');
        } if (!isset($this->_Nr_klienta)) {
            $kill = true;
            throw new Exception('Atrybut _Nr_klienta nie jest ustawiony. ');
        } if (!isset($this->_Numer_prezentowany)) {
            $kill = true;
            throw new Exception('Atrybut _Numer_prezentowany nie jest ustawiony. ');
        } if (!isset($this->_User_code)) {
            $kill = true;
            throw new Exception('Atrybut _User_code nie jest ustawiony. ');
        } if (!isset($this->_User_email)) {
            $kill = true;
            throw new Exception('Atrybut _User_email nie jest ustawiony. ');
        } if (!isset($this->_User_password)) {
            $kill = true;
            throw new Exception('Atrybut _User_password nie jest ustawiony. ');
        } if (!isset($this->_VM_password)) {
            $kill = true;
            throw new Exception('Atrybut _VM_password nie jest ustawiony. ');
        }
        if ($kill == true) {
            throw new Exception('IVR nie zostal stworzony! ');
            $this->__destruct();
        }
    }

    public function GenerateNewIVR() {
        $this->_CheckUserAtrributes();
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
                    "$directory \nPrawdopodobnie taki uzytkownik juz istnieje lub " .
                    "brak wystarczajacych uprawnien. Trace: $e"
            );
        }
        fwrite($handle, $string);
        fclose($handle);
    }

}

?>
