<?php

namespace TransphpormXMarkDown;
class Module implements \Transphporm\Module {
    public function load(\Transphporm\Config $config) {
		$functionSet = $config->getFunctionSet();
		$baseDir = &$config->getBaseDir();

        $functionSet->addFunction('markdown', new MarkDownFunction($baseDir));
    }
}
