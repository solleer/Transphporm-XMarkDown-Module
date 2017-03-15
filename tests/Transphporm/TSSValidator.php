<?php
namespace Transphporm;
use Transphporm\Parser\Tokenizer;
class TSSValidator {
    private $error;

    public function validate($tss) {
        $this->error = null;
        $tokens = $this->tokenize($tss);

        foreach ($tokens as $token) {
            $this->checkBraces($token);
        }

        return true;
    }

    public function getLastError() {
        return $this->error;
    }

    private function checkBraces($token) {
        if ($token['type'] === Tokenizer::OPEN_BRACE) {
            if (strpos('{', $token['string']) !== false) return false;
        }
    }

    private function tokenize($tss) {
        if (is_file($tss)) $tss = file_get_contents($tss);
        $tss = $this->stripComments($tss, '//', "\n");
		$tss = $this->stripComments($tss, '/*', '*/');
		$tokenizer = new Tokenizer($tss);
		return $tokenizer->getTokens();
    }

    private function stripComments($str, $open, $close) {
		$pos = 0;
		while (($pos = strpos($str, $open, $pos)) !== false) {
			$end = strpos($str, $close, $pos);
			if ($end === false) break;
			$str = substr_replace($str, '', $pos, $end-$pos+strlen($close));
		}

		return $str;
	}
}
