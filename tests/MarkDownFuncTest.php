<?php
use Transphporm\Builder;
use TransphpormXMarkDown\Module;
class MarkDownFuncTest extends PHPUnit_Framework_TestCase {
    private function strip_tabs($str) {
        return trim(str_replace(["\t", "\n", "\r"], '', $str));
    }

    private function addMarkDownModule(&$transphporm) {
        $transphporm->loadModule(new Module);
    }

    public function testMarkDownStringFromData() {
        $xml = '<main></main>';
        $tss = 'main { content: markdown(data()); }';
        $markdown = '
Heading
============
        ';

        $transphporm = new Builder($xml, $tss);
        $this->addMarkDownModule($transphporm);

        $this->assertEquals($this->strip_tabs('<main><h1>Heading</h1></main>'), $this->strip_tabs($transphporm->output($markdown)->body));
    }

    public function testMarkDownStringFromTss() {
        $xml = '<main></main>';
        $tss = 'main { content: markdown("
Heading
============
"); }';

        $transphporm = new Builder($xml, $tss);
        $this->addMarkDownModule($transphporm);

        $this->assertEquals($this->strip_tabs('<main><h1>Heading</h1></main>'), $this->strip_tabs($transphporm->output()->body));
    }

    public function testMarkDownStringFromFile() {
        $xml = '<main></main>';
        $tss = 'tests/file.tss';

        $transphporm = new Builder($xml, $tss);
        $this->addMarkDownModule($transphporm);

        $this->assertEquals($this->strip_tabs('<main><h1>Heading</h1></main>'), $this->strip_tabs($transphporm->output()->body));
    }
}
